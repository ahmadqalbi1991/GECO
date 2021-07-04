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
                            <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="game_name" class="control-label">Game Name</label>
                                            <input type="text" placeholder="Please enter game name" name="game_name"
                                                   id="game_name" class="form-control @error('game_name') is-invalid @enderror" value="{{ old('game_name') }}">
                                            @error('game_name')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="game_type" class="control-label">Game Type</label>
                                            <select name="game_type" id="game_type" class="form-control @error('game_type') is-invalid @enderror">
                                                <option value="">Select Type</option>
                                                <option value="action">Action</option>
                                                <option value="rpg">Role Playing Game (RPG)</option>
                                                <option value="mmo">Massively Multiplayer Online (MMO)</option>
                                                <option value="action_adventure">Action Adventure</option>
                                                <option value="adventure">Adventure</option>
                                                <option value="simulation">Simulation</option>
                                                <option value="strategy">Strategy</option>
                                                <option value="puzzle">Puzzle</option>
                                                <option value="idle">Idle</option>
                                            </select>
                                            @error('game_type')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="release_date" class="control-label">Release Date</label>
                                            <div class="input-group mb-4">
                                                <span class="input-group-text"><i
                                                        class="ni ni-calendar-grid-58"></i></span>
                                                <input placeholder="Please select date" name="release_date" type="text" class="form-control @error('release_date') is-invalid @enderror" id="datepicker">
                                            </div>
                                            @error('release_date')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <label for="tournament_allow">Tournament Allow</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                                   name="tournament_allow" checked="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <label for="is_active">Is Active</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                                   name="is_active" checked="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="description" class="control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                                                      placeholder="Description"></textarea>
                                            @error('description')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
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
