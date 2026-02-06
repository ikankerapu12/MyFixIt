@extends('technician.technician_dashboard')
@section('technician')

<div class="page-content">
    <nav class="page-breadcrumb">
        {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('technician.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('technician.all.reviews') }}">Reviews</a></li>
            <li class="breadcrumb-item active" aria-current="page">Review Details</li>
        </ol> --}}
    </nav>

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

                    <hr>

                    <!-- Your Reply Section -->
                    <div class="reply-section">
                        <h6 class="text-muted mb-3">Your Reply</h6>
                        
                        @if($review->technician_reply)
                            <!-- Existing Reply -->
                            <div class="p-3" style="background: #e3f2fd; border-radius: 8px; border-left: 4px solid #2196f3;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <strong>Your Response:</strong>
                                    <small class="text-muted">{{ $review->replied_at ? $review->replied_at->format('d M Y, H:i') : '' }}</small>
                                </div>
                                <p class="mb-0" style="white-space: pre-wrap;">{{ $review->technician_reply }}</p>
                            </div>
                            
                            <div class="mt-3">
                                <button type="button" class="btn btn-sm btn-outline-primary" id="editReplyBtn">
                                    <i data-feather="edit-2" class="me-1"></i> Edit Reply
                                </button>
                            </div>
                            
                            <!-- Hidden Edit Form -->
                            <div id="editReplyForm" style="display: none;" class="mt-3">
                                <form action="{{ route('technician.reply.review') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="review_id" value="{{ $review->id }}">
                                    <div class="mb-3">
                                        <label class="form-label">Update Your Reply</label>
                                        <textarea name="technician_reply" class="form-control" rows="4" required minlength="5" maxlength="1000">{{ $review->technician_reply }}</textarea>
                                        <small class="text-muted">Minimum 5 characters</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i data-feather="check" class="me-1"></i> Update Reply
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancel</button>
                                </form>
                            </div>
                        @else
                            <!-- New Reply Form -->
                            <form action="{{ route('technician.reply.review') }}" method="POST">
                                @csrf
                                <input type="hidden" name="review_id" value="{{ $review->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Write your reply to the customer</label>
                                    <textarea name="technician_reply" class="form-control" rows="4" 
                                              placeholder="Thank the customer and address their feedback..." 
                                              required minlength="5" maxlength="1000">{{ old('technician_reply') }}</textarea>
                                    <small class="text-muted">Minimum 5 characters</small>
                                    @error('technician_reply')
                                        <span class="text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i data-feather="send" class="me-1"></i> Submit Reply
                                </button>
                            </form>
                        @endif
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editBtn = document.getElementById('editReplyBtn');
        const cancelBtn = document.getElementById('cancelEditBtn');
        const editForm = document.getElementById('editReplyForm');
        
        if (editBtn) {
            editBtn.addEventListener('click', function() {
                editForm.style.display = 'block';
                editBtn.parentElement.style.display = 'none';
            });
        }
        
        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                editForm.style.display = 'none';
                editBtn.parentElement.style.display = 'block';
            });
        }
    });
</script>

@endsection
