@extends('admin.main')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                            <form action="{{ route('admin.products.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="product_name" class="control-label">Product Name</label>
                                            <input type="text" placeholder="Please enter game name" name="product_name"
                                                   id="product_name"
                                                   class="form-control @error('product_name') is-invalid @enderror"
                                                   value="{{ old('product_name') }}">
                                            @error('product_name')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="category" class="control-label">Category</label>
                                            <select name="category" id="category"
                                                    class="form-control @error('category') is-invalid @enderror">
                                                <option value="">Select Category</option>
                                                <option value="console">Console</option>
                                                <option value="headphones">Headphones</option>
                                                <option value="gamepad">Gamepad</option>
                                                <option value="games">Games</option>
                                            </select>
                                            @error('category')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="price" class="control-label">Price</label>
                                                    <input placeholder="Price" name="price" type="number"
                                                           min="0"
                                                           step="0.01"
                                                           class="form-control @error('price') is-invalid @enderror">
                                                    @error('price')
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="discount" class="control-label">Discount</label>
                                                    <input placeholder="Discount" name="discount" type="number"
                                                           min="0"
                                                           step="0.01"
                                                           class="form-control @error('discount') is-invalid @enderror">
                                                    @error('discount')
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="inventory" class="control-label">Inventory</label>
                                            <input placeholder="Please enter inventory" name="inventory" type="number"
                                                   min="0"
                                                   class="form-control @error('inventory') is-invalid @enderror">
                                            @error('inventory')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <label for="sku_code">Sku </label>
                                        <input type="text" name="sku_code" placeholder="SKU Code"
                                               class="form-control  @error('sku_code') is-invalid @enderror"
                                        id="sku_code">
                                        @error('sku_code')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <label for="is_active">Is Active</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                                   name="is_active" checked="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="description" class="control-label">Description</label>
                                            <textarea name="description" id="description"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      rows="5"
                                                      placeholder="Description"></textarea>
                                            @error('description')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" id="image"
                                                   class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
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
