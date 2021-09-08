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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                        <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject</th>
                                        <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                        <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($messages) && count($messages))
                                        @foreach($messages as $message)
                                            <tr>
                                                <td>{{ $message->name }}</td>
                                                <td>{{ $message->email }}</td>
                                                <td>{{ $message->subject }}</td>
                                                <td>
                                                    @if(!$message->is_read)
                                                        <span class="btn btn-sm btn-danger">Unread</span>
                                                    @else
                                                        <span class="btn btn-sm btn-success">Read</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.message.view', $message->id) }}" class="btn btn-primary btn-sm"><i
                                                            class="fas
                                                    fa-eye"></i></a>
                                                    <a href="{{ route('admin.message.delete', $message->id) }}" class="btn btn-danger btn-sm"><i
                                                            class="fas
                                                    fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">No data</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $messages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
