<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }
        $data['title'] = 'Products';
        $data['products'] = Product::paginate(10);
        return view('admin.pages.products.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }
        $data['title'] = 'Add Product';
        return view('admin.pages.products.add')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }

        $validation = Validator::make($request->all(), [
            'product_name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'sku_code' => 'required',
            'description' => 'required',
            'image' => 'required',
            'inventory' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = $input['product_name'] . '_' . time() . '.' . $extension;
            $destination = 'products/';
            $image->move($destination, $image_name);
        } else {
            $image_name = NULL;
        }

        if (isset($input['is_active']) && $input['is_active']) {
            $input['is_active'] = 1;
        } else {
            $input['is_active'] = 0;
        }

        unset($input['_token']);
        $input['image'] = $image_name;
        $result = Product::firstOrCreate($input);
        if ($result) {
            return redirect()->route('admin.products.index')->with(['status' => 'success', 'message' => 'Product addedd successfully']);
        } else {
            return redirect()->back()->withErrors(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $data['title'] = $product->product_name;
        $data['product'] = $product;

        return view('admin.pages.products.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }
        $data['title'] = 'Edit Product';
        $data['product'] = Product::findOrFail($id);
        return view('admin.pages.products.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $product = Product::findOrFail($id);
        $msg = '';

        if (isset($input['action'])) {
            if ($input['action'] === 'tournament_status_change') {
                $status = $product->tournament_allow == 1 ? 0 : 1;
                $product->tournament_allow = $status;
                $msg = 'Tournament status changed successfully';
            } elseif ($input['action'] === 'status_change') {
                $status = $product->is_active == 1 ? 0 : 1;
                $product->is_active = $status;
                $msg = 'Status changed successfully';
            }
        } else {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $image_name = $input['product_name'] . '_' . time() . '.' . $extension;
                $destinantion = 'products/';
                $image->move($destinantion, $image_name);
            } else {
                $image_name = $product->image ? $product->image : NULL;
            }

            if (isset($input['is_active']) && $input['is_active']) {
                $input['is_active'] = 1;
            } else {
                $input['is_active'] = 0;
            }

            unset($input['_token']);
            unset($input['_method']);
            $input['image'] = $image_name;
            $result = Product::where('id', $id)->update($input);
            if ($result) {
                return redirect()->back()->with(['status' => 'success', 'message' => 'Product updated successfully']);
            } else {
                return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong']);
            }
        }

        if ($product->save()) {
            return redirect()->back()->with(['status' => 'success', 'message' => $msg]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Product::where('id', $id)->delete();
        if ($result) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Product deleted successfully']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }
}
