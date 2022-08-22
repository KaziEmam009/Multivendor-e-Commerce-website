@extends('layouts.app_frontend')


@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Shop</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->
    <!-- Shop Page Start  -->
    <div class="shop-category-area pt-100px pb-100px">
        <div class="container">
            <form action="" method="">
                    <div class="row  mb-3">
                    <div class="col-4">
                        <input class="form-control" type="text" placeholder="Min" name="min_value" value="{{ $min }}">
                    </div>

                    <div class="col-4">
                        <input class="form-control" type="text" placeholder="Max" name="max_value" value="{{ $max }}">
                    </div>

                    <div class="col-4">
                        <input type="submit" class="btn btn-success" value="Price Filter">
                    </div>
                </div>
            </form>

            <div class="row">
                @foreach ($products as $allproduct)
                    @include('parts.product_thumb')
                @endforeach
            </div>
        </div>
    </div>
    <!-- Shop Page End  -->

@endsection
