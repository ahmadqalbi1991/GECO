@extends('site.main')

@section('content')
    <main>
        <section class="contact-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-6 offset-3 pl-45">
                        @error('login_fail')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="section-title title-style-three mb-20 text-center">
                            <h2>Change Password</h2>
                        </div>
                        <div class="contact-form login-form">
                            <form action="{{ route('update-password') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Email" name="email"
                                                   class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="password" placeholder="Password" name="password"
                                                   class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="password" placeholder="Confirm Password" name="confirm_password"
                                                   class="form-control @error('confirm_password') is-invalid @enderror">
                                            @error('confirm_password')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
