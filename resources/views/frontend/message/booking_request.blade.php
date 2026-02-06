@extends('frontend.frontend_dashboard')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('title')
  Booking Request | MyFixIt  
@endsection
<!--Page Title-->
<section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
    <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>Booking Request </h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Booking Request </li>
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
                                        
                                         
                                      
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Service Name </th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Confirm Fee</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($srequest as $key => $item)
        @php
            $hasReview = \App\Models\ServiceReview::where('booking_id', $item->id)->exists();
        @endphp
                                            <tr>
                                                <th scope="row">{{ $key+1 }}</th>
                                                <td>{{ $item['service']['service_name'] }}</td>
                                                <td>{{ $item->booking_date }}</td>
                                                <td>{{ $item->booking_time }}</td>
                                                <td>RM {{ $item->confirm_fee ?? 0 }}</td>
                                                <td>
                                                    @if($item->status == 1)
                                                        <span class="badge rounded-pill bg-success text-dark">Confirm</span>
                                                    @elseif($item->status == 0)
                                                        <span class="badge rounded-pill bg-warning text-dark">Pending</span>
                                                    @elseif($item->status == 2)
                                                        <span class="badge rounded-pill bg-danger text-dark">Rejected</span>
                                                    @elseif($item->status == 3)
                                                        <span class="badge rounded-pill bg-secondary text-dark">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        @if($item->status == 1)
                                                            <!-- Invoice Button with Icon -->
                                                            <a href="{{ route('user.booking.invoice', $item->id) }}" class="btn btn-info" title="Invoice">
                                                                <i data-feather="file-text"></i>  <!-- Icon for Invoice -->
                                                            </a>

                                                            <!-- Review Button with Icon -->
                                                            @if($hasReview)
                                                                <a href="#" class="btn btn-secondary" title="Reviewed" disabled>
                                                                    <i data-feather="check-circle"></i>  <!-- Icon for Already Reviewed -->
                                                                </a>
                                                            @else
                                                                <a href="{{ route('user.write.review', $item->id) }}" class="btn btn-primary" title="Write Review">
                                                                    <i data-feather="star"></i>  <!-- Icon for Review -->
                                                                </a>
                                                            @endif
                                                        @elseif($item->status == 2)
                                                        {{ $item->rejection_message }}
                                                        @elseif($item->status == 3)
                                                        {{ $item->cancellation_message }}
                                                        @endif

                                                        <!-- Delete Button with Icon (always available) -->
                                                        <a href="{{ route('user.delete.booking', $item->id) }}" class="btn btn-danger" title="Delete">
                                                            <i data-feather="trash-2"></i>  <!-- Icon for Delete -->
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
  </tbody>
</table>


 

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

    .action-buttons {
        display: flex;
        gap: 10px; /* Space between buttons */
        justify-content: center; /* Center buttons horizontally */
    }

    .action-buttons .btn {
        display: inline-flex; /* Ensure buttons are inline */
        align-items: center; /* Vertically center the content */
    }
</style>

@endsection