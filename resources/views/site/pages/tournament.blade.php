@extends('site.main')

@section('content')
    <main>

        @include('site.layout.breadcrumbs')

        <section class="upcoming-games-area contact-area upcoming-games-bg pt-120 pb-80">
            <div class="container">
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
                                <p>0 {{ $tournament->tournament_type === 'team' ? 'Teams' : 'Players' }}</p>
                                <hr>
                                <div class="section-title title-style-three mb-20">
                                    <h4>Status</h4>
                                </div>
                                <p>{{ ucwords($tournament->status) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('site.tournament.register', $tournament->id) }}" class="btn btn-primary">Join Participate</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
