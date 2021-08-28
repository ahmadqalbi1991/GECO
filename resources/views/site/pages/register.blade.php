@extends('site.main')

@section('content')
    <main>

        @include('site.layout.breadcrumbs')

        @if(!Session::has('message') && !Session::has('status'))
        <section class="contact-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12 pl-45">
                        <div class="section-title title-style-three mb-20">
                            <h2>Get Register and <span>enjoy tournaments</span></h2>
                        </div>
                        <div class="contact-form">
                            <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="First Name" name="first_name" class="form-control @error('first_name') is-invalid @enderror">
                                            @error('first_name')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Last Name" name="last_name" class="form-control @error('last_name') is-invalid @enderror">
                                            @error('last_name')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="email" placeholder="Email" name="email" class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Username" name="username" class="form-control @error('username') is-invalid @enderror">
                                            @error('username')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="password" placeholder="Password" name="password" class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror">
                                            @error('confirm_password')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <select name="country" id="country" class="form-control @error('country') is-invalid @enderror">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="file" name="image" id="image" class="form-control">
                                            @error('image')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input type="checkbox" name="terms" class="wauto" id="terms">
                                <label for="terms">I agree to GECO's terms and conditions.</label>
                                @error('terms')
                                <span class="error">{{ $message }}</span>
                                @enderror
                                <button type="submit">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @elseif (Session::has('message') && Session::has('status') && Session::get('status') == 'error')
            <section class="regiration-sucess pt-120 pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="registration-success">
                                <h2>Oops!</h2>
                                <h4>Your order has not been saved. You can reorder your cart from my orders.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
        <section class="regiration-sucess pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="registration-success">
                            <h2>Thank you for joining us.</h2>
                            <h4>Registration Complete. Please check your email address for verification</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </main>
@endsection
