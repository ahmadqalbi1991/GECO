@extends('site.main')

@section('content')
    <main>

        <section class="contact-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12 pl-45">
                        <div class="row">
                            <div class="col-12 mb-5">
                                <img src="{{ asset($user->image) }}" alt="" style="width: 150px; height: 150px;">
                            </div>
                        </div>
                        <div class="contact-form">
                            <form action="{{ route('site.update-user', $user->id) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="First Name" name="first_name"
                                                   value="{{ explode(' ', $user->name)[0] }}"
                                                   class="form-control @error('first_name') is-invalid @enderror">
                                            @error('first_name')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Last Name" name="last_name"
                                                   value="{{ explode(' ', $user->name)[1] }}"
                                                   class="form-control @error('last_name') is-invalid @enderror">
                                            @error('last_name')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="email" placeholder="Email" name="email"
                                                   value="{{ $user->email }}" readonly disabled
                                                   class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Username" name="username"
                                                   value="{{ $user->username }}" readonly disabled
                                                   class="form-control @error('username') is-invalid @enderror">
                                            @error('username')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <select name="country" id="country"
                                                    class="form-control @error('country') is-invalid @enderror">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                    <option @if($country->id == $user->country_id) selected
                                                            @endif value="{{ $country->id }}">{{ $country->name }}</option>
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
                                <button type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
