<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $data['title'] = 'Home';
        $data['products'] = Product::latest()->limit(10)->get();
        $data['games'] = Game::latest()->limit(10)->get();
        $data['tournaments'] = Tournament::latest()->limit(10)->get();
        return view('site.pages.index')->with($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tournaments() {
        $data['title'] = 'Tournaments';
        $data['bg'] = asset('site/img/images/tt.jpg');
        $tournaments = Tournament::whereIn('status', ['open', 'streaming'])
            ->where('is_active', 1)
            ->paginate(9);

        $data['tournaments'] = $tournaments;
        return view('site.pages.tournaments')->with($data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addCart(Request $request, $id) {
        $product = Product::findOrFail($id)->toArray();
        $item = [
            'name' => $product['product_name'],
            'description' => $product['description'],
            'price' => $product['price'],
            'image' => $product['image'],
            'qty' => 1,
            'id' => $product['id']
        ];

        $carts = session()->get('cart');
        if (empty($carts)) {
            $carts = [];
        } else {
            foreach ($carts as $key => $cart) {
                if($id == $cart['id']) {
                    $carts[$key]['qty'] = $carts[$key]['qty'] + 1;
                    $item = null;
                    break;
                }
            }
        }

        if ($item) {
            $carts[] = $item;
        }
        $request->session()->put('cart', $carts);
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeCartItem(Request $request, $id) {
        $carts = session()->get('cart');
        unset($carts[$id]);
        $carts = array_values($carts);
        $request->session()->put('cart', $carts);
        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart() {
        $data['title'] = 'Cart';
        $data['cart'] = session()->get('cart');

        return view('site.pages.cart')->with($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCart(Request $request) {
        $qty = $request->input('qty');
        $cart = session()->get('cart');
        foreach ($cart as $key => $item) {
            $cart[$key]['qty'] = $qty[$key];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function checkout() {
        if (!Auth::user()) {
            return redirect()->route('site.user.login');
        }

        $cart = session()->get('cart');

        $latestOrder = Order::orderBy('created_at','DESC')->first();
        $total = 0;
        foreach ($cart as $item) {
            $total = $total + ($item['qty'] * $item['price']);
        }

        $order = [
            'user_id' => Auth::id(),
            'order_no' => 'order_'.str_pad((isset($latestOrder->id) ? $latestOrder->id : 0)  + 1, 4, "0", STR_PAD_LEFT),
            'total' =>  $total,
            'order_status' => 'pending',
            'payment_status' => 'pending'
        ];

        $order_id = Order::insertGetId($order);
        if ($order_id) {
            foreach ($cart as $item) {
                $item_array = [
                    'order_id' => $order_id,
                    'product_id' => $item['id'],
                    'qty' => $item['qty'],
                    'price' => $item['price']
                ];

                OrderItem::insert($item_array);
            }
        }

        $data['title'] = 'Checkout';
        $data['cart'] = $cart;
        $data['order_id'] = $order_id;

        return view('site.pages.checkout')->with($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateShipment(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'client_name' => 'required',
            'email' => 'required|email',
            'shipping_address' => 'required',
            'contact_number' => 'required',
            'payment_method' => 'required',
            'checkout_condition' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $input = $request->all();
        $id = $input['order_id'];
        unset($input['_token']);
        unset($input['order_id']);
        unset($input['checkout_condition']);

        if (isset($input['payment_menthod']) && $input['payment_menthod'] == 'cod') {
            $input['payment_status'] = 'done';
        }

        $result = Order::where('id', $id)->update($input);
        if ($result) {
            $order_number = Order::where('id', $id)->pluck('order_no')->first();
            session()->forget('cart');
            return redirect()->route('site.cart-success', $order_number);
        } else {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    /**
     * @param $order_number
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function successCart($order_number)
    {
        $data['title'] = 'Cart Success';
        $data['order_number'] = $order_number;

        return view('site.pages.cart-success')->with($data);
    }

    public function blog($id) {
        $data['title'] = 'Blog Details';

        return view('site.pages.blogs.1')->with($data);
    }
}
