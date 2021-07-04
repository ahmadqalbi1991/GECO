<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;

class GameController extends Controller
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
        $data['title'] = 'Games';
        $data['games'] = Game::paginate(10);
        return view('admin.pages.games.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }
        $data['title'] = 'Add Game';
        return view('admin.pages.games.add')->with($data);
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
            'game_name' => 'required',
            'game_type' => 'required',
            'release_date' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = $input['game_name'] . '_' . time() . '.' . $extension;
            $destination = 'games/';
            $image->move($destination, $image_name);
        } else {
            $image_name = NULL;
        }

        if (isset($input['tournament_allow']) && $input['tournament_allow']) {
            $input['tournament_allow'] = 1;
        } else {
            $input['tournament_allow'] = 0;
        }

        if (isset($input['is_active']) && $input['is_active']) {
            $input['is_active'] = 1;
        } else {
            $input['is_active'] = 0;
        }

        if(isset($input['release_date'])) {
            $input['release_date'] = date('Y-m-d', strtotime($input['release_date']));
        }

        unset($input['_token']);
        $input['image'] = $image_name;
        $result = Game::firstOrCreate($input);
        if ($result) {
            return redirect()->route('admin.games.index')->with(['status' => 'success', 'message' => 'Game addedd successfully']);
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
        $game = Game::findOrFail($id);
        $data['title'] = $game->game_name;
        $data['game'] = $game;

        return view('admin.pages.games.show')->with($data);
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
        $data['title'] = 'Edit Game';
        $data['game'] = Game::findOrFail($id);
        return view('admin.pages.games.edit')->with($data);
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
        $game = Game::findOrFail($id);
        $msg = '';

        if (isset($input['action'])) {
            if ($input['action'] === 'tournament_status_change') {
                $status = $game->tournament_allow == 1 ? 0 : 1;
                $game->tournament_allow = $status;
                $msg = 'Tournament status changed successfully';
            } elseif ($input['action'] === 'status_change') {
                $status = $game->is_active == 1 ? 0 : 1;
                $game->is_active = $status;
                $msg = 'Status changed successfully';
            }
        } else {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $image_name = $input['game_name'] . '_' . time() . '.' . $extension;
                $destinantion = 'games/';
                $image->move($destinantion, $image_name);
            } else {
                $image_name = $game->image ? $game->image : NULL;
            }

            if (isset($input['tournament_allow']) && $input['tournament_allow']) {
                $input['tournament_allow'] = 1;
            } else {
                $input['tournament_allow'] = 0;
            }

            if (isset($input['is_active']) && $input['is_active']) {
                $input['is_active'] = 1;
            } else {
                $input['is_active'] = 0;
            }

            if(isset($input['release_date'])) {
                $input['release_date'] = date('Y-m-d', strtotime($input['release_date']));
            }

            unset($input['_token']);
            unset($input['_method']);
            $input['image'] = $image_name;
            $result = Game::where('id', $id)->update($input);
            if ($result) {
                return redirect()->back()->with(['status' => 'success', 'message' => 'Game updated successfully']);
            } else {
                return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong']);
            }
        }

        if ($game->save()) {
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
        $result = Game::where('id', $id)->delete();
        if ($result) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Game deleted successfully']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }
}
