@extends('frontend.frontend_dashboard')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('title')
  Chat Message | MyFixIt  
@endsection
<!--Page Title-->
<section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Chat Message</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Chat Message</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->




        <!-- sidebar-page-container -->
        <section class="sidebar-page-container blog-details sec-pad-2">
            <div class="auto-container">
                <div class="row clearfix">
                    



  @php

            $id = Auth::user()->id;
            $userData = App\Models\User::find($id);

        @endphp




        <div class="col-lg-3 col-md-3 col-sm-3 sidebar-side">
            <div class="blog-sidebar">
              <div class="sidebar-widget post-widget">
                    <div class="widget-title">
                        <h4>User Profile </h4>
                    </div>
                    <div class="post-inner">
                        <div class="post">
                            <figure class="post-thumb"><a href="blog-details.html">
        <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
    </div> 
    <h4>{{ $userData->name }} </h5>
     <p>{{ $userData->email }} </p>
                    </div>
                </div> 
       
        <div class="sidebar-widget category-widget">
            <div class="widget-title">
               
            </div>
             

     @include('frontend.dashboard.dashboard_sidebar')


          </div> 
                         
                        </div>
                    </div>




  <div class="col-lg-9 col-md-9 col-sm-9 content-side">
                        <div class="blog-details-content">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    
                                    <div class="lower-content">
                                        
                                         
                                      
          <h3>Chat Message Box</h3>

 <div id="app">
 <chat-message></chat-message>
 </div>
 

                                    </div>
                                </div>
                            </div>
                             
                            
                        </div>

 
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