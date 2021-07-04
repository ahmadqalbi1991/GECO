@extends('admin.main')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                        <div class="card-body px-0 pt-0 pb-2">
                            <form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="game_name" class="control-label">Game Name</label>
                                            <input type="text" placeholder="Please enter game name" name="game_name"
                                                       id="game_name" class="form-control" value="{{ $game->game_name }}" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="game_type" class="control-label">Game Type</label>
                                        <select name="game_type" id="game_type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option {{ $game->game_type == 'action' ? 'selected' : NULL }} value="action">Action</option>
                                            <option {{ $game->game_type == 'rpg' ? 'selected' : NULL }} value="rpg">Role Playing Game (RPG)</option>
                                            <option {{ $game->game_type == 'mmo' ? 'selected' : NULL }} value="mmo">Massively Multiplayer Online (MMO)</option>
                                            <option {{ $game->game_type == 'action_adventure' ? 'selected' : NULL }} value="action_adventure">Action Adventure</option>
                                            <option {{ $game->game_type == 'adventure' ? 'selected' : NULL }} value="adventure">Adventure</option>
                                            <option {{ $game->game_type == 'simulation' ? 'selected' : NULL }} value="simulation">Simulation</option>
                                            <option {{ $game->game_type == 'strategy' ? 'selected' : NULL }} value="strategy">Strategy</option>
                                            <option {{ $game->game_type == 'puzzle' ? 'selected' : NULL }} value="puzzle">Puzzle</option>
                                            <option {{ $game->game_type == 'idle' ? 'selected' : NULL }} value="idle">Idle</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="release_date" class="control-label">Release Date</label>
                                            <div class="input-group mb-4">
                                                <span class="input-group-text"><i
                                                        class="ni ni-calendar-grid-58"></i></span>
                                                <input value="{{ date('d-m-Y', strtotime($game->release_date)) }}" placeholder="Please select date" name="release_date" type="text" class="form-control" id="datepicker">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <label for="tournament_allow">Tournament Allow</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                                   name="tournament_allow" {{ $game->tournament_allow ? 'checked' : NULL }}>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <label for="is_active">Is Active</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                                   name="is_active" {{ $game->is_active ? 'checked' : NULL }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="release_date" class="control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" rows="5"
                                                      placeholder="Description">{{ $game->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-right">
                                            <button type="submit" class="btn bg-gradient-success">Save</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Last Image</label>
                                            <div class="game-img-wrapper">
                                                <img src="{{ asset('games/' . $game->image) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
                format: "dd-mm-yyyy"
            });
        } );
    </script>

@endsection
