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
                        <a href="{{ route('admin.games.create') }}" class="btn bg-gradient-primary">Add Game</a>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Game Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tournament Allow</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($games) && count($games))
                                            @foreach($games as $game)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="{{ asset('games/' . $game->image) }}" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $game->game_name }}</h6>
                                                                <p class="text-xs text-secondary mb-0">{{ strtoupper($game->game_type) }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <form action="{{ route('admin.games.update', $game->id) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <input type="hidden" name="action" value="tournament_status_change">
                                                            <button type="submit" class="btn btn-sm bg-gradient-{{ $game->tournament_allow ? 'success' : 'danger' }}">{{ $game->tournament_allow ? 'On' : 'Off' }}</button>
                                                        </form>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <form action="{{ route('admin.games.update', $game->id) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <input type="hidden" name="action" value="status_change">
                                                            <button type="submit" class="btn btn-sm bg-gradient-{{ $game->is_active ? 'success' : 'danger' }}">{{ $game->is_active ? 'Active' : 'Deactive' }}</button>
                                                        </form>
                                                    </td>

                                                    <td class="align-middle" style="display: flex">
                                                        <a href="{{ route('admin.games.edit', $game->id) }}" class="badge btn-primary btn-sm m-r-5">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="{{ route('admin.games.show', $game->id) }}" class="badge btn-secondary btn-sm m-r-5">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form action="{{ route('admin.games.destroy', $game->id) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="badge btn-sm bg-gradient-danger"><i class="fas fa-trash"></i></button>
                                                        </form>
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
                            {{ $games->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
