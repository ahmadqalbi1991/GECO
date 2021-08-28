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
                        <div class="card-body ">
                            <form action="{{ route('admin.tournaments.update', $tournament->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="tournament_title" class="control-label">Tournament Title</label>
                                            <input type="text" placeholder="Please enter tournament title" name="tournament_title"
                                                   id="tournament_title" value="{{ $tournament->tournament_title }}" class="form-control @error('tournament_title') is-invalid @enderror">
                                            @error('tournament_title')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="game_id" class="control-label">Game</label>
                                            <select name="game_id" id="game_id" class="form-control @error('game_id') is-invalid @enderror">
                                                <option value="">Select Game</option>
                                                @foreach($games as $game)
                                                    <option @if ($tournament->game_id == $game->id) selected @endif value="{{ $game->id }}">{{ $game->game_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('game_id')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="tournament_start_at" class="form-control-label">Datetime</label>
                                            <input name="tournament_start_at" class="form-control @error('tournament_start_at') is-invalid @enderror" type="datetime-local" value="{{ date('Y-m-d', strtotime($tournament->tournament_start_date)) . 'T' . date('h:m:i', strtotime($tournament->start_time)) }}" id="tournament_start_at">
                                            @error('tournament_start_at')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="price" class="form-control-label">Price</label>
                                            <input name="price" class="form-control @error('price') is-invalid @enderror" type="number" value="{{ $tournament->price }}" id="price">
                                            @error('price')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="tournament_type">Tournament Type</label>
                                            <select name="tournament_type" id="tournament_type" class="form-control @error('tournament_type') is-invalid @enderror">
                                                <option value="">Select Type</option>
                                                <option @if($tournament->tournament_type == 'team') selected @endif value="team">Team</option>
                                                <option @if($tournament->tournament_type == 'individual') selected @endif value="individual">Individual Player</option>
                                            </select>
                                            @error('tournament_type')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="max_allow">Maximum Allowed</label>
                                            <input type="number" value="{{ $tournament->max_allow }}" name="max_allow" class="form-control @error('max_allow') is-invalid @enderror" id="max_allow" min="10">
                                            @error('max_allow')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="description" class="control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                                                      placeholder="Description">{{ $tournament->description }}</textarea>
                                            @error('description')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="rules" class="control-label">Rules</label>
                                            <textarea name="rules" id="rules" class="form-control @error('rules') is-invalid @enderror" rows="5"
                                                      placeholder="Description">{{ $tournament->rules }}</textarea>
                                            @error('rules')
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
                                        <div class="form-group">
                                            <label>Last Image</label>
                                            <div class="game-img-wrapper">
                                                <img src="{{ asset('games/tournaments/' . $tournament->image) }}">
                                            </div>
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

@endsection
