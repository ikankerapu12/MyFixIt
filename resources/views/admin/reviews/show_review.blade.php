@extends('admin.admin_dashboard')
@section('admin')

@section('title1')
  Review Details | MyFixIt  
@endsection

<div class="page-content">
    {{-- <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.all.reviews') }}">Reviews</a></li>
            <li class="breadcrumb-item active" aria-current="page">Review Details</li>
        </ol>
    </nav> --}}

    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Review Details</h6>
                    
                    <!-- Service Info -->
                    <div class="d-flex align-items-center mb-4 p-3" style="background: #f8f9fa; border-radius: 8px;">
                        <img src="{{ asset($review->service->service_thumbnail) }}" 
                             alt="" class="rounded me-3" style="width: 80px; height: 60px; object-fit: cover;">
                        <div>
                            <h5 class="mb-1">{{ $review->service->service_name }}</h5>
                            <small class="text-muted">Service Code: {{ $review->service->service_code }}</small>
                        </div>
                    </div>

                    <!-- Customer Review -->
                    <div class="review-section mb-4">
                        <h6 class="text-muted mb-3">Customer Review</h6>
                        <div class="d-flex">
                            <img src="{{ (!empty($review->user->photo)) ? url('upload/user_images/'.$review->user->photo) : url('upload/no_image.jpg') }}" 
                                 alt="" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-0">{{ $review->user->name }}</h6>
                                        <small class="text-muted">{{ $review->user->email }}</small>
                                    </div>
                                    <small class="text-muted">{{ $review->created_at->format('d M Y, H:i') }}</small>
                                </div>
                                
                                <!-- Rating Stars -->
                                <div class="mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                    <span class="ms-2 text-muted">({{ $review->rating }}/5)</span>
                                </div>
                                
                                <!-- Comment -->
                                <p class="mb-0" style="white-space: pre-wrap;">{{ $review->comment }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Booking Info Sidebar -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Booking Information</h6>
                    
                    @if($review->booking)
                        <div class="mb-3">
                            <small class="text-muted d-block">Booking Date</small>
                            <strong>{{ $review->booking->booking_date }}</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Booking Time</small>
                            <strong>{{ $review->booking->booking_time }}</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Service Fee</small>
                            <strong>RM {{ $review->booking->confirm_fee ?? 'N/A' }}</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Invoice</small>
                            <strong>{{ $review->booking->invoice ?? 'N/A' }}</strong>
                        </div>
                    @else
                        <p class="text-muted">Booking information not available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
