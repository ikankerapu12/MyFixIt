@extends('frontend.frontend_dashboard')

@section('main')
@section('title')
  All Service Type | MyFixIt  
@endsection
    <!-- Page Title -->
    <section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>All Service Type</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>All Service Type</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Categories Section -->
    <section class="category-section centred">
        <div class="auto-container">
            <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                <ul class="category-list clearfix">
                    @foreach ($serviceTypes as $item)
                        <li>
                            <div class="category-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="{{ $item->type_icon }}"></i></div>
                                    <h5><a href="{{ route('service.type', $item->id) }}">{{ $item->type_name }}</a></h5>
                                    <span>{{ $item->services->count() }}</span>  <!-- Assuming 'services' is a relationship -->
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!-- End Categories Section -->

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

.buy-btn.pull-right a {
    font-size: 12px;  /* Smaller font size */
    color: #fff;  /* Ensure text is visible */
    text-overflow: ellipsis;  /* Add ellipsis when text overflows */
    white-space: nowrap;  /* Prevent text from wrapping */
    overflow: hidden;  /* Hide overflowing text */
    max-width: 150px;  /* Limit width to avoid overflow */
    display: inline-block;
    padding: 5px 10px;
    text-align: center;
}

.more-details.clearfix {
    display: flex;
    justify-content: space-between; /* Space out items across the container */
    align-items: center;
    padding: 0;
    margin: 0 0 20px;
    list-style: none;
    min-height: 24px;
}

.more-details.clearfix::after {
    content: none;
}

.more-details li {
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #9aa0a6;
    margin-right: 15px;  /* Adjust margin to create more space */
}

.more-details li i {
    width: 18px;
    text-align: center;
    margin-right: 6px;
    font-size: 14px;
    color: #9aa0a6;
}

.more-details li span {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    flex-shrink: 0; /* Prevent text shrinkage */
}

.category-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.category-block-one {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1 1 220px; /* Equal flex sizing */
    height: 220px; /* Set the fixed height */
    margin: 10px; /* Add spacing between the items */
    background: #f7f7f7; /* Set background color */
    border-radius: 10px; /* Optional, for rounded corners */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional, for shadow effect */
}

.category-block-one .inner-box {
    text-align: center;
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%; /* Ensure content fills the height */
}

.category-block-one .icon-box {
    font-size: 30px;
    margin-bottom: 10px;
}

.category-block-one h5 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 5px;
}

.category-block-one span {
    font-size: 18px;
    font-weight: bold;
    color: #666;
    margin-top: 10px;
}

.category-block-one .inner-box a {
    color: #333;
    text-decoration: none;
}

</style>
@endsection