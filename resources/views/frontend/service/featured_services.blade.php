@extends('frontend.frontend_dashboard')

@section('main')
@section('title')
  Featured Services | MyFixIt  
@endsection
<!--Page Title-->
<section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Featured Services</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Featured Services</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->
    <!-- Featured Services Section -->
    <section class="property-page-section property-list">
        <div class="auto-container">

            <div class="row clearfix">
                @foreach($services as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block" data-service-id="{{ $item->id }}">
                        <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset($item->service_thumbnail) }}" alt=""></figure>
                                    <div class="batch"><i class="icon-11"></i></div>
                                    <span class="category">Featured</span>
                                </div>
                                <div class="lower-content">
                                    <div class="author-info clearfix">
                                        <div class="author pull-left">
                                            <figure class="author-thumb"><img src="{{ !empty($item->user->photo) ? url('upload/technician_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt=""></figure>
                                            <h6>{{ $item->user->name }}</h6>
                                        </div>
<div class="buy-btn pull-right service-status-badge">
                                @if($item->status == 1)
                                    <h5><span class="badge rounded-pill bg-success text-white">Available</span></h5>
                                @elseif($item->status == 2)
                                    <h5><span class="badge rounded-pill bg-warning text-dark">Busy</span></h5>
                                @else
                                    <h5><span class="badge rounded-pill bg-danger text-white">Unavailable</span></h5>
                                @endif
                            </div>
                                    </div>

                                    <div class="title-text">
                                        <h4><a href="{{ url('service/details/'.$item->id.'/'.$item->service_slug) }}">{{ $item->service_name }}</a></h4>
                                    </div>

                                    <div class="price-box clearfix">
                                        <div class="price-info pull-left">
                                            <h6>Start From</h6>
                                            <h4>RM {{ $item->lowest_fee }}</h4>
                                        </div>
                                    </div>

                                    <p>{{ $item->short_descp }}</p>
                                    <ul class="more-details clearfix">
                                        <li><i class="fas fa-map-marker-alt"></i><span>{{ $item['sseksyen']['seksyen_name'] }}</span></li>
                                        <li><i class="fas fa-tools"></i><span>{{ $item->type->type_name }}</span></li>
                                    </ul>
                                    <div class="btn-box">
                                        <a href="{{ url('service/details/'.$item->id.'/'.$item->service_slug) }}" class="theme-btn btn-two">See Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $services->links('vendor.pagination.custom') }}
            </div>

        </div>
    </section>
    <!-- End Featured Services Section -->

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



</style>
@endsection
