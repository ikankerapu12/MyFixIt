<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ServiceReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function writeReview($booking_id)
    {
        // Get the booking with service info
        $booking = Booking::with(['service', 'technician'])->findOrFail($booking_id);
        
        // Verify the booking belongs to the current user
        if ($booking->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }
        
        // Verify booking is confirmed (status = 1)
        if ($booking->status != 1) {
            return redirect()->back()->with('error', 'You can only review confirmed bookings');
        }
        
        // Check if review already exists
        $existingReview = ServiceReview::where('booking_id', $booking_id)->first();
        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this booking');
        }
        
        return view('frontend.review.write_review', compact('booking'));
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        
        // Verify the booking belongs to the current user
        if ($booking->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }
        
        // Check if review already exists
        $existingReview = ServiceReview::where('booking_id', $request->booking_id)->first();
        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this booking');
        }

        ServiceReview::create([
            'service_id' => $booking->service_id,
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'technician_id' => $booking->technician_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $notification = [
            'message' => 'Thank you for your review!',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.booking.request')->with($notification);
    }
}
