@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
  {{ $service->service_name }} | MyFixIt  
@endsection
<!--Page Title-->
<section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>{{ $service->service_name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>{{ $service->service_name }}</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


        <!-- service-details -->
        <section class="property-details property-details-one">
            <div class="auto-container">
                <div class="top-details clearfix">
                    <div class="left-column pull-left clearfix">
                        <h3>{{ $service->service_name }}</h3>
                        <div class="author-info clearfix">
                            <div class="author-box pull-left">

                    <figure class="author-thumb">  <a href="{{ route('technician.details', $service->user->id) }}"><img src="{{ (!empty($service->user->photo)) ? url('upload/technician_images/'.$service->user->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>

                                <h6><a href="{{ route('technician.details', $service->user->id) }}" class="tech-name-link">{{ $service->user->name }}</a></h6>       



                            </div>
                            @php
                                $avgRating = $service->average_rating;
                                $fullStars = floor($avgRating);
                                $hasHalfStar = ($avgRating - $fullStars) >= 0.5;
                                $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                            @endphp
                            <ul class="rating clearfix pull-left" title="{{ number_format($avgRating, 1) }} / 5 ({{ $service->review_count }} reviews)">
                                @for($i = 0; $i < $fullStars; $i++)
                                    <li><i class="icon-39" style="color: #ffc107;"></i></li>
                                @endfor
                                @if($hasHalfStar)
                                    <li><i class="fas fa-star-half-alt" style="color: #ffc107;"></i></li>
                                @endif
                                @for($i = 0; $i < $emptyStars; $i++)
                                    <li><i class="icon-39" style="color: #ddd;"></i></li>
                                @endfor
                                <li class="ms-2 text-muted" style="font-size: 14px;">({{ $service->review_count }})</li>
                            </ul>
                        </div>
                    </div>
                    <div class="right-column pull-right clearfix">
                        <div class="price-inner clearfix">
                            <ul class="category clearfix pull-left">
     <li><a href="{{ route('service.type',$service->type->id) }}">{{ $service->type->type_name }}</a></li>
                            </ul> 
                            <ul class="category clearfix pull-left">
     <li id="main-service-status-badge">
                                @if($service->status == 1)
                                    <h5><span class="badge rounded-pill bg-success text-white">Available</span></h5>
                                @elseif($service->status == 2)
                                    <h5><span class="badge rounded-pill bg-warning text-dark">Busy</span></h5>
                                @else
                                    <h5><span class="badge rounded-pill bg-danger text-white">Unavailable</span></h5>
                                @endif
                            </a></li>
                            </ul>
                            <div class="price-box pull-right">
                                <h3>RM {{ $service->lowest_fee }}</h3>
                            </div>
                        </div>
                        <ul class="other-option pull-right clearfix">
                            <li><a aria-label="Compare" class="action-btn" id="{{ $service->id }}" onclick="addToCompare(this.id)"><i class="icon-12"></i></a></li>
       
        <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $service->id }}" onclick="addToWishList(this.id)" ><i class="icon-13"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="property-details-content">
    <div class="carousel-inner">
        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
        	@foreach($multiImage as $img)
            <figure class="image-box"><img src="{{ asset($img->photo_name) }}" alt=""></figure>
            @endforeach
        </div>
    </div>
                            <div class="discription-box content-widget">
                                <div class="title-box">
                                    <h4>Service Description</h4>
                                </div>
                                <div class="text">
                                    <p>{!! $service->long_descp !!}</p>
                                </div>
                            </div>
                            <div class="details-box content-widget">
                                <div class="title-box">
                                    <h4>Service Details</h4>
                                </div>
                                 <ul class="list clearfix">
        <li>Service ID: <span>{{ $service->service_code }}</span></li>
        <li>Starting Fee: <span>RM {{ $service->lowest_fee }}</span></li>
        <li>Maximum Fee: <span>RM {{ $service->max_fee }}</span></li>
        
        <li>Service Type: <span>{{ $service->type->type_name }}</span></li>
        <li>Service Area:
            <span>{{ $service['sseksyen']['seksyen_name'] }}</span>
        </li>
        <li>Featured:
            <span>{{ $service->featured ? 'Yes' : 'No' }}</span>
        </li>

        <li>Popular:
            <span>{{ $service->hot ? 'Yes' : 'No' }}</span>
        </li>
    </ul>
                            </div>

                            <div class="location-box content-widget">
                                <div class="title-box">
                                    <h4>Location</h4>
                                </div>
                                <ul class="info clearfix">
                                    <li><span>Address:</span> {{ $service->address }}</li> 
                                    <li><span>State/county:</span> {{ $service->state }}</li>
                                    <li><span>Seksyen:</span> {{ $service['sseksyen']['seksyen_name']  }}</li>
                                    <li><span>Postal Code:</span> {{ $service->postal_code }}</li>
                                    <li><span>City:</span> {{ $service->city }}</li>
                                </ul>
                                <div class="google-map-area">
                                    <div 
                                        class="google-map" 
                                        id="contact-google-map" 
                                        data-map-lat="{{ $service->latitude }}" 
                                        data-map-lng="{{ $service->longitude }}" 
                                        data-icon-path="{{ asset('frontend/assets/images/icons/map-marker.png') }}"  
                                        data-map-title="Brooklyn, New York, United Kingdom" 
                                        data-map-zoom="12" 
                                        data-markers='{
                                            "marker-1": [40.712776, -74.005974, "<h4>Branch Office</h4><p>77/99 New York</p>","{{ asset('frontend/assets/images/icons/map-marker.png') }}"]
                                        }'>

                                    </div>
                                </div>
                            </div>
                            

                            <div class="statistics-box content-widget">
                                <div class="title-box">
                                    <h4>Service Video</h4>
                                </div>
                                <figure class="image-box">
    @if($service->service_video)
        <iframe width="700" height="415" src="{{ $service->service_video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    @else
        <p>Sorry, the video is unavailable or embedding is disabled. <a href="{{ $service->service_video }}" target="_blank">Watch on YouTube</a></p>
    @endif
</figure>


                            </div>

                            <!-- Reviews & Ratings Section -->
                            <div class="reviews-box content-widget">
                                <div class="title-box">
                                    <h4>Reviews & Ratings</h4>
                                </div>
                                
                                <!-- Rating Summary -->
                                <div class="rating-summary mb-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 text-center">
                                            <div class="average-rating-display">
                                                <h1 class="mb-0" style="font-size: 48px; color: #5a83ff;">{{ number_format($service->average_rating, 1) }}</h1>
                                                <div class="stars-display">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= floor($service->average_rating))
                                                            <i class="fas fa-star" style="color: #ffc107;"></i>
                                                        @elseif($i - 0.5 <= $service->average_rating)
                                                            <i class="fas fa-star-half-alt" style="color: #ffc107;"></i>
                                                        @else
                                                            <i class="far fa-star" style="color: #ffc107;"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <p class="text-muted mb-0">{{ $service->review_count }} {{ $service->review_count == 1 ? 'Review' : 'Reviews' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            @php
                                                $reviews = $service->reviews()->with(['user', 'technician'])->latest()->get();
                                                $ratingCounts = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                                                foreach($reviews as $review) {
                                                    $ratingCounts[$review->rating]++;
                                                }
                                                $totalReviews = $service->review_count ?: 1;
                                            @endphp
                                            @for($star = 5; $star >= 1; $star--)
                                                <div class="d-flex align-items-center mb-1">
                                                    <span class="me-2" style="width: 20px;">{{ $star }}</span>
                                                    <i class="fas fa-star text-warning me-2"></i>
                                                    <div class="progress flex-grow-1" style="height: 8px;">
                                                        <div class="progress-bar bg-warning" style="width: {{ ($ratingCounts[$star] / $totalReviews) * 100 }}%;"></div>
                                                    </div>
                                                    <span class="ms-2" style="width: 30px;">{{ $ratingCounts[$star] }}</span>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <!-- Individual Reviews -->
                                <div class="reviews-list">
                                    @forelse($reviews as $review)
                                        <div class="review-item mb-4 p-3" style="background: #f8f9fa; border-radius: 12px;">
                                            <div class="d-flex">
                                                <figure class="review-author-thumb me-3" style="width: 50px; height: 50px; overflow: hidden; border-radius: 50%;">
                                                    <img src="{{ (!empty($review->user->photo)) ? url('upload/user_images/'.$review->user->photo) : url('upload/no_image.jpg') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                                </figure>
                                                <div class="review-content flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h6 class="mb-1">{{ $review->user->name }}</h6>
                                                            <div class="review-rating mb-2">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 12px;"></i>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <p class="mb-2">{{ $review->comment }}</p>
                                                    
                                                    @if($review->technician_reply)
                                                        <div class="technician-reply mt-3 p-3" style="background: #e9ecef; border-radius: 8px; border-left: 3px solid #5a83ff;">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <figure class="me-2" style="width: 30px; height: 30px; overflow: hidden; border-radius: 50%;">
                                                                    <img src="{{ (!empty($review->technician->photo)) ? url('upload/technician_images/'.$review->technician->photo) : url('upload/no_image.jpg') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                                                </figure>
                                                                <strong>{{ $review->technician->name }}</strong>
                                                                <span class="badge bg-primary ms-2">Technician</span>
                                                            </div>
                                                            <p class="mb-0">{{ $review->technician_reply }}</p>
                                                            <small class="text-muted">Replied {{ $review->replied_at ? $review->replied_at->diffForHumans() : '' }}</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-5">
                                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">No reviews yet. Be the first to review this service!</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>




    <div class="schedule-box content-widget">
        <div class="title-box">
            <h4>Booking This Service</h4>
        </div>
        <div class="form-inner">
            <form action="{{ route('store.booking') }}" method="post">
                @csrf 

                
                <div class="row clearfix">
             
  <input type="hidden" name="service_id" value="{{ $service->id }}">  
  

<input type="hidden" name="technician_id" value="{{ $service->technician_id }}">
     

                    <div class="col-lg-6 col-md-12 col-sm-12 column">
                        <div class="form-group">
                            <i class="far fa-calendar-alt"></i>
                            <input type="text" name="booking_date" placeholder="Booking Date" id="datepicker">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 column">
                        <div class="form-group">
                            <i class="far fa-clock"></i>
                            <input type="text" name="booking_time" placeholder="Any Time">
                        </div>
                    </div>
                      
                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                        <div class="form-group">
                            <textarea name="message" placeholder="Your message"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                        <div class="form-group message-btn">
                            <button type="submit" class="theme-btn btn-one">Booking Now</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">



                         <div class="property-sidebar default-sidebar">
        <div class="author-widget sidebar-widget">
            <div class="author-box">


              <figure class="author-thumb"> <a href="{{ route('technician.details', $service->user->id) }}"><img src="{{ (!empty($service->user->photo)) ? url('upload/technician_images/'.$service->user->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
                <div class="inner">                    @if($service->user->status == 'active')
                    <h5 class="technician-status-badge" data-technician-id="{{ $service->user->id }}"><span class="badge rounded-pill status-badge bg-success text-white">Active</span></h5>
@else
    <h5 class="technician-status-badge" data-technician-id="{{ $service->user->id }}"><span class="badge rounded-pill status-badge bg-danger text-white">Inactive</span></h5>
@endif
                    <h4><a href="{{ route('technician.details', $service->user->id) }}" class="tech-name-link">
            {{ $service->user->name }}
        </a></h4>
                    <ul class="info clearfix">
                        <li><i class="fas fa-map-marker-alt"></i>{{ $service->user->address }}</li>
                        <li><i class="fas fa-phone"></i><a href="tel:{{ $service->user->phone }}">{{ $service->user->phone }}</a></li>
                    </ul>
                    <!-- <div class="btn-box"><a href="{{ route('technician.details',$service->user->id) }}">View Listing</a></div> -->
                    @auth
                    <div class="technician-chat-wrapper" data-technician-id="{{ $service->user->id }}">
                        <div id="app" class="technician-chat-box {{ $service->user->status === 'active' ? '' : 'd-none' }}">
                            <send-message :receiverid="{{ $service->technician_id }}" receivername="{{ $service->user->name }}">

                            </send-message>
                        </div>
                        <span class="text-danger technician-inactive-message {{ $service->user->status === 'active' ? 'd-none' : '' }}">Technician is currently inactive.</span>
                    </div>
                    @else
                    <span class="text-danger">For Chat Login First </span>
                    @endauth
                </div>

            </div>



 <div class="form-inner">
@auth

@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp

 <form action="{{ route('service.report') }}" method="post" class="default-form">
    @csrf 

    <input type="hidden" name="service_id" value="{{ $service->id }}">


    <input type="hidden" name="technician_id" value="{{ $service->technician_id }}">

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
                <button type="submit" class="theme-btn btn-one">Report Service</button>
            </div>
        </form>

@else

<form action="{{ route('service.report') }}" method="post" class="default-form">
    @csrf 

    <input type="hidden" name="service_id" value="{{ $service->id }}">

    <input type="hidden" name="technician_id" value="{{ $service->technician_id }}">

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
                <button type="submit" class="theme-btn btn-one">Report Service</button>
            </div>
        </form>

@endauth
 


    </div>



</div>




                            </div>


                        </div>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="similar-content similar-content-align">
                            <div class="title">
                                <h4>Similar Services</h4>
                            </div>
                            <div class="row clearfix">



                                @foreach($relatedService as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block" data-service-id="{{ $item->id }}">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset($item->service_thumbnail  ) }}" alt=""></figure>
                                <div class="batch"><i class="icon-11"></i></div>
                                <span class="category">{{ $item->type->type_name }}</span>
                            </div>
                            <div class="lower-content">
                                <div class="author-info clearfix">
                                    <div class="author pull-left">

                           <figure class="author-thumb"><img src="{{ (!empty($item->user->photo)) ? url('upload/technician_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt=""></figure>
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
                                <div class="title-text"><h4><a href="{{ url('service/details/'.$item->id.'/'.$item->service_slug) }}">{{ $item->service_name }}</a></h4></div>
                                <div class="price-box clearfix">
                                    <div class="price-info pull-left">
                                        <h6>Start From</h6>
                                        <h4>RM {{ $item->lowest_fee }}</h4>
                                    </div>
                                    <ul class="other-option pull-right clearfix">
                                        <li><a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="addToCompare(this.id)"><i class="icon-12"></i></a></li>
                       
                        <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addToWishList(this.id)" ><i class="icon-13"></i></a></li>
                                    </ul>
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
                                <div class="btn-box"><a href="{{ url('service/details/'.$item->id.'/'.$item->service_slug) }}" class="theme-btn btn-two">See Details</a></div>
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
        </section>
        <!-- service-details end -->


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

.property-details .similar-content.similar-content-align {
    padding-left: 30px;
    padding-right: 30px;
}



</style>

{{-- Define mainServiceId for global WebSocket listener --}}
<script type="text/javascript">
    var mainServiceId = {{ $service->id }};
</script>

@endsection
