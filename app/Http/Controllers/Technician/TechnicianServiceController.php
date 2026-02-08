<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\MultiImage;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use App\Models\Seksyen;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingMail;
use App\Models\SiteSetting;

class TechnicianServiceController extends Controller
{
    public function TechnicianAllService(){

        $id = Auth::user()->id;
        $service = Service::where('technician_id',$id)->latest()->get();
        return view('technician.service.all_service',compact('service'));

    }


    public function TechnicianAddService(){

        $servicetype = ServiceType::latest()->get();
        $sseksyen = Seksyen::latest()->get();
        return view('technician.service.add_service',compact('servicetype', 'sseksyen'));

    }

    public function TechnicianStoreService(Request $request) {

    $request->validate([
        'service_thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp'
    ]);

    $scode = IdGenerator::generate([
        'table' => 'services',
        'field' => 'service_code',
        'length' => 5,
        'prefix' => 'SC'
    ]);

    // Image pasti ada
    $manager = new ImageManager(new Driver());
    $name_gen = hexdec(uniqid()).'.'.$request->file('service_thumbnail')->getClientOriginalExtension();

    $img = $manager->read($request->file('service_thumbnail'));
    $img->resize(370,250)
        ->toJpeg(80)
        ->save(public_path('upload/service/thumbnail/'.$name_gen));

    $save_url = 'upload/service/thumbnail/'.$name_gen;

    // INSERT DI LUAR IF
    $service_id = Service::insertGetId([
        'stype_id' => $request->stype_id,
        'service_name' => $request->service_name,
        'service_slug' => strtolower(str_replace(' ', '-', $request->service_name)),
        'service_code' => $scode,

        'lowest_fee' => $request->lowest_fee,
        'max_fee' => $request->max_fee,
        'short_descp' => $request->short_descp,
        'long_descp' => $request->long_descp,

        'service_video' => $request->service_video,
        'seksyen' => $request->seksyen,
        'address' => $request->address,
        'city' => $request->city,
        'state' => $request->state,
        'postal_code' => $request->postal_code,

        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        // 'featured' => $request->featured,
        // 'hot' => $request->hot,
        'technician_id' => Auth::user()->id,
        'status' => 1,

        'service_thumbnail' => $save_url,
        'created_at' => Carbon::now(),
    ]);

        //// MULTI IMAGE UPLOAD (WAJIB) ////

$request->validate([
    'multi_img' => 'required',
    'multi_img.*' => 'image|mimes:jpg,jpeg,png,webp'
]);

foreach ($request->file('multi_img') as $img) {

    $manager = new ImageManager(new Driver());
    $name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();

    $manager->read($img)
        ->resize(770,520)
        ->toJpeg(80)
        ->save(public_path('upload/service/multi-image/'.$name));

    MultiImage::create([
        'service_id' => $service_id,
        'photo_name' => 'upload/service/multi-image/'.$name,
    ]);
}

         /// End Multiple Image Upload From Here ////

        $notification = array(
            'message' => 'Service Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('technician.all.service')->with($notification);


    }

    
    public function TechnicianEditService($id){

        $multiImage = MultiImage::where('service_id',$id)->get();

        $sseksyen = Seksyen::latest()->get();
        $service = Service::findOrFail($id);
        $servicetype = ServiceType::latest()->get();

        return view('technician.service.edit_service',compact('service','servicetype', 'multiImage', 'sseksyen'));

    }

    public function TechnicianUpdateService(Request $request){

        $service_id = $request->id;

        Service::findOrFail($service_id)->update([

            'stype_id' => $request->stype_id,
            'service_name' => $request->service_name,
            'service_slug' => strtolower(str_replace(' ', '-', $request->service_name)), 

            'lowest_fee' => $request->lowest_fee,
            'max_fee' => $request->max_fee,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,

            'service_video' => $request->service_video,
            'address' => $request->address,
            'seksyen' => $request->seksyen,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,

            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            // 'featured' => $request->featured,
            // 'hot' => $request->hot,
            'technician_id' => Auth::user()->id, 
            'updated_at' => Carbon::now(), 

        ]);

        $notification = array(
            'message' => 'Service Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('technician.all.service')->with($notification); 

    }

    public function TechnicianUpdateServiceThumbnail(Request $request) {

        $request->validate([
            'service_thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp'
        ]);

        $ser_id   = $request->id;
        $oldImage = $request->old_img;

        $manager = new ImageManager(new Driver());

        $image    = $request->file('service_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        $manager->read($image)
            ->resize(370, 250)
            ->toJpeg(80)
            ->save(public_path('upload/service/thumbnail/' . $name_gen));

        $save_url = 'upload/service/thumbnail/' . $name_gen;

        if ($oldImage && file_exists(public_path($oldImage))) {
            unlink(public_path($oldImage));
        }

        Service::findOrFail($ser_id)->update([
            'service_thumbnail' => $save_url,
            'updated_at'        => Carbon::now(),
        ]);

        return redirect()->back()->with([
            'message'    => 'Service Image Thumbnail Updated Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function TechnicianUpdateServiceMultiimage(Request $request) {

    $request->validate([
        'multi_img'   => 'required',
        'multi_img.*' => 'image|mimes:jpg,jpeg,png,webp'
    ],[
    'multi_img.required' => 'Please upload at least one image.',
    'multi_img.*.image' => 'The uploaded file must be a valid image.',
    ]);

    $manager = new ImageManager(new Driver());


    foreach ($request->file('multi_img') as $id => $img) {


        $oldImage = MultiImage::findOrFail($id);


        if (file_exists(public_path($oldImage->photo_name))) {
            unlink(public_path($oldImage->photo_name));
        }

        $name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();

        $manager->read($img)
            ->resize(770, 520)
            ->toJpeg(80)
            ->save(public_path('upload/service/multi-image/' . $name));

        $oldImage->update([
            'photo_name' => 'upload/service/multi-image/' . $name,
            'updated_at' => Carbon::now(),
        ]);
    }

        return redirect()->back()->with([
            'message' => 'Service Multi Images Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function TechnicianServiceMultiImageDelete($id) {

        $image = MultiImage::findOrFail($id);

        if ($image->photo_name && file_exists(public_path($image->photo_name))) {
            unlink(public_path($image->photo_name));
        }

        $image->delete();

        return redirect()->back()->with([
            'message' => 'Service Multi Image Deleted Successfully.',
            'alert-type' => 'success'
        ]);
    }


    public function TechnicianStoreNewMultiimage(Request $request) {

        $request->validate([
            'imageid'   => 'required|exists:services,id',
            'multi_img' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'multi_img.required' => 'Please upload an image.',
            'multi_img.image'    => 'The file must be an image.',
        ]);

        $manager = new ImageManager(new Driver());

        $imageFile = $request->file('multi_img');
        $name_gen  = hexdec(uniqid()).'.'.$imageFile->getClientOriginalExtension();

        $img = $manager->read($imageFile);
        $img->resize(770, 520)
            ->toJpeg(80)
            ->save(public_path('upload/service/multi-image/'.$name_gen));

        $uploadPath = 'upload/service/multi-image/'.$name_gen;

        MultiImage::create([
            'service_id' => $request->imageid,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with([
            'message' => 'Service Multi Image Added Successfully.',
            'alert-type' => 'success'
        ]);
    }

    public function TechnicianDeleteService($id) {

        $service = Service::findOrFail($id);

        if ($service->service_thumbnail &&
            file_exists(public_path($service->service_thumbnail))) {

            unlink(public_path($service->service_thumbnail));
        }

        $multiImages = MultiImage::where('service_id', $service->id)->get();

        foreach ($multiImages as $img) {
            if ($img->photo_name &&
                file_exists(public_path($img->photo_name))) {

                unlink(public_path($img->photo_name));
            }

            $img->delete();
        }

        $service->delete();

        return redirect()->back()->with([
            'message' => 'Service Deleted Successfully.',
            'alert-type' => 'success'
        ]);
    }

    public function TechnicianDetailsService($id){

        $service = Service::findOrFail($id);

        $multiImage = MultiImage::where('service_id',$id)->get();

        $servicetype = ServiceType::latest()->get();

        return view('technician.service.details_service',compact('service','servicetype','multiImage'));

    }













    //booking
    public function TechnicianBookingRequest()
{
    $id = Auth::user()->id;
    $usermsg = Booking::where('technician_id', $id)->get();
    return view('technician.booking.booking_request', compact('usermsg'));
}

public function TechnicianDetailsBooking($id)
{
    $booking = Booking::findOrFail($id);
    return view('technician.booking.booking_details', compact('booking'));
}

public function TechnicianUpdateBooking(Request $request)
{
    $sid = $request->id;

    // Confirm booking logic
    $sendmail = Booking::with('user', 'service')->findOrFail($sid);
    $sendmail->update([
        'status' => '1',  // Confirm status
        'confirm_fee' => $request->confirm_fee,
        'invoice' => 'MFI'.mt_rand(10000000,99999999),
    ]);


    // Notification after success
    $notification = [
        'message' => 'You have Confirmed the Booking Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('technician.booking.request')->with($notification);
}

public function TechnicianRejectBooking(Request $request)
{
    $sid = $request->id;

    // Reject booking logic
    $sendmail = Booking::with('user', 'service')->findOrFail($sid);
    $sendmail->update([
        'status' => '2',  // Rejected status
        'rejection_message' => $request->rejection_message  // Store the rejection reason
    ]);

    // Notification after rejection
    $notification = [
        'message' => 'Booking Request has been Rejected',
        'alert-type' => 'error'
    ];

    return redirect()->route('technician.booking.request')->with($notification);
}

public function TechnicianCancelBooking(Request $request)
{
    $sid = $request->id;

    // Cancel booking logic
    $sendmail = Booking::with('user', 'service')->findOrFail($sid);
    $sendmail->update([
        'status' => '3',  // Cancelled status
        'cancellation_message' => $request->cancellation_message,
    ]);

    // Notification after cancellation
    $notification = [
        'message' => 'Booking Request has been Cancelled',
        'alert-type' => 'error'
    ];

    return redirect()->route('technician.booking.request')->with($notification);
}

public function TechnicianDeleteBooking($id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);

        // Delete the booking
        $booking->delete();

        // Send notification to technician
        $notification = array(
            'message' => 'Booking Request Deleted Successfully',
            'alert-type' => 'error'
        );

        // Redirect back to the booking request list with a success message
        return redirect()->route('technician.booking.request')->with($notification);
    }


    ///// REVIEWS MANAGEMENT /////

    public function AllReviews()
    {
        $id = Auth::user()->id;
        $reviews = \App\Models\ServiceReview::with(['service', 'user', 'booking'])
            ->where('technician_id', $id)
            ->latest()
            ->get();
        
        return view('technician.reviews.all_reviews', compact('reviews'));
    }

    public function ShowReview($id)
    {
        $review = \App\Models\ServiceReview::with(['service', 'user', 'booking'])
            ->findOrFail($id);
        
        // Verify the review belongs to this technician
        if ($review->technician_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        return view('technician.reviews.show_review', compact('review'));
    }

    public function ReplyReview(Request $request)
    {
        $request->validate([
            'review_id' => 'required|exists:service_reviews,id',
            'technician_reply' => 'required|string|min:5|max:1000',
        ]);

        $review = \App\Models\ServiceReview::findOrFail($request->review_id);

        // Verify the review belongs to this technician
        if ($review->technician_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $review->update([
            'technician_reply' => $request->technician_reply,
            'replied_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Reply submitted successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('technician.all.reviews')->with($notification);
    }

}
