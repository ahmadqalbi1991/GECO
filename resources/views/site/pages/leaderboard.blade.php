@extends('site.main')

@section('content')
    <main>
        <section class="contact-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12 pl-45">
                        <div class="row">
                            <div class="col-12 mb-5">
                                <h3 class="text-dark">Leaderboard</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-dark table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th></th>
                                            <th>Team Title</th>
                                            <th>Points</th>
                                            <th>Status</th>
                                            <th>Position</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($teams))
                                            @php $i = 0; @endphp
                                            @foreach($teams as $key => $team)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>
                                                        <img style="width: 100px; height: 100px;"
                                                             src="{{ asset('teams/' . $team->tournament->tournament_title . '/' . $team->team_logo) }}"
                                                             alt="">
                                                    </td>
                                                    <td>{{ $team->team_title }}</td>
                                                    <td>{{ $team->points }}</td>
                                                    <td>{{ str_replace('_', ' ', strtoupper($team->team_status)) }}</td>
                                                    <td>{{ $key + 1 }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">No Tournaments Joined</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
