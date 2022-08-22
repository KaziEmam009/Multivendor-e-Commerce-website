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
                    Customer List
                </div>

                <div class="card-body">
                    @if (auth()->user()->role == 2)
                     <table class="table table-bordered table-sm">
                        <tr>
                            <th>Check</th>
                            <th>SL. No.</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Action</th>
                        </tr>
                        <form action="{{ route('checkemailoffer')}}" method="POST">
                         @csrf
                        @foreach ($customers as $customer)
                         <tr>
                             <td>
                                 <input type="checkbox" name="check[]" class="form-control" value="{{ $customer->id}}">
                             </td>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>
                                <a href="{{ route('singleemailoffer', $customer->id )}}" class="btn btn-info btn-sm">Send Email</a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="text-center">
                                <button type="submit" class="btn btn-success">Send check</button>
                            </td>
                        </tr>
                        </form>
                    </table>
                    @else
                        <div class="alert alert-danger">
                            YOU ARE NOT ALLOWED TO VIEW THIS PAGE
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
