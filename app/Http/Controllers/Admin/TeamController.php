<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TournamentOrder;
use App\Models\TOurnamentUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;

class TeamController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $data['title'] = 'Teams';
        $data['teams'] = TournamentOrder::latest()->paginate(10);

        return view('admin.pages.teams.list')->with($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($id) {
        $team = TournamentOrder::findOrFail($id);
        $data['title'] = $team->team_title;
        $data['team'] = $team;
        $data['tournament'] = $team->tournament;

        return view('admin.pages.teams.view')->with($data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function setSlotNumber(Request $request) {
        $input = $request->except('_token');
        return TOurnamentUser::where('id', $input['id'])->update($input);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveTeam(Request $request) {
        $input = $request->except('_token');
        $team = TournamentOrder::findOrFail($input['id']);
        if (isset($input['username']) && count($input['username'])) {
            $team->team_status = 'pending';
        } else {
            $team->team_status = isset($input['team_status']) ? $input['team_status'] : 'in_game';
            $team->points = isset($input['points']) ? $input['points'] : 0;
            $team->tournament_joining_time = isset($input['joining_date']) ? Carbon::parse($input['joining_date'])->format('Y-m-d') : NULL;
            $team->start_time = isset($input['joining_time']) ? $input['joining_time'] : NULL;;
        }

        if ($team->save()) {
            $status = ['status' => 'success', 'message' => 'Team is ready for play'];
        } else {
            $status = ['status' => 'error', 'message' => 'Something went wrong'];
        }

        return redirect()->back()->with($status);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function wrongUsername(Request $request) {
        $input = $request->except('_token');
        $team = TournamentOrder::findOrFail($input['id']);
        $user = TOurnamentUser::find($input['user_id']);
        $tournament = $team->tournament;

        $data = [
            'tournament_title' => $tournament->tournament_title,
            'username' => $user->username,
            'id' => $user->id
        ];

        Mail::send('email_templates.wrong_username', $data, function ($message) use($team) {
            $message->subject("Username is wrong");
            $message->from('admin@admin.com', 'GECO ADMIN');
            $message->to($team->user->email);
        });

        return TRUE;
    }

    public function sendUsersEmail($id) {
        $team = TournamentOrder::findOrFail($id);
        $users = $team->users;
        $data = [
            'team' => $team,
            'users' => $users
        ];

        Mail::send('email_templates.send-users', $data, function ($message) use($team) {
            $message->subject("Tournament Details");
            $message->from('admin@admin.com', 'GECO ADMIN');
            $message->to($team->user->email);
        });

        return redirect()->back()->with(['status' => 'success', 'message' => 'Team details has been sent']);
    }
}
