@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
  Write Review | MyFixIt  
@endsection

<!--Page Title-->
<section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Write Review</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('user.booking.request') }}">Booking Request</a></li>
                <li>Write Review</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- review-section -->
<section class="contact-section sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 offset-lg-2">
                <div class="form-inner">
                    <!-- Service Info Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <figure class="me-3" style="width: 80px; height: 80px; overflow: hidden; border-radius: 8px;">
                                    <img src="{{ asset($booking->service->service_thumbnail) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                </figure>
                                <div>
                                    <h5>{{ $booking->service->service_name }}</h5>
                                    <p class="mb-1"><i class="fas fa-user me-2"></i>Technician: {{ $booking->technician->name }}</p>
                                    <p class="mb-0"><i class="fas fa-calendar me-2"></i>Booking Date: {{ $booking->booking_date }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Review Form -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-star me-2"></i>Share Your Experience</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.store.review') }}" method="POST">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                                <!-- Star Rating -->
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">Your Rating</label>
                                    <div class="star-rating-input">
                                        <div class="stars-container d-flex gap-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" class="d-none" {{ $i == 5 ? 'checked' : '' }}>
                                                <label for="star{{ $i }}" class="star-label" data-value="{{ $i }}">
                                                    <i class="fas fa-star fa-2x" style="cursor: pointer;"></i>
                                                </label>
                                            @endfor
                                        </div>
                                        <div class="rating-text mt-2">
                                            <span id="rating-text" class="text-muted">Excellent</span>
                                        </div>
                                    </div>
                                    @error('rating')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Comment -->
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">Your Feedback</label>
                                    <textarea name="comment" class="form-control" rows="5" placeholder="Tell us about your experience with this service..." required minlength="10" maxlength="1000">{{ old('comment') }}</textarea>
                                    <small class="text-muted">Minimum 10 characters</small>
                                    @error('comment')
                                        <span class="text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn-one w-100">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Review
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- review-section end -->

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
        animation: moveBackground 45s linear infinite;
    }

    /* Star Rating Styles */
    .star-rating-input .star-label i {
        color: #ddd;
        transition: color 0.2s ease;
    }

    .star-rating-input .star-label.active i,
    .star-rating-input .star-label.hover i {
        color: #ffc107;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: none;
    }

    .card-header {
        border-radius: 12px 12px 0 0 !important;
    }

    .form-control:focus {
        border-color: #5a83ff;
        box-shadow: 0 0 0 0.2rem rgba(90, 131, 255, 0.25);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const starLabels = document.querySelectorAll('.star-label');
    const ratingText = document.getElementById('rating-text');
    const ratingTexts = {
        1: 'Poor',
        2: 'Fair',
        3: 'Good',
        4: 'Very Good',
        5: 'Excellent'
    };

    // Initialize stars based on default selection
    updateStars(5);

    starLabels.forEach(function(label) {
        label.addEventListener('click', function() {
            const value = parseInt(this.dataset.value);
            updateStars(value);
        });

        label.addEventListener('mouseenter', function() {
            const value = parseInt(this.dataset.value);
            highlightStars(value);
        });

        label.addEventListener('mouseleave', function() {
            const checkedRadio = document.querySelector('input[name="rating"]:checked');
            if (checkedRadio) {
                highlightStars(parseInt(checkedRadio.value));
            }
        });
    });

    function updateStars(value) {
        document.getElementById('star' + value).checked = true;
        highlightStars(value);
        ratingText.textContent = ratingTexts[value];
    }

    function highlightStars(value) {
        starLabels.forEach(function(label) {
            const labelValue = parseInt(label.dataset.value);
            if (labelValue <= value) {
                label.classList.add('active');
            } else {
                label.classList.remove('active');
            }
        });
    }
});
</script>

@endsection
