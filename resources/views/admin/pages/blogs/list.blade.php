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
                        <a href="{{ route('admin.blogs.create') }}" class="btn bg-gradient-primary">Add Blog</a>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Title
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created By
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Image
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Publish
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created at
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($blogs) && count($blogs))
                                        @foreach($blogs as $blog)
                                            <tr>
                                                <td class="text-center">{{ $blog->title }}</td>
                                                <td class="text-center">{{ $blog->user->name }}</td>
                                                <td class="text-center">
                                                    <img src="{{ asset('blogs/' . $blog->image) }}"
                                                         class="avatar avatar-sm me-3">
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('admin.blogs.update', $blog->id) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="publish"
                                                               value="{{ $blog->publish ? 0 : 1 }}">
                                                        <button
                                                            class="btn btn-sm @if($blog->publish) btn-success @else btn-primary @endif">
                                                            @if($blog->publish) Publish @else Hide @endif
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('admin.blogs.update', $blog->id) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_active"
                                                               value="{{ $blog->is_active ? 0 : 1 }}">
                                                        <button
                                                            class="btn btn-sm @if($blog->is_active) btn-success @else btn-danger @endif"
                                                            type="submit">
                                                            @if($blog->is_active) Active @else Disable @endif
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="badge btn-info"><i class="fas fa-pen"></i></a>
                                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="badge btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="7">No data</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
