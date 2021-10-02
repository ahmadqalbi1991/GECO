<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Tournament;
use App\Models\TournamentOrder;
use App\Models\TOurnamentUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator, Mail;

class TournamentController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tournamentDetail($id)
    {
        if (!Auth::user()) {
            return redirect()->route('site.user.login');
        } else {
            $tournament = Tournament::findOrFail($id);
            $data['tournament'] = $tournament;
            $data['title'] = $tournament->tournament_title;
            $data['bg'] = asset('games/tournaments/' . $tournament->image);

            return view('site.pages.tournament')->with($data);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tournamentRegister($id)
    {
        $tournament = Tournament::findOrFail($id);
        $data['tournament'] = $tournament;
        $data['title'] = $tournament->tournament_title . 'Registration';
        $data['bg'] = asset('games/tournaments/' . $tournament->image);

        return view('site.pages.tournament-register')->with($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payTournament(Request $request)
    {
        $input = $request->except('_token');
        if (isset($input['pay_method']) && $input['pay_method'] != 'paypal') {
            $validation = Validator::make($request->all(), [
                'team_title' => 'required',
                'image' => 'required'
            ]);

            if ($validation->fails) {
                return redirect()->back()->withErrors($validation->errors());
            }
        }

        $tournament = Tournament::findOrFail($input['tournament_id']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = $tournament->tournament_title . '_' . time() . '.' . $extension;
            $destination = 'teams/' . $tournament->tournament_title . '/';
            $image->move($destination, $image_name);
        } else {
            $image_name = NULL;
        }

        $order = [
            'user_id' => Auth::id(),
            'tournament_id' => $input['tournament_id'],
            'points' => 0,
            'team_status' => 'pending',
            'team_logo' => $image_name,
            'team_title' => $input['team_title'],
            'created_at' => Carbon::now()
        ];

        $order_id = TournamentOrder::insertGetId($order);
        if ($order_id) {
            $users = $input['usernames'];
            $names = $input['names'];
            $team = TournamentOrder::findOrFail($order_id);
            foreach ($users as $key => $user) {
                TOurnamentUser::create([
                    'tournament_order_id' => $order_id,
                    'username' => $user,
                    'name' => $names[$key]
                ]);
            }

            Mail::send('email_templates.team_register', $tournament->toArray(), function ($message) use($team) {
                $message->subject("Tournament Registration Successfull");
                $message->from('admin@admin.com', 'GECO ADMIN');
                $message->to($team->user->email);
            });

            return redirect()->route('site.tournament.team.view', $order_id)->with(['status' => 'success', 'message' => 'You are registered in ' .
                $tournament->tournament_title . ' tournament. You will receive an email for tournament further details']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teamView($id) {
        $team = TournamentOrder::findOrFail($id);
        $tournament = $team->tournament;
        $data['team'] = $team;
        $data['tournament'] = $tournament;
        $data['title'] = 'Team';

        return view('site.pages.team')->with($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPlayer($id) {
        $team = TournamentOrder::findOrFail($id);
        $tournament = $team->tournament;
        $data['team'] = $team;
        $data['tournament'] = $tournament;
        $data['title'] = 'Team';

        return view('site.pages.team-edit')->with($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changeUsername($id) {
        $user = TOurnamentUser::findOrFail($id);
        $data['title'] = 'Invalid Username';
        $data['user'] = $user;

        return view('site.pages.invalid-username')->with($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateUsername(Request $request) {
        $input = $request->except('_token');
        $user = TOurnamentUser::find($input['id']);
        $user->username = $input['username'];
        if ($user->save()) {
            $message = [
                'user_id' => $user->tournament_order->user_id,
                'name' => $user->tournament_order->user->name,
                'email' => $user->tournament_order->user->email,
                'subject' => 'Username Updated',
                'message' => 'User has updated username for team ' . $user->tournament_order->team_title . '. New user name is ' . $input['username']
            ];

            Message::create($message);
        }

        $data['title'] = 'Username Submitted';
        $data['message1'] = 'Thank you for updating username.';
        $data['message2'] = 'We will contact you after reviewing your query in 24 hours. You will receive an email for tournament details.';

        return view('site.pages.username-submit')->with($data);
    }
}
