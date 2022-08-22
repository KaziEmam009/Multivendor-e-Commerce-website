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
                        Add Vendor
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
                        <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label>Vendor Name</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Name"
                                    name="vendor_name">
                            </div>

                            <div class="mb-3">
                                <label>Vendor Email</label>
                                <input type="email" class="form-control" placeholder="Enter Vendor Email"
                                    name="vendor_email">
                                @error('vendor_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Vendor Phone Number</label>
                                <input type="number" class="form-control" placeholder="Enter Vendor Phone Number"
                                    name="vendor_phone_number">
                            </div>

                            <div class="mb-3">
                                <label>Vendor Address</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Address"
                                    name="vendor_address">
                            </div>
                            <button type="submit" class="btn btn-primary">Add New Vendor</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
