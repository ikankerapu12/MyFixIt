@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
  {{ $bseksyen->seksyen_name }} | MyFixIt  
@endsection
<!--Page Title-->
<section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>{{ $bseksyen->seksyen_name }} Services</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>{{ $bseksyen->seksyen_name }}</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->
 


        <!-- property-page-section -->
        <section class="property-page-section property-list">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="default-sidebar property-sidebar">
                            <div class="filter-widget sidebar-widget">
                                <div class="widget-title">
                                    <h5>Service</h5>
                                </div>

 @php
$seksyen = App\Models\Seksyen::latest()->get();
$stypes = App\Models\ServiceType::latest()->get();

 @endphp

  <form action="{{ route('all.service.search') }}" method="post" class="search-form">
    @csrf 

    <div class="widget-content">
        <div class="select-box">
            <select name="stype_id" class="wide">
               <option data-display="Type" selected="" disabled="" >Select Type</option>
               
              @foreach($stypes as $type)
   <option value="{{ $type->type_name }}">{{ $type->type_name }}</option>
   @endforeach
                
            </select>
        </div>
        <div class="select-box">
            <select name="seksyen" class="wide">
               <option data-display="Seksyen" selected="" disabled="" >Select Seksyen</option>
               @foreach($seksyen as $seksyen)
   <option value="{{ $seksyen->seksyen_name }}">{{ $seksyen->seksyen_name }}</option>
   @endforeach
            </select>
        </div>
      
        <div class="filter-btn">
            <button type="submit" class="theme-btn btn-one"><i class="fas fa-filter"></i>&nbsp;Filter</button>
        </div>
    </div>
</form>


</div>


                            <!-- <div class="price-filter sidebar-widget">
                                <div class="widget-title">
                                    <h5>Select Price Range</h5>
                                </div>
                                <div class="range-slider clearfix">
                                    <div class="clearfix">
                                        <div class="input">
                                            <input type="text" class="property-amount" name="field-name" readonly="">
                                        </div>
                                    </div>
                                    <div class="price-range-slider"></div>
                                </div>
                            </div> -->
                        
                             
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="property-content-side">
                            <div class="item-shorting clearfix">
                                <div class="left-column pull-left">
            <h5>Seksyen - {{ $bseksyen->seksyen_name }}: <span> {{ count($service) }} Services</span></h5>
                                </div>
                                <div class="right-column pull-right clearfix">
                                     
                                   
                                </div>
                            </div>
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
         <div class="title-text"><h4><a href="{{ url('service/details/'.$item->id.'/'.$item->service_slug) }}">{{ $item->service_name }}</a></h4> @if($item->status == 1)
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
                                    <div class="pagination-wrapper">
            {{ $service->links('vendor.pagination.custom') }}
        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- service-page-section end -->


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
