@extends('frontend.frontend_dashboard')
@section('main')
     @section('title')
  Technician Login | MyFixIt  
@endsection

    <!--Page Title-->
        <section class="page-title-two bg-color-3 centred">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});"></div>
                <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});"></div>
            </div>
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>Technician Login</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Technician Login</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->
<style>
.page-title-two .content-box h1 {
    color: #ffffff;
}
.page-title-two .bread-crumb li:last-child {
    color: #ffffff;
}

/* Breadcrumb text */
.page-title-two .bread-crumb li,
.page-title-two .bread-crumb li a {
    color: #ffffff;
}
/* Hover effect for Home link */
.page-title-two .bread-crumb li a:hover {
    color: #73adfd;
}


</style>

        <!-- ragister-section -->
        <section class="ragister-section centred sec-pad">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                        <div class="sec-title">
                            <!-- <h5>Sign in</h5>
                            <h2>Sign In With Realshed</h2> -->
                        </div>
                        <div class="tabs-box">
                            <div class="tab-btn-box">
                                <ul class="tab-btns tab-buttons centred clearfix">
                                    <li class="tab-btn active-btn" data-tab="#tab-1">Technician Login</li>
                                    <li class="tab-btn" data-tab="#tab-2">Technician Register</li>
                                </ul>
                            </div>

            <div class="tabs-content">
                <div class="tab active-tab" id="tab-1">
                    <div class="inner-box">
                        <h4>Technician Login</h4>
                        @if ($errors->has('login'))
                            <div class="alert alert-danger mb-3">
                                {{ $errors->first('login') }}
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="post" class="default-form">
                        @csrf
                            <div class="form-group">
                                <label>Email/Name </label>
                                <input type="text" name="login" id="login" required="">
                            </div>
                    
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" required="">
                            </div>
                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn btn-one">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab" id="tab-2">
                    <div class="inner-box">
                        <h4>Technician Register</h4>
                        <form action="{{ route('technician.register') }}" method="post" enctype="multipart/form-data" class="default-form">

                        @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" required="">
                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" id="email" required="">
                            </div>
                            <div class="form-group">
                            <label>Technician Phone </label>
                            <input type="text" name="phone" id="phone" required="">
                            </div>  
                            <div class="form-group">
                                <label>Upload PDF Document Technician Verification</label>
                                <input type="file" name="document" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" required="">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required="">
                            </div>
                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn btn-one">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ragister-section end -->

@if ($errors->any())
    <script>
        window.addEventListener('load', function () {
            if (typeof toastr === 'undefined') {
                return;
            }
            @foreach ($errors->all() as $error)
                toastr.error(@json($error));
            @endforeach
        });
    </script>
@endif


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
<style>.subscribe-section .text {
        text-align: center;
        width: 100%;
    }</style>
@endsection
