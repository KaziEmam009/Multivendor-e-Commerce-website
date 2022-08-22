@extends('layouts.app_frontend')



@section('content')
<!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Contact Us</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Contact Us</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
 <!-- breadcrumb-area end -->

 <!-- Contact Area Start -->
    <div class="contact-area pt-100px pb-100px">
        <div class="container">
            <div class="contact-wrapper">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="contact-info">
                            <div class="single-contact">
                                <div class="icon-box">
                                    <img src="assets/images/icons/4.png" alt="">
                                </div>
                                <div class="info-box">
                                    <h5 class="title" >Phone:</h5>
                                    <p><a href="tel:0123456789">012 345 67 89</a></p>
                                </div>
                            </div>
                            <div class="single-contact">
                                <div class="icon-box">
                                    <img src="assets/images/icons/5.png" alt="">
                                </div>
                                <div class="info-box">
                                    <h5 class="title" >Email:</h5>
                                    <p><a href="mailto:demo@example.com">demo@example.com</a></p>
                                </div>
                            </div>
                            <div class="single-contact">
                                <div class="icon-box">
                                    <img src="assets/images/icons/6.png" alt="">
                                </div>
                                <div class="info-box">
                                    <h5 class="title" >Address:</h5>
                                    <p>Your address goes here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="contact-form">
                            <div class="contact-title mb-30">
                                <h2 class="title" data-aos="fade-up" data-aos-delay="200">Send a Message</h2>
                            </div>
                            <form class="contact-form-style" action="{{ route('contact_post') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                                        <label>Full Name</label>
                                        <input name="name" placeholder="{{ auth()->user()->name }}" type="text" />
                                    </div>
                                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                                        <label>Email</label>
                                        <input name="email" placeholder="{{ auth()->user()->email }}" type="email" />
                                    </div>
                                    <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                                        <label>Your Messages</label>
                                        <textarea name="message"></textarea>
                                        <button class="btn btn-primary mt-4" data-aos="fade-up" data-aos-delay="200" type="submit">Post Comment <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Area End -->

@endsection
