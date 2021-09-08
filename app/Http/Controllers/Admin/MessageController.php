<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Mail;

class MessageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $data['title'] = 'Messages';
        $data['messages'] = Message::latest()->paginate(10);

        return view('admin.pages.messages')->with($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($id) {
        $message = Message::findOrFail($id);
        $message->is_read = 1;
        $message->save();
        $data['title'] = $message->subject;
        $data['message'] = $message;

        return view('admin.pages.message')->with($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reply($id) {
        $message = Message::findOrFail($id);
        $message->is_read = 1;
        $message->save();
        $data['title'] = $message->subject;
        $data['message'] = $message;

        return view('admin.pages.message-edit')->with($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request) {
        $input = $request->except('_token');
        $msg = Message::findOrFail($input['id']);
        $data = [
            'my_message' => $input['message']
        ];

        Mail::send('email_templates.message', $data, function ($message) use($msg, $input) {
            $message->subject($input['subject']);
            $message->from('admin@admin.com', 'GECO ADMIN');
            $message->to($msg->email);
        });

        return redirect()->route('admin.messages')->with(['status' => 'success', 'message' => 'Email has been sent']);
    }

    public function delete($id) {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages')->with(['status' => 'success', 'message' => 'Message deleted']);
    }
}
