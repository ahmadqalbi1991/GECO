@extends('site.main')

@section('content')
    <main>
        <section class="regiration-sucess pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="registration-success">
                            <h2>{{ $message1 }}</h2>
                            <h4>{{ $message2 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
