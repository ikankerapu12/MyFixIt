@extends('frontend.frontend_dashboard')
@section('main')



<!--Page Title-->
<section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>User Profile </h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>User Profile </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->
@section('title')
  Dashboard | MyFixIt  
@endsection
        <!-- sidebar-page-container -->
        <section class="sidebar-page-container blog-details sec-pad-2">
            <div class="auto-container">
                <div class="row clearfix">
                    



            {{-- User Data and Stats passed from Controller --}}
        
        <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
            <div class="blog-sidebar">
            <div class="sidebar-widget post-widget">
                    <div class="widget-title">
                        <h4>User Profile </h4>
                    </div>
                    <div class="post-inner">
                        <div class="post">
                            <figure class="post-thumb"><a href="blog-details.html">
            <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
            <h5><a href="blog-details.html">{{ $userData->name }} </a></h5>
            <p>{{ $userData->email }} </p>
                        </div> 
                    </div>
                </div> 
    
        <div class="sidebar-widget category-widget">
            <div class="widget-title">
                
            </div>
            @include('frontend.dashboard.dashboard_sidebar')
        </div> 
                        
                        </div>
                    </div>




<div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="blog-details-content">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    
                                    <div class="lower-content">
                                        <h3>Your Activity Logs</h3>
                                    
        


<div class="row">
<div class="col-lg-4">
    <div class="card-body" style="background-color: #1baf65;">
    <h1 class="card-title" style="color: white; font-weight: bold;">{{ $bookingRequestCount }}</h1>
    <h5 class="card-text"style="color: white;"> Booking requests</h5>
    
</div>
</div>

<div class="col-md-4">
    <div class="card-body" style="background-color: #ffc107;">
    <h1 class="card-title" style="color: white; font-weight: bold; ">{{ $wishlistCount }}</h1>
    <h5 class="card-text"style="color: white;">Wishlist Services</h5>
    
</div>
</div>


<div class="col-md-4">
    <div class="card-body" style="background-color: #002758;">
    <h1 class="card-title" style="color: white; font-weight: bold;">{{ $compareCount }}</h1>
    <h5 class="card-text"style="color: white; "> Compare Services</h5>
    
</div>
</div>
    
</div> 

                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>

{{-- 
    <div class="blog-details-content">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    
                                    <div class="lower-content">
                                        <h3>Activity Logs</h3>
                                    <hr>
                                    
        




                                    </div>
                                </div>
                            </div>
                            
                            
                        </div> --}}






                    </div> 


                </div>
            </div>
        </section>
        <!-- sidebar-page-container -->

        <!-- subscribe-section -->
        <section class="subscribe-section bg-color-3">
            <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }});"></div>
            <div class="auto-container">
                        <div class="text">
                            <h2>WELCOME TO MYFIXIT!</h2>
                    </div>
                    {{-- <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                        <div class="form-inner">
                            <form action="contact.html" method="post" class="subscribe-form">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Enter your email" required="">
                                    <button type="submit">Subscribe Now</button>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                
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