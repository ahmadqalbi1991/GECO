@extends('admin.main')

@section('content')
    @include('admin.layout.sidebar')
    <main class="main-content mt-1 border-radius-lg">
        @include('admin.layout.navbar')
        @include('admin.layout.alert')

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="text-right">
                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn bg-gradient-primary">Back</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body ">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Team Title</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Joining Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Points</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Team Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($teams) && count($teams))
                                        @foreach($teams as $team)
                                            <tr>
                                                <td>{{ $team->team_title }}</td>
                                                <td>
                                                    <img style="width: 100px;" src="{{ asset('teams/' . $team->tournament->tournament_title . '/' .
                                                    $team->team_logo)
                                                    }}" alt="">
                                                </td>
                                                <td class="text-center">{{ \Carbon\Carbon::parse($team->created_at)->format('d M, Y (h:m A)') }}</td>
                                                <td class="text-center">{{ $team->points }}</td>
                                                <td class="text-center">{{ strtoupper($team->team_status) }}</td>
                                                <td class="text-center">
                                                    @if($team->team_status == 'pending')
                                                        <a href="{{ route('admin.team.view', $team->id) }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('admin.team.view', $team->id) }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">No data</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $teams->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
