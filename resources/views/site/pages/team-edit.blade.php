@extends('site.main')

@section('content')
    <main>

        <section class="upcoming-games-area contact-area upcoming-games-bg pt-120 pb-80">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="section-title title-style-three mb-20">
                            <h2><span>{{ $team->team_title }}</span></h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title title-style-three mb-20">
                                    <h4>{{ $tournament->tournament_type === 'team' ? 'Team' : 'Player' }}</h4>
                                </div>
                                @foreach($team->users as $key => $user)
                                    @php $key++ @endphp
                                    <div class="form-group">
                                        <label for="player{{ $key }}">Player {{ $key }}</label>
                                        <input type="text" name="usernames[$key]" id="player{{ $key }}" class="form-control" value="{{
                                        $user->username }}" disabled>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('site.tournament.team.edit', $tournament->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
