<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class Customers extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $data['title'] = 'Customers';
        $data['customers'] = User::where('is_admin', 0)->paginate(10);

        return view('admin.pages.users')->with($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCustomer($id) {
        $user = User::findOrFail($id);
        foreach ($user->orders as $order) {
            $order->items()->delete();
        }

        foreach ($user->tournaments as $tournament) {
            $tournament->users()->delete();
        }

        $user->tournaments()->delete();
        $user->orders()->delete();
        $result = $user->delete();

        if ($result) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Customer deleted successfully']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }
}
