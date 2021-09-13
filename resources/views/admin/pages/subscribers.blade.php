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
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($subscribers) && count($subscribers))
                                        @foreach($subscribers as $subscriber)
                                            <tr>
                                                <td>{{ $subscriber->email }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center">No data</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $subscribers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
