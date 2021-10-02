@extends('site.main')

@section('content')
    <main>

        @include('site.layout.breadcrumbs')

        <section class="upcoming-games-area contact-area upcoming-games-bg pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="md-stepper-horizontal orange">
                            <div class="md-step active done">
                                <div class="md-step-circle"><span><i class="fas fa-check"></i></span></div>
                                <div class="md-step-title">Tournaments</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step active">
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
                <div class="card">
                    <div class="card-header">
                        <div class="section-title title-style-three mb-20">
                            <h2><span>{{ $tournament->tournament_title }}</span></h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="section-title title-style-three mb-20">
                                    <h4>Description</h4>
                                </div>
                                <p>{{ $tournament->description }}</p>
                                <hr>
                                <div class="section-title title-style-three mb-20">
                                    <h4>Game</h4>
                                </div>
                                <p>{{ $tournament->game->game_name }}</p>
                                <hr>
                                <div class="section-title title-style-three mb-20">
                                    <h4>Max Allowed</h4>
                                </div>
                                <p>{{ $tournament->max_allow }} {{ $tournament->tournament_type === 'team' ? 'Teams' : 'Players' }}</p>
                                <hr>
                                <div class="section-title title-style-three mb-20">
                                    <h4>Rules</h4>
                                </div>
                                <p>{{ $tournament->rules }}</p>
                            </div>
                            <div class="col-md-6">
                                <div class="section-title title-style-three mb-20">
                                    <h4>Start Date</h4>
                                </div>
                                <p>{{ date('d M, Y', strtotime($tournament->tournament_start_date)) }}</p>
                                <hr>
                                <div class="section-title title-style-three mb-20">
                                    <h4>Start Time</h4>
                                </div>
                                <p>{{ date('h:m:i a', strtotime($tournament->start_time)) }}</p>
                                <hr>
                                <div class="section-title title-style-three mb-20">
                                    <h4>Joined {{ $tournament->tournament_type === 'team' ? 'Teams' : 'Players' }}</h4>
                                </div>
                                <p>{{ $tournament->orders->count() }} {{ $tournament->tournament_type === 'team' ? 'Teams' : 'Players' }}</p>
                                <hr>
                                <div class="section-title title-style-three mb-20">
                                    <h4>Status</h4>
                                </div>
                                <p>{{ ucwords($tournament->status) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('site.tournament.register', $tournament->id) }}" class="btn btn-primary">Participate</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
