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
                        <a href="{{ route('admin.products.create') }}" class="btn bg-gradient-primary">Add Product</a>
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
                                            Product Name
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Discount
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Discounted Price
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            SKU
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Stock
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($products) && count($products))
                                        @foreach($products as $product)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('products/' . $product->image) }}"
                                                                 class="avatar avatar-sm me-3">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $product->product_name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ strtoupper($product->category) }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">${{ $product->price }}</td>
                                                <td class="align-middle text-center text-sm">{{ $product->discount }}%</td>
                                                <td class="align-middle text-center text-sm">${{ $product->price - (($product->price * $product->discount) / 100) }}</td>
                                                <td class="align-middle text-center text-sm">{{ $product->sku_code }}</td>
                                                <td class="align-middle text-center text-sm">{{ $product->inventory }}</td>
                                                <td class="align-middle text-center text-sm">
                                                    <form action="{{ route('admin.products.update', $product->id) }}"
                                                          method="post">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="action" value="status_change">
                                                        <button type="submit"
                                                                class="btn btn-sm bg-gradient-{{ $product->is_active ? 'success' : 'danger' }}">{{ $product->is_active ? 'Active' : 'Deactive' }}</button>
                                                    </form>
                                                </td>

                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                                       class="badge btn-primary btn-sm m-r-5">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="{{ route('admin.products.show', $product->id) }}"
                                                       class="badge btn-secondary btn-sm m-r-5">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                          method="post">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="badge btn-sm bg-gradient-danger"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
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
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
