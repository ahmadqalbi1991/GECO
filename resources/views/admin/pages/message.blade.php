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
                        <div class="card-header">
                            Subject
                        </div>
                        <div class="card-body ">
                           <h4>{{ $message->subject }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            Sender Detail
                        </div>
                        <div class="card-body ">
                            <p>Name: {{ $message->name }}</p>
                            <p>Email: {{ $message->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            Message
                        </div>
                        <div class="card-body">
                            {{ $message->message }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-right">
                    <a href="{{ route('admin.message.reply', $message->id) }}" class="btn btn-success">Reply Back</a>
                    <a href="{{ route('admin.message.delete', $message->id) }}" class="btn btn-danger">Delete</a>
                </div>
            </div>

        </div>
    </main>

@endsection
