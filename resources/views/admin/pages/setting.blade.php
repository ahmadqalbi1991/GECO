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
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="facebook_url" class="control-label">Facebook URL</label>
                                            <input type="text" placeholder="" name="facebook_url"
                                                   id="facebook_url"
                                                   class="form-control @error('facebook_url') is-invalid @enderror"
                                                   value="{{ $setting->facebook_url }}">
                                            @error('facebook_url')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="twitter_url" class="control-label">Twitter URL</label>
                                            <input type="text" placeholder="" name="twitter_url"
                                                   id="twitter_url"
                                                   class="form-control @error('twitter_url') is-invalid @enderror"
                                                   value="{{ $setting->twitter_url }}">
                                            @error('twitter_url')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="pinterst_url" class="control-label">Pinterest URL</label>
                                            <input type="text" placeholder="" name="pinterst_url"
                                                   id="pinterst_url"
                                                   class="form-control @error('pinterst_url') is-invalid @enderror"
                                                   value="{{ $setting->pinterst_url }}">
                                            @error('pinterst_url')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="linkedin_url" class="control-label">Linkedin URL</label>
                                            <input type="text" placeholder="" name="linkedin_url"
                                                   id="linkedin_url"
                                                   class="form-control @error('linkedin_url') is-invalid @enderror"
                                                   value="{{ $setting->linkedin_url }}">
                                            @error('linkedin_url')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="youtube_url" class="control-label">Youtube URL</label>
                                            <input type="text" placeholder="" name="youtube_url"
                                                   id="youtube_url"
                                                   class="form-control @error('youtube_url') is-invalid @enderror"
                                                   value="{{ $setting->youtube_url }}">
                                            @error('youtube_url')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="streaming_url" class="control-label">Streaming URL</label>
                                            <input type="text" placeholder="" name="streaming_url"
                                                   id="streaming_url"
                                                   class="form-control @error('streaming_url') is-invalid @enderror"
                                                   value="{{ $setting->streaming_url }}">
                                            @error('streaming_url')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="shipping_charges" class="control-label">Shipping Charges</label>
                                            <input type="number" placeholder="" name="shipping_charges"
                                                   id="shipping_charges"
                                                   class="form-control @error('shipping_charges') is-invalid @enderror"
                                                   value="{{ $setting->shipping_charges }}">
                                            @error('shipping_charges')
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
