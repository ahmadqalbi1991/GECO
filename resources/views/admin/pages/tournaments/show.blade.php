@extends('admin.main')

@section('content')
    @include('admin.layout.sidebar')
    <main class="main-content mt-1 border-radius-lg">
        @include('admin.layout.navbar')

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="text-right">
                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn bg-gradient-primary">Back</a>
                    </div>
                </div>
            </div>
            <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url({{ asset('games/tournaments/' . $tournament->image) }}); background-position-y: 50%;">
                <span class="mask opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $tournament->tournament_title }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ strtoupper($tournament->game->game_name) }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-controls="overview" aria-selected="true">
                                        <i class="fas fa-gamepad"></i>
                                        <span class="ms-1">Register</span>
                                        <span class="badge bg-primary">0</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Description</h6>
                        </div>
                        <div class="card-body p-3">
                            <p>{{ $tournament->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Rules</h6>
                        </div>
                        <div class="card-body p-3">
                            <p>{{ $tournament->rules }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Maximum @if($tournament->tournament_type == 'team') Teams @else Members @endif</h6>
                        </div>
                        <div class="card-body p-3">
                            <p>{{ $tournament->max_allow }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Tournament Type</h6>
                        </div>
                        <div class="card-body p-3">
                            <p>{{ ucwords($tournament->tournament_type) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Streaming</h6>
                        </div>
                        <div class="card-body p-3">
                            <p>
                                <span class="badge bg-gradient-@if($tournament->status == 'open')success @elseif($tournament->status == 'streaming')warning @elseif($tournament->status == 'closed' || !$tournament->status)danger @endif">
                                    {{ $tournament->status ? $tournament->status : 'Not Started' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
