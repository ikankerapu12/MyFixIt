@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
  {{ $technician->name }} | MyFixIt  
@endsection
<!--Page Title-->
<section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
    <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>{{ $technician->name }} </h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>{{ $technician->name }} </li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->


        <!-- technician-details -->
        <section class="agent-details">
            <div class="auto-container">
                <div class="agent-details-content">
                    <div class="agents-block-one">
                        <div class="inner-box mr-0">
<figure class="image-box"><img src="{{ (!empty($technician->photo)) ? url('upload/technician_images/'.$technician->photo) : url('upload/no_image.jpg') }}" alt="" style="width:270px; height:330px;" ></figure>
<div class="content-box">
<div class="upper clearfix">
    <div class="title-inner pull-left">
        <h4>{{ $technician->name }}</h4>
        <span class="designation">{{ $technician->username }}</span>
        @if($technician->status == 'active')
    <h5 class="technician-status-badge" data-technician-id="{{ $technician->id }}"><span class="badge rounded-pill status-badge bg-success text-white">Active</span></h5>
@else
    <h5 class="technician-status-badge" data-technician-id="{{ $technician->id }}"><span class="badge rounded-pill status-badge bg-danger text-white">Inactive</span></h5>
@endif
    </div>
<input type="hidden" name="technician_id" value="{{ $technician->id }}">
</div>
<div class="text">
    <p>{{ $technician->description }}</p>
</div>
<ul class="info clearfix mr-0">
    <li><i class="fab fa fa-envelope"></i><a href="mailto:bean@realshed.com">{{ $technician->email }}</a></li>
    <li><i class="fab fa fa-phone"></i>
    	<a href="tel:03030571965">{{ $technician->phone }}</a></li>
           @auth
                    <div class="technician-chat-wrapper" data-technician-id="{{ $technician->id }}">
                        <div id="app" class="technician-chat-box {{ $technician->status === 'active' ? '' : 'd-none' }}">
                            <send-message :receiverid="{{ $technician->id }}" receivername="{{ $technician->name }}">

                            </send-message>
                        </div>
                        <span class="text-danger technician-inactive-message {{ $technician->status === 'active' ? 'd-none' : '' }}">Technician is currently inactive.</span>
                    </div>
                    @else
                    <span class="text-danger">For Chat Login First </span>
                    @endauth
</ul>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- technician-details end -->


<!-- technician-page-section -->
<section class="agents-page-section agent-details-page">
<div class="auto-container">
<div class="row clearfix">
<div class="col-lg-8 col-md-12 col-sm-12 content-side">
<div class="agents-content-side tabs-box">
<div class="group-title">
<h3>Services Offered by {{ $technician->name }}</h3>
</div>
<div class="item-shorting clearfix">
 <h5>Total services: <span>{{ count($service) }}</span></h5>
</div>



<div class="tabs-content">
<div class="tab active-tab" id="tab-1">
    <div class="wrapper list">
        <div class="deals-list-content list-item">


            @foreach($service as $item)
            <div class="deals-block-one" data-service-id="{{ $item->id }}">
                <div class="inner-box">
                    <div class="image-box">
                         <figure class="image"><img src="{{ asset($item->service_thumbnail  ) }}" alt=""  style="width:300px; height:350px;"></figure>
                        <div class="batch"><i class="icon-11"></i></div>
                        @if($item->featured == 1)
                        <span class="category">Featured</span>
                        @else
                        <span class="category">New</span>
                        @endif
                    </div>
                    <div class="lower-content">
                         <div class="title-text"><h4><a href="{{ url('service/details/'.$item->id.'/'.$item->service_slug) }}">{{ $item->service_name }}</a></h4>@if($item->status == 1)
    <h5 class="service-status-badge"><span class="badge rounded-pill status-badge bg-success text-white">Available</span></h5>
@elseif($item->status == 2)
    <h5 class="service-status-badge"><span class="badge rounded-pill status-badge bg-warning text-dark">Busy</span></h5>
@else
    <h5 class="service-status-badge"><span class="badge rounded-pill status-badge bg-danger text-white">Unavailable</span></h5>
@endif</div>
                        <div class="price-box clearfix">
                            <div class="price-info pull-left">
                                <h6>Start From</h6>
                                                                <h4>RM {{ $item->lowest_fee }}</h4>
                            </div>


   <div class="author-box pull-right">
        <figure class="author-thumb"> 
            <img src="{{ (!empty($item->user->photo)) ? url('upload/technician_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="">
            <span>{{ $item->user->name }}</span>
        </figure>
    </div>

                        </div>
                        <p>{{ $item->short_descp }}</p>
                         <ul class="more-details clearfix">
    <li>
        <i class="fas fa-map-marker-alt"></i>
        <span>{{ $item['sseksyen']['seksyen_name'] }}</span>
    </li>
    <li>
        <i class="fas fa-tools"></i>
        <span>{{ $item->type->type_name }}</span>
    </li>
</ul>
                        <div class="other-info-box clearfix">
                            <div class="btn-box pull-left"><a href="{{ url('service/details/'.$item->id.'/'.$item->service_slug) }}" class="theme-btn btn-two">See Details</a></div>
                            <ul class="other-option pull-right clearfix">
                                             <li><a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="addToCompare(this.id)"><i class="icon-12"></i></a></li>
       
        <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addToWishList(this.id)" ><i class="icon-13"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
@endforeach

        </div>

    </div>
</div>



</div>
</div>
</div>




<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
<div class="default-sidebar agent-sidebar">
<div class="agents-contact sidebar-widget">
<div class="widget-title">
    <h5>Report {{ $technician->name }}?</h5>
</div>
<div class="form-inner">
@auth

@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp

 <form action="{{ route('technician.report') }}" method="post" class="default-form">
    @csrf 



    <input type="hidden" name="technician_id" value="{{ $technician->id }}">

            <div class="form-group">
                <input type="text" name="msg_name" placeholder="Your name" value="{{ $userData->name }}">
            </div>
            <div class="form-group">
                <input type="email" name="msg_email" placeholder="Your Email" value="{{ $userData->email }}">
            </div>
            <div class="form-group">
                <input type="text" name="msg_phone" placeholder="Phone" value="{{ $userData->phone }}">
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Message"></textarea>
            </div>
            <div class="form-group message-btn">
                <button type="submit" class="theme-btn btn-one">Report Technician</button>
            </div>
        </form>

@else

<form action="{{ route('technician.report') }}" method="post" class="default-form">
    @csrf 


    <input type="hidden" name="technician_id" value="{{ $technician->id }}">

            <div class="form-group">
                <input type="text" name="msg_name" placeholder="Your name" required="">
            </div>
            <div class="form-group">
                <input type="email" name="msg_email" placeholder="Your Email" required="">
            </div>
            <div class="form-group">
                <input type="text" name="msg_phone" placeholder="Phone" required="">
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Message"></textarea>
            </div>
            <div class="form-group message-btn">
                <button type="submit" class="theme-btn btn-one">Report Technician</button>
            </div>
        </form>

@endauth
</div>
</div>




<div class="featured-widget sidebar-widget">
<div class="widget-title">
    <h5>Featured Services</h5>
</div>
<div class="single-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
   
@foreach($featured as $feat)
<div class="feature-block-one" data-service-id="{{ $feat->id }}">
        <div class="inner-box">
            <div class="image-box">
                <figure class="image"><img src="{{ asset($feat->service_thumbnail  ) }}" alt="" style="width:370px; height:250px;"></figure>
                <div class="batch"><i class="icon-11"></i></div>
                <span class="category">Featured</span>
            </div>
            <div class="lower-content">
                 <div class="title-text"><h4><a href="{{ url('service/details/'.$feat->id.'/'.$feat->service_slug) }}">{{ $feat->service_name }}</a></h4>@if($feat->status == 1)
    <h5 class="service-status-badge"><span class="badge rounded-pill status-badge bg-success text-white">Available</span></h5>
@elseif($feat->status == 2)
    <h5 class="service-status-badge"><span class="badge rounded-pill status-badge bg-warning text-dark">Busy</span></h5>
@else
    <h5 class="service-status-badge"><span class="badge rounded-pill status-badge bg-danger text-white">Unavailable</span></h5>
@endif</div>
                <div class="price-box clearfix">
                    <div class="price-info">
                        <h6>Start From</h6>
                        <h4>RM {{ $feat->lowest_fee }}</h4>
                    </div>
                </div>
                <p>{{ $feat->short_descp }}</p>
                <div class="btn-box"><a href="{{ url('service/details/'.$feat->id.'/'.$feat->service_slug) }}" class="theme-btn btn-two">See Details</a></div>
            </div>
        </div>
    </div>
    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- agents-page-section end -->


        <!-- subscribe-section -->
        <section class="subscribe-section bg-color-3">
            <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }});"></div>
            <div class="auto-container">
                        <div class="text">
                            <h2>WELCOME TO MYFIXIT!</h2>
                    </div>
                
            </div>
        </section>
        <!-- subscribe-section end -->






<style>
    .subscribe-section .text {
        text-align: center;
        width: 100%;
    }

    @keyframes moveBackground {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: -2235px 0;
    }
    
}
.page-title {
    animation: moveBackground 45s linear infinite; /* Slower movement, infinite loop */
}
</style>

@endsection
