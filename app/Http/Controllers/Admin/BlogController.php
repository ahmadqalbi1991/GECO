<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }
        $data['title'] = 'Blogs';
        $data['blogs'] = Blog::paginate(10);
        return view('admin.pages.blogs.list')->with($data);
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
        $data['title'] = 'Add Blog';

        return view('admin.pages.blogs.add')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }

        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $input = $request->except('_token');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = $input['title'] . '_' . time() . '.' . $extension;
            $destination = 'blogs/';
            $image->move($destination, $image_name);
        } else {
            $image_name = NULL;
        }

        $input['image'] = $image_name;
        $input['user_id'] = Auth::id();
        $result = Blog::create($input);
        if ($result) {
            return redirect()->route('admin.blogs.index')->with(['status' => 'success', 'message' => 'Blog addedd successfully']);
        } else {
            return redirect()->back()->withErrors(['status' => 'error', 'message' => 'Something went wrong']);
        }
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
        $data['title'] = 'Edit Blog';
        $data['blog'] = Blog::findOrFail($id);

        return view('admin.pages.blogs.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);
        $blog = Blog::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = $input['title'] . '_' . time() . '.' . $extension;
            $destination = 'blogs/';
            $image->move($destination, $image_name);
        } else {
            $image_name = $blog->image;
        }

        $input['image'] = $image_name;
        $result = Blog::where('id', $id)->update($input);

        if ($result) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Blog Published']);
        } else {
            return redirect()->back()->withErrors(['status' => 'error', 'message' => 'Something went wrong']);
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
        $blog = Blog::findOrFail($id);

        if ($blog->delete()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Blog Deleted']);
        } else {
            return redirect()->back()->withErrors(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }
}
