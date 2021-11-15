<?php

namespace App\Http\Controllers\Site;

use App\Country;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Game;
use App\Models\Message;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\Tournament;
use App\Models\TournamentOrder;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\ExpressCheckout;
use PDF;

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
        $data['upcoming_tournaments'] = Tournament::where('tournament_start_date', '>', Carbon::now()->format('Y-m-d'))->latest()->limit(10)->get();
        $data['blogs'] = Blog::latest()->limit(3)->get();

        return view('site.pages.index')->with($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tournaments()
    {
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
    public function addCart(Request $request, $id)
    {
        $product = Product::findOrFail($id)->toArray();
        $item = [
            'name' => $product['product_name'],
            'description' => $product['description'],
            'price' => $product['price'],
            'image' => $product['image'],
            'discount' => $product['discount'],
            'qty' => 1,
            'id' => $product['id']
        ];

        $carts = session()->get('cart');
        if (empty($carts)) {
            $carts = [];
        } else {
            foreach ($carts as $key => $cart) {
                if ($id == $cart['id']) {
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
    public function removeCartItem(Request $request, $id)
    {
        $carts = session()->get('cart');
        unset($carts[$id]);
        $carts = array_values($carts);
        $request->session()->put('cart', $carts);
        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart()
    {
        $data['title'] = 'Cart';
        $data['cart'] = session()->get('cart');

        return view('site.pages.cart')->with($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCart(Request $request)
    {
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
    public function checkout()
    {
        if (!Auth::user()) {
            return redirect()->route('site.user.login');
        }

        $cart = session()->get('cart');

        $latestOrder = Order::orderBy('created_at', 'DESC')->first();
        $total = 0;
        foreach ($cart as $item) {
            $discount = $item['price'] * ($item['discount'] / 100);
            $item_total = $item['price'] - $discount;
            $total = $total + ($item['qty'] * $item_total);
        }

        $order = [
            'user_id' => Auth::id(),
            'order_no' => 'order_' . str_pad((isset($latestOrder->id) ? $latestOrder->id : 0) + 1, 4, "0", STR_PAD_LEFT),
            'total' => $total,
            'order_status' => 'pending',
            'payment_status' => 'pending',
            'created_at' => Carbon::now()
        ];

        $order_id = Order::insertGetId($order);
        if ($order_id) {
            foreach ($cart as $item) {
                $discount = $item['price'] * ($item['discount'] / 100);
                $item_total = $item['qty'] * ($item['price'] - $discount);
                $item_array = [
                    'order_id' => $order_id,
                    'product_id' => $item['id'],
                    'qty' => $item['qty'],
                    'price' => $item_total
                ];

                OrderItem::insert($item_array);
                $product = Product::find($item['id']);
                $product->inventory = $product->inventory - $item['qty'];
                $product->save();
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
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $input = $request->all();
        $id = $input['order_id'];
        unset($input['_token']);
        unset($input['order_id']);

        if (isset($input['payment_method']) && $input['payment_method'] == 'cod') {
            $input['payment_status'] = 'done';
        }

        $result = Order::where('id', $id)->update($input);
        if ($result) {
            $order_number = Order::where('id', $id)->pluck('order_no')->first();
            session()->forget('cart');
            return redirect()->route('site.cart-success', [$order_number, $id]);
        } else {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    /**
     * @param $order_number
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function successCart($order_number, $id)
    {
        $data['title'] = 'Cart Success';
        $data['order_number'] = $order_number;
        $data['order_id'] = $id;

        return view('site.pages.cart-success')->with($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function downloadShopInvoice($id)
    {
        $order = Order::findOrFail($id);
        $pdf = PDF::loadView('pdfs.invoice', compact('order'));

        return $pdf->download('invoice' . $order->order_no . '.pdf');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shop(Request $request)
    {
        $cat = $request->get('cat');
        $search = $request->get('q');
        $data['title'] = 'Shop';
        $data['bg'] = asset('site/img/images/tt.jpg');
        $data['products'] = Product::latest()
            ->when($cat, function ($q) use ($cat) {
                return $q->where('category', $cat);
            })
            ->when($search, function ($q) use ($search) {
                return $q->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            })
            ->paginate(12);

        return view('site.pages.shop')->with($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function aboutUs()
    {
        $data['title'] = 'About Us';

        return view('site.pages.about-us')->with($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        $data['title'] = 'Terms & Conditions';

        return view('site.pages.terms')->with($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy()
    {
        $data['title'] = 'Privacy Policy';

        return view('site.pages.privacy')->with($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactUs()
    {
        $data['title'] = 'Contact Us';
        $data['bg'] = asset('site/img/images/tt.jpg');

        return view('site.pages.contact')->with($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sendMessage(Request $request)
    {
        $input = $request->except('_token');
        $input['useer_id'] = Auth::user() ? Auth::id() : NULL;
        Message::create($input);

        $data['title'] = 'Message Sent';
        $data['message1'] = 'Thank you for contacting us.';
        $data['message2'] = 'We will contact you after reviewing your query in 24 hours.';

        return view('site.pages.username-submit')->with($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blog($id)
    {
        $data['title'] = 'Blog';
        $data['blog'] = Blog::findOrFail($id);

        return view('site.pages.blog')->with($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blogs()
    {
        $data['title'] = 'Blogs';
        $data['blogs'] = Blog::where('is_active', 1)->paginate(10);

        return view('site.pages.blogs')->with($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Request $request)
    {
        $input = $request->except('_token');

        Subscriber::create($input);
        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function myProfile()
    {
        if (!Auth::user()) {
            return redirect()->route('site.user.login');
        } else {
            $data['title'] = 'My Profile';
            $data['user'] = User::findOrFail(Auth::id());
            $data['countries'] = Country::all();

            return view('site.pages.my-profile')->with($data);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request, $id)
    {
        $input = $request->except('_token');
        $user = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = 'user_' . time() . '.' . $extension;
            $destinantion = public_path() . '/';
            $image->move($destinantion, $image_name);
        } else {
            $image_name = $user->image;
        }

        $user->name = $input['first_name'] . ' ' . $input['last_name'];
        $user->country_id = $input['country'];
        $user->image = $image_name;

        if ($user->save()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Registration Complete. Please check your email address for verification']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function myOrders() {
        if (!Auth::user()) {
            return redirect()->route('site.user.login');
        } else {
            $data['title'] = 'My Orders';
            $user = User::find(Auth::id());
            $data['orders'] = $user->orders;

            return view('site.pages.my-orders')->with($data);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function myTournaments() {
        if (!Auth::user()) {
            return redirect()->route('site.user.login');
        } else {
            $data['title'] = 'My Tournaments';
            $user = User::find(Auth::id());
            $data['tournaments'] = $user->tournaments;

            return view('site.pages.my-tournaments')->with($data);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function product($id) {
        $data['title'] = 'Product';
        $data['product'] = Product::findOrFail($id);

        return view('site.pages.product')->with($data);
    }


    public function leaderboard($id)
    {
        $data['title'] = 'Leaderboard';
        $teams = TournamentOrder::where('tournament_id', $id)->orderBy('points', 'desc')->get();
        $data['teams'] = $teams;

        return view('site.pages.leaderboard')->with($data);
    }
}
