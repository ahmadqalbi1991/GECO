<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
     *
     */
    public function home()
    {
        $data['title'] = 'Home';
        return view('site.pages.index')->with($data);
    }

    public function tournaments() {
        $data['title'] = 'Tournaments';
        $data['bg'] = asset('site/img/images/tt.jpg');
        $tournaments = Tournament::whereIn('status', ['open', 'streaming'])
            ->where('is_active', 1)
            ->paginate(9);

        $data['tournaments'] = $tournaments;
        return view('site.pages.tournaments')->with($data);
    }
}
