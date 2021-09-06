@extends('site.main')

@section('content')
    <main>

        <section class="upcoming-games-area contact-area upcoming-games-bg pt-120 pb-80">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="section-title title-style-three mb-20">
                            <h2><span>Invalid Username</span></h2>
                        </div>
                    </div>
                    <form action="{{ route('site.tournament.team.update-username') }}" method="post" id="tournament-form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"
                                           placeholder="Enter Your Team Title" value="{{ $user->username }}">
                                    @error('username')
                                    <span>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Update Username</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

@endsection
