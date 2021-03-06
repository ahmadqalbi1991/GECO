@extends('site.main')

@section('content')
    <main>

        @include('site.layout.breadcrumbs')

        <section class="upcoming-games-area upcoming-games-bg pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="md-stepper-horizontal orange">
                                    <div class="md-step active">
                                        <div class="md-step-circle"><span>1</span></div>
                                        <div class="md-step-title">Tournaments</div>
                                        <div class="md-step-bar-left"></div>
                                        <div class="md-step-bar-right"></div>
                                    </div>
                                    <div class="md-step">
                                        <div class="md-step-circle"><span>2</span></div>
                                        <div class="md-step-title">Tournament</div>
                                        <div class="md-step-optional">Detail</div>
                                        <div class="md-step-bar-left"></div>
                                        <div class="md-step-bar-right"></div>
                                    </div>
                                    <div class="md-step">
                                        <div class="md-step-circle"><span>3</span></div>
                                        <div class="md-step-title">Tournament</div>
                                        <div class="md-step-optional">Registration</div>
                                        <div class="md-step-bar-left"></div>
                                        <div class="md-step-bar-right"></div>
                                    </div>
                                    <div class="md-step">
                                        <div class="md-step-circle"><span>4</span></div>
                                        <div class="md-step-title">Tournament</div>
                                        <div class="md-step-optional">Joined</div>
                                        <div class="md-step-bar-left"></div>
                                        <div class="md-step-bar-right"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

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
                                            <span>{{ $tournament->orders->count() }}/{{ $tournament->max_allow }} {{ $tournament->tournament_type ==
                                            'team' ? 'Teams' :
                                            'Players'
                                            }}</span>
                                        </div>
                                        <div class="uc-game-price">
                                            <h5>{{ $tournament->price ? '$' . $tournament->price : 'FREE' }}</h5>
                                        </div>
                                    </div>
                                    <p>{{ $tournament->description }}</p>
                                    <div class="upcoming-game-thumb">
                                        <img src="{{ asset('games/tournaments/' . $tournament->image) }}" alt="">
                                        <div class="upcoming-game-cart">
                                            <a href="{{ route('site.tournament.detail', $tournament->id) }}"
                                               class="btn transparent-btn"><i class="fas fa-sign-in-alt"></i>Participate</a>
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
