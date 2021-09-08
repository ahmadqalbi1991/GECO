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
                        <form action="{{ route('admin.send.message') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $message->id }}">
                            <div class="card-body ">
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control" value="{{ $message->subject }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
