@extends('layouts.app')
@section('breadcrumb')
    <div class="page-title-box">
        <h4 class="page-title">Home </h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Add Product
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label>Category Name</label>
                                <select name="category_id" class="form-control">
                                    <option value="">-Select One</option>
                                    @foreach ($active_categoris as $active_category )
                                    <option value="{{ $active_category->id }}">{{ $active_category->category_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Product Name</label>
                                <input type="text" class="form-control" placeholder="Enter Product Name"
                                    name="product_name">
                            </div>

                            <div class="mb-3">
                                <label>Product Price</label>
                                <input type="number" class="form-control" placeholder="Enter Product Price"
                                    name="product_price">
                            </div>

                            <div class="mb-3">
                                <label>Product Short Description</label>
                                <textarea name="product_short_description" class="form-control" rows="2"></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Product Long Description</label>
                                <textarea name="product_long_description" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Product Code</label>
                                <input type="text" class="form-control" placeholder="Enter Product Code"
                                    name="product_code">
                            </div>

                            <div class="mb-3">
                                <label>Product Quantity</label>
                                <input type="number" class="form-control" placeholder="Enter product Quantity"
                                    name="product_quantity">
                            </div>

                            <div class="mb-3">
                                <label>Product Photo</label>
                                <input type="file" class="form-control"
                                    name="product_photo">
                            </div>

                            <div class="mb-3">
                                <label>Product Thumbnails</label>
                                <input type="file" class="form-control"
                                    name="product_thumbnails[]" multiple>
                            </div>

                            <button type="submit" class="btn btn-primary">Add New Product</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
