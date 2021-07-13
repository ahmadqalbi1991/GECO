@extends('site.main')

@section('content')
    <main>
        <section class="regiration-sucess pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="registration-success">
                            <h2>Thank you for joining us.</h2>
                            <h4>Registration Complete. Please check your email address for verification</h4>
                        </div>
                        <div class="mt-20 text-center">
                            <a href="{{ route('site.home') }}" class="btn btn-primary">Go to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
