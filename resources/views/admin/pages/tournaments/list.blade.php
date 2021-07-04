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
                        <a href="{{ route('admin.tournaments.create') }}" class="btn bg-gradient-primary">Add Tournament</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tournament Title</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tournament Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tournament Start Time</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Allowed</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Streaming Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($tournaments) && count($tournaments))
                                        @foreach($tournaments as $tournament)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('games/tournaments/' . $tournament->image) }}" class="avatar avatar-sm me-3">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $tournament->tournament_title }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ strtoupper($tournament->game->game_name) }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ date('d/m/Y', strtotime($tournament->tournament_start_date)) }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $tournament->start_time }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $tournament->max_allow }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ ucwords($tournament->tournament_type) }}</p>
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    <form action="{{ route('admin.tournaments.update', $tournament->id) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="action" value="tournament_status_change">
                                                        <div class="form-group">
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="">Select Status</option>
                                                                <option value="open" {{ $tournament->status == 'open' ? 'selected' : NULL }}>Open</option>
                                                                <option value="streaming" {{ $tournament->status == 'streaming' ? 'selected' : NULL }}>Streaming</option>
                                                                <option value="closed" {{ $tournament->status == 'closed' ? 'selected' : NULL }}>Closed</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-sm bg-gradient-success">Change</button>
                                                    </form>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <form action="{{ route('admin.tournaments.update', $tournament->id) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="action" value="status_change">
                                                        <button type="submit" class="btn btn-sm bg-gradient-{{ $tournament->is_active ? 'success' : 'danger' }}">{{ $tournament->is_active ? 'Active' : 'Deactive' }}</button>
                                                    </form>
                                                </td>

                                                <td class="align-middle" style="display: flex">
                                                    <a href="{{ route('admin.tournaments.edit', $tournament->id) }}" class="badge btn-primary btn-sm m-r-5">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="{{ route('admin.tournaments.show', $tournament->id) }}" class="badge btn-secondary btn-sm m-r-5">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('admin.tournaments.destroy', $tournament->id) }}" method="post">
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
                            {{ $tournaments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
