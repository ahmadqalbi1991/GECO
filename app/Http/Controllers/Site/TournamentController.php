<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tournamentDetail($id) {
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

}
