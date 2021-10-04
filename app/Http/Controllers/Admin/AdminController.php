<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;

class AdminController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard(Request $request) {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }

        $data['title'] = 'Dashboard';
        $orders = Order::all();
        $categories_wise_sale = [];
        $categories = [
            'console' => 0, 'headphones' => 0, 'gamepad' => 0, 'gamecontroller' => 0, 'games' => 0
        ];

        foreach ($orders as $key => $order) {
            $items = $order->items;
            foreach ($items as $key1 => $item) {
                $product = $item->product;
                foreach ($categories as $key2 => $category) {
                    if ($product->category == $key2) {
                        $sum = $category + 1;
                        $categories_wise_sale[$key2] = $sum;
                        $categories[$key2] = $sum;
                    } else {
                        $categories_wise_sale[$key2] = $category;
                    }
                }
            }
        }

        $sales = [];
        $i = 0;
        foreach($categories_wise_sale as $category) {
            array_push($sales, $category);
        }

        $data['sales'] = '[' . implode(',', $sales) . ']';
        $no_of_days =Carbon::now()->daysInMonth;
        $dates = $monthly_sales = [];
        $i = 0;
        for($day = 1; $day <= $no_of_days; $day++) {
            $date = Carbon::createFromDate(Carbon::now()->format('Y'), Carbon::now()->format('m'), $day);
            $dates[$i] = $date->format("d");
            $sale = Order::where('order_time', '=', $date->format('Y-m-d'))->sum('total');;
            $monthly_sales[$i] = $sale;
            $i++;
        }

        $data['dates'] = implode(',', $dates);
        $data['monthly_sales'] = '[' . implode(',', $monthly_sales) . ']';

        return view('admin.pages.dashboard')->with($data);
    }

    public function login() {
        $data['title'] = 'Login';
        return view('admin.pages.login')->with($data);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
