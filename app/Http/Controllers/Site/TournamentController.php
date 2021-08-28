<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pubg;

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

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tournamentRegister($id) {
        $tournament = Tournament::findOrFail($id);
        $data['tournament'] = $tournament;
        $data['title'] = $tournament->tournament_title . 'Registration';
        $data['bg'] = asset('games/tournaments/' . $tournament->image);

        return view('site.pages.tournament-register')->with($data);
    }

    public function getPlayerDetail(Request $request) {
        $config = new Pubg\Config();
        $config->setApiKey('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiIzYzM3MGYzMC1jOTY5LTAxMzktNjcxYS00Zjc2ZDZiYmJjOWQiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNjI2NTUyNzQ5LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImdlY28ifQ.ZXHV8guNYvFyLDt5om9zC7DfQihcb0VLcQzgu3EubAk');
        $config->setPlatform('pc');

        $api = new Pubg\Api($config);
        $playerService = new Pubg\Player($api);
        $player = $playerService->get('{554747228}');

        dd($player);
    }
}
