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
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body ">
                            <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="paypal_username" class="control-label">Paypal Username</label>
                                            <input type="text" placeholder="" name="paypal_username"
                                                   id="paypal_username"
                                                   class="form-control @error('paypal_username') is-invalid @enderror"
                                                   value="{{ $setting->paypal_username }}">
                                            @error('paypal_username')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="paypal_password" class="control-label">Paypal Password</label>
                                            <input type="text" placeholder="" name="paypal_password"
                                                   id="paypal_password"
                                                   class="form-control @error('paypal_password') is-invalid @enderror"
                                                   value="{{ $setting->paypal_password }}">
                                            @error('paypal_password')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="paypal_secret" class="control-label">Paypal Secret key</label>
                                            <input type="text" placeholder="" name="paypal_secret"
                                                   id="paypal_secret"
                                                   class="form-control @error('paypal_secret') is-invalid @enderror"
                                                   value="{{ $setting->paypal_secret }}">
                                            @error('paypal_secret')
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

@endsection
