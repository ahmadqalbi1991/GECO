@extends('site.main')

@section('content')
    <main>
        <section class="contact-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12 pl-45">
                        <div class="row">
                            <div class="col-12 mb-5">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-dark table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th></th>
                                            <th>Tournament</th>
                                            <th>Team Title</th>
                                            <th>Team Logo</th>
                                            <th>Points</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($tournaments))
                                            @php $i = 0; @endphp
                                            @foreach($tournaments as $tournamet)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>
                                                        <img style="width: 100px; height: 100px;" src="{{ asset('games/tournaments/' . $tournamet->tournamet->image) }}" alt="">
                                                    </td>
                                                    <td>{{ $tournamet->tournament->tournament_title }}</td>
                                                    <td>{{ $tournament->team_title }}</td>
                                                    <td>
                                                        <img style="width: 100px; height: 100px;" src="{{ asset('teams/' . $tournamet->tournamet->tournament_title . '/' . $tournamet->team_logo) }}" alt="">
                                                    </td>
                                                    <td>{{ $tournamet->points }}</td>
                                                    <td>{{ strtoupper($tournamet->status) }}</td>
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
