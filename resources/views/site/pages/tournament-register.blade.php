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
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Player 1</label>
                                        <input type="text" name="player_1" id="player_1" class="form-control username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Player 2</label>
                                        <input type="text" name="player_2" id="player_2" class="form-control username">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Player 3</label>
                                        <input type="text" name="player_3" id="player_3" class="form-control username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Player 4</label>
                                        <input type="text" name="player_4" id="player_4" class="form-control username">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-footer">
                        <a href="{{ route('site.tournament.register', $tournament->id) }}" class="btn btn-primary">Join Participate</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
