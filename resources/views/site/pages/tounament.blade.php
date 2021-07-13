@extends('site.main')

@section('content')
    <main>

        @include('site.layout.breadcrumbs')

        <section class="upcoming-games-area upcoming-games-bg pt-120 pb-80">
            <div class="container">
                <h3>{{ $tournament->tournament_title }}</h3>
                <div class="row">

                </div>
            </div>
        </section>
    </main>
@endsection
