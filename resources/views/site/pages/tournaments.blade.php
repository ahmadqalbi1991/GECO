@extends('site.main')

@section('content')
    <main>

        @include('site.layout.breadcrumbs')

        <section class="upcoming-games-area upcoming-games-bg pt-120 pb-80">
            <div class="container">
                <div class="row">
                    @if(count($tournaments))
                        @foreach($tournaments as $tournament)
                            <div class="col-lg-4 col-md-6">
                                <div class="upcoming-game-item mb-40">
                                    <div class="upcoming-game-head">
                                        <div class="uc-game-head-title">
                                            <span>{{ date('M d, Y', strtotime($tournament->tournament_start_date)) . ' ' . date('h:i A', strtotime($tournament->start_time)) }}</span>
                                            <h4><a href="#">{{ $tournament->tournament_title }}</a></h4>
                                            <p>{{ $tournament->game->game_name }}</p>
                                            <span>0/{{ $tournament->max_allow }} {{ $tournament->tournament_type == 'team' ? 'Teams' : 'Players' }}</span>
                                        </div>
                                        <div class="uc-game-price">
                                            <h5>{{ $tournament->price ? '$' . $tournament->price : 'FREE' }}</h5>
                                        </div>
                                    </div>
                                    <p>{{ $tournament->description }}</p>
                                    <div class="upcoming-game-thumb">
                                        <img src="{{ asset('games/tournaments/' . $tournament->image) }}" alt="">
                                        <div class="upcoming-game-cart">
                                            <a href="{{ route('site.tournament.detail', $tournament->id) }}" class="btn transparent-btn"><i class="fas fa-sign-in-alt"></i>Participate</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12 col-md-12">
                            <div class="upcoming-game-item mb-40">
                                <div class="text-center">
                                    <h4 style="color: #a0a0a0">No Tournaments</h4>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="text-center">
                    {{ $tournaments->links() }}
                </div>
            </div>
        </section>
    </main>
@endsection
