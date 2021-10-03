<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }
        $data['title'] = 'Orders';
        $data['orders'] = Order::where('order_status', '!=', 'delete')->latest()->paginate(10);
        return view('admin.pages.orders.list')->with($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $order = Order::findOrFail($input['id']);
        $order->order_status = $input['order_status'];
        if ($order->save()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Order status changed successfully']);
        } else {
            return redirect()->back()->withErrors(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    public function view($id) {
        $order = Order::findOrFail($id);
        $data['order'] = $order;
        $data['title'] = 'Order View';
        return view('admin.pages.orders.view')->with($data);
    }
}
