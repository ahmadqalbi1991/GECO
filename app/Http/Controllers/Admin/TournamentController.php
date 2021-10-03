<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Tournament;
use App\Models\TournamentOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TournamentController extends Controller
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
        $data['title'] = 'Tournaments';
        $data['tournaments'] = Tournament::paginate(10);

        return view('admin.pages.tournaments.list')->with($data);
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
        $data['title'] = 'Add Tournament';
        $data['games'] = Game::where(['tournament_allow' => 1, 'is_active' => 1])->get();

        return view('admin.pages.tournaments.add')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }

        $validation = Validator::make($request->all(), [
            'tournament_title' => 'required',
            'game_id' => 'required',
            'tournament_start_at' => 'required',
            'tournament_type' => 'required',
            'max_allow' => 'required|numeric|min:10',
            'description' => 'required',
            'rules' => 'required',
            'image' => 'required',
            'price' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = $input['tournament_title'] . '_' . time() . '.' . $extension;
            $destination = 'games/tournaments/';
            $image->move($destination, $image_name);
        } else {
            $image_name = NULL;
        }

        if (isset($input['tournament_start_at'])) {
            $tournament_start_at = explode('T', $input['tournament_start_at']);
            unset($input['tournament_start_at']);
            $input['tournament_start_date'] = $tournament_start_at[0];
            $input['start_time'] = $tournament_start_at[1];
        }

        unset($input['_token']);
        $input['image'] = $image_name;
        $result = Tournament::firstOrCreate($input);
        if ($result) {
            return redirect()->route('admin.tournaments.index')->with(['status' => 'success', 'message' => 'Tournament added successfully']);
        } else {
            return redirect()->back()->withErrors(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }

        $tournamet = Tournament::findOrFail($id);
        $data['title'] = $tournamet->tournament_title;
        $data['tournament'] = $tournamet;

        return view('admin.pages.tournaments.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }
        $data['title'] = 'Edit Tournament';
        $data['games'] = Game::where(['tournament_allow' => 1, 'is_active' => 1])->get();
        $data['tournament'] = Tournament::findOrFail($id);

        return view('admin.pages.tournaments.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $tournament = Tournament::findOrFail($id);

        if (isset($input['action'])) {
            if ($input['action'] == 'tournament_status_change') {
                if (isset($input['status'])) {
                    $tournament->status = $input['status'];
                    $msg = 'Tournament status changed to ' . $input['status'];
                }
            } elseif ($input['action'] == 'status_change') {
                $status = $tournament->is_active == 1 ? 0 : 1;
                $tournament->is_active = $status;
                $msg = 'Status changed successfully';
            }
        } else {
            $input = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $image_name = $input['tournament_title'] . '_' . time() . '.' . $extension;
                $destination = 'games/tournaments/';
                $image->move($destination, $image_name);
            } else {
                $image_name = $tournament->image ? $tournament->image : NULL;
            }

            if (isset($input['tournament_start_at'])) {
                $tournament_start_at = explode('T', $input['tournament_start_at']);
                unset($input['tournament_start_at']);
                $input['tournament_start_date'] = $tournament_start_at[0];
                $input['start_time'] = $tournament_start_at[1];
            }

            unset($input['_token']);
            unset($input['_method']);
            $input['image'] = $image_name;
            $result = Tournament::where('id', $id)->update($input);
            if ($result) {
                return redirect()->back()->with(['status' => 'success', 'message' => 'Tournament updated successfully']);
            } else {
                return redirect()->back()->withErrors(['status' => 'error', 'message' => 'Something went wrong']);
            }
        }

        if ($tournament->save()) {
            return redirect()->back()->with(['status' => 'success', 'message' => $msg]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Tournament::where('id', $id)->delete();
        if ($result) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Tournament deleted successfully']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    public function leaderboard(Request $request)
    {
        $id = $request->get('tournament_id', NULL);
        $data['title'] = 'Leaderboard';
        $teams = TournamentOrder::where('tournament_id', $id)->get();
        $ranks = $teams->unique('points')
            ->values()
            ->mapWithKeys(function ($item, $index) {
                return [$item['points'] => $index + 1];
            });
        $data['teams'] = $teams;
        $data['ranks'] = $ranks;
        $data['tournaments'] = Tournament::all();
        $data['id'] = $id;

        return view('admin.pages.leaderboard')->with($data);
    }
}
