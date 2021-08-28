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
                            <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="product_name" class="control-label">Product Name</label>
                                            <input type="text" placeholder="Please enter game name" name="product_name"
                                                   id="product_name"
                                                   class="form-control @error('product_name') is-invalid @enderror"
                                                   value="{{ $product->product_name }}">
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
                                                <option @if($product->category == 'console') selected @endif value="console">Console</option>
                                                <option @if($product->category == 'headphones') selected @endif value="headphones">Headphones</option>
                                                <option @if($product->category == 'gamepad') selected @endif value="gamepad">Gamepad</option>
                                                <option @if($product->category == 'controllers') selected @endif value="controllers">Controllers</option>
                                                <option @if($product->category == 'games') selected @endif value="games">Games</option>
                                            </select>
                                            @error('category')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="price" class="control-label">Price</label>
                                            <input placeholder="Please enter price" name="price" type="number"
                                                   min="0"
                                                   value="{{ $product->price }}"
                                                   class="form-control @error('price') is-invalid @enderror">
                                            @error('price')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <label for="sku_code">Sku </label>
                                        <input type="text" name="sku_code" placeholder="SKU Code"
                                               class="form-control  @error('sku_code') is-invalid @enderror"
                                               id="sku_code"
                                               value="{{ $product->sku_code }}">
                                        @error('sku_code')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <label for="is_active">Is Active</label>
                                        <div class="form-check form-switch">
                                            <input @if($product->is_active) checked @endif class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                                   name="is_active">
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
                                                      placeholder="Description">{{ $product->description }}</textarea>
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
                                        <div class="form-group">
                                            <label>Last Image</label>
                                            <div class="game-img-wrapper">
                                                <img src="{{ asset('products/' . $product->image) }}">
                                            </div>
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
