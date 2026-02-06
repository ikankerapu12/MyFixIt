@php
$service = App\Models\Service::where('featured','1')->limit(3)->get();
@endphp

<section class="feature-section sec-pad bg-color-1">
            <div class="auto-container">
                <div class="sec-title centred">
                    <h5>Features</h5>
                    <h2>Featured Services</h2>
                    <p>Discover a range of trusted services for your home maintenance needs, including plumbing, electrical, air-conditioning, and more.</p>
                </div>
                <div class="row clearfix">


                    @foreach($service as $item)
        <div class="col-lg-4 col-md-6 col-sm-12 feature-block" data-service-id="{{ $item->id }}">
            <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                <div class="inner-box">
                    <div class="image-box">
                        <figure class="image"><img src="{{ asset($item->service_thumbnail  ) }}" alt=""></figure>
                        <div class="batch"><i class="icon-11"></i></div>
                        <span class="category">Featured</span>

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
<style>
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

                    </div>
                </div>


                </div>
        </div>
        @endforeach 

                  
                </div>


                <div class="more-btn centred"><a href="{{ route('all.featured.services') }}" class="theme-btn btn-one">View All Listing</a></div>
            </div>
            
        </section>