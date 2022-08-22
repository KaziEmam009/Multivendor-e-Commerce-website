@extends('layouts.app')
@section('breadcrumb')
 <div class="page-title-box">
  <h4 class="page-title">Home </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
    </ol>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    List Coupons
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Coupons ID</th>
                                <th>Coupons Name</th>
                                <th>Coupons Percentage</th>
                                <th>Coupons validity</th>
                                <th>Coupons limit</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as  $coupon)
                                    <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ $coupon->coupon_name }}</td>
                                    <td>{{ $coupon->discount_percentage }}</td>
                                    <td>{{ $coupon->validity }}</td>
                                    <td>{{ $coupon->limit }}</td>
                                </tr>
                                @empty
                                <tr class="text-center text-danger">
                                    <td colspan="50">NO Record To SHOW</td>
                                </tr>
                                @endforelse
                            </tbody>
                    </table>
                </tbody>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



