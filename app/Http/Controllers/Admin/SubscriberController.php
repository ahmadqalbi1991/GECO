<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $data['title'] = 'Subscribers';
        $data['subscribers'] = Subscriber::latest()->paginate(10);

        return view('admin.pages.subscribers')->with($data);
    }
}
