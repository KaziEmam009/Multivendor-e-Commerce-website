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
                   Category Details
                </div>

                <div class="card-body">
                   <table class="table table-bordered">
                       <tbody>
                           <tr>
                               <td>Category name</td>
                               <td>{{ $category->category_name }}</td>
                           </tr>

                           <tr>
                               <td>Category Tagline</td>
                               <td>{{ $category->category_tagline }}</td>
                           </tr>

                           <tr>
                               <td>Category Photo</td>
                               <td>
                                   <img width="200" src="{{ asset('uploads/category_photos').'/'.$category->category_photo }}" alt="Not Found">
                               </td>
                           </tr>
                       </tbody>
                   </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


