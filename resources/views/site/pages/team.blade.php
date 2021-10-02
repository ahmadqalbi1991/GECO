@extends('site.main')

@section('content')
    <main>

        <section class="upcoming-games-area contact-area upcoming-games-bg pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="md-stepper-horizontal orange">
                            <div class="md-step active">
                                <div class="md-step-circle"><span><i class="fas fa-check"></i></span></div>
                                <div class="md-step-title">Tournaments</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step active">
                                <div class="md-step-circle"><span><i class="fas fa-check"></i></span></div>
                                <div class="md-step-title">Tournament</div>
                                <div class="md-step-optional">Detail</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step active">
                                <div class="md-step-circle"><span><i class="fas fa-check"></i></span></div>
                                <div class="md-step-title">Tournament</div>
                                <div class="md-step-optional">Registration</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step active">
                                <div class="md-step-circle"><span><i class="fas fa-check"></i></span></div>
                                <div class="md-step-title">Tournament</div>
                                <div class="md-step-optional">Joined</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="section-title title-style-three mb-20">
                            <h2><span>{{ $team->team_title }}</span></h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="section-title title-style-three mb-20">
                                    <h4>Logo</h4>
                                </div>
                                <img style="width: 250px" src="{{ asset('teams/' . $tournament->tournament_title . '/' . $team->team_logo) }}" alt="">
                                <hr>
                                <div class="section-title title-style-three mb-20">
                                    <h4>Game</h4>
                                </div>
                                <p>{{ $tournament->game->game_name }}</p>
                                <hr>
                                <div class="section-title title-style-three mb-20">
                                    <h4>Rules</h4>
                                </div>
                                <p>{{ $tournament->rules }}</p>
                            </div>
                            <div class="col-md-6">
                                <div class="section-title title-style-three mb-20">
                                    <h4>Start Time</h4>
                                </div>
                                <p>{{ $team->tournament_joining_date ? date('d M, Y (h:m i)', strtotime($team->tournament_joining_date)) : '-----'
                                }}</p>
                                <hr>
                                <div class="section-title title-style-three mb-20">
                                    <h4>Status</h4>
                                </div>
                                <p>{{ ucwords($team->team_status) }}</p>
                                <hr>
                                <div class="section-title title-style-three mb-20">
                                    <h4>{{ $tournament->tournament_type === 'team' ? 'Team' : 'Player' }}</h4>
                                </div>
                                @foreach($team->users as $user)
                                    <p>{{ $user->username }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
{{--                        <a href="{{ route('site.tournament.team.edit', $team->id) }}" class="btn btn-primary">Edit</a>--}}
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
