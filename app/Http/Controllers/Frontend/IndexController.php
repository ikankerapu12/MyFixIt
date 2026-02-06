<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\MultiImage;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Seksyen;
use App\Models\Booking; 
use Carbon\Carbon;
use App\Models\ReportService;  
use App\Models\ReportTechnician;  
use App\Models\SiteSetting;
use App\Models\TermsSetting;
use App\Models\PrivacySetting;
use App\Models\AboutSetting;


class IndexController extends Controller
{

    public function ServiceDetails($id,$slug){

         $service = Service::findOrFail($id);
         $multiImage = MultiImage::where('service_id',$id)->get();

         $stype_id = $service->stype_id;
         $relatedService = Service::where('stype_id',$stype_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(3)->get();

         $video_url = $service->service_video;

// Check for YouTube Short link format
if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $video_url, $matches)) {
    $service->service_video = 'https://www.youtube.com/embed/' . $matches[1];
} elseif (preg_match('/youtube\.com\/shorts\/([a-zA-Z0-9_-]{11})/', $video_url, $matches)) {
    $service->service_video = 'https://www.youtube.com/embed/' . $matches[1];
} else {
    // Handle non-YouTube short URLs if needed
    $service->service_video = ''; // Or show a default message
}
         return view('frontend.service.service_details',compact('service','multiImage','relatedService'));

    }


    public function TechnicianDetails($id){

        $technician = User::findOrFail($id);
        $service = Service::where('technician_id',$id)->get();

        $featured = Service::where('featured','1')->limit(3)->get();
        return view('frontend.technician.technician_details',compact('technician','service','featured'));

    }

    public function ServiceType($id){

        $service = Service::where('stype_id',$id)->paginate(3);

        $sbread = ServiceType::where('id',$id)->first();

        return view('frontend.service.service_type',compact('service','sbread'));

    }

    public function AllServiceType()
    {
        $serviceTypes = ServiceType::all(); 
        return view('frontend.service.all_service_type', compact('serviceTypes'));
    }

    public function AllFeaturedServices() {

    $services = Service::where('featured', '1')->paginate(6); 

    return view('frontend.service.featured_services', compact('services'));
    }

    public function SeksyenDetails($id)
{
    $service = Service::where('seksyen',$id)
        ->paginate(6); 

    $bseksyen = Seksyen::where('id',$id)->first();

    return view('frontend.seksyen.seksyen_details', compact('service','bseksyen'));
}


// banner search
public function ServiceSearch(Request $request)
{
  
    $request->validate(['search' => 'nullable']);  

    $item = $request->search;
    $fseksyen = $request->seksyen;
    $stype = $request->stype_id;

    $query = Service::query();

    if ($item) {
        $query->where('service_name', 'like', '%' . $item . '%');
    }

 
    if ($fseksyen) {
        $query->whereHas('sseksyen', function ($q) use ($fseksyen) {
            $q->where('seksyen_name', 'like', '%' . $fseksyen . '%');
        });
    }

    if ($stype) {
        $query->whereHas('type', function ($q) use ($stype) {
            $q->where('type_name', 'like', '%' . $stype . '%');
        });
    }


    $service = $query->paginate(3);


    return view('frontend.service.service_search', compact('service', 'item'));
}



    public function AllSeksyenView() {
    
    $seksyon = Seksyen::paginate(9); 
    return view('frontend.seksyen.all_seksyen_view', compact('seksyon'));
}



    // in page service search on page
    public function AllServiceSearch(Request $request)
{
    $stype    = $request->stype_id;
    $sseksyen = $request->seksyen;

    $service = Service::with('type','sseksyen')

        ->when($stype, function ($q) use ($stype) {
            $q->whereHas('type', function ($q2) use ($stype) {
                $q2->where('type_name', $stype);
            });
        })

        ->when($sseksyen, function ($q) use ($sseksyen) {
            $q->whereHas('sseksyen', function ($q2) use ($sseksyen) {
                $q2->where('seksyen_name', $sseksyen);
            });
        })

        ->paginate(6); 

    return view('frontend.service.service_search', compact('service'));
}


    public function StoreBooking(Request $request)
{
    $tid = $request->technician_id;
    $sid = $request->service_id;

    if (Auth::check()) {
        // Check technician's status
        $technician = User::find($tid);
        if ($technician->status != 'active') {
            // Technician is inactive
            $notification = array(
                'message' => 'You cannot book this service as the technician is inactive.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        // Check service status
        $service = Service::find($sid);
        if ($service->status == 2 || $service->status == 3) {
            // Service is either busy or unavailable
            $notification = array(
                'message' => 'You cannot book this service as it is currently busy or unavailable.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        // Proceed with booking if all conditions are satisfied
        Booking::insert([
            'user_id' => Auth::user()->id,
            'service_id' => $sid,
            'technician_id' => $tid,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Booking Request Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } else {
        // User is not logged in
        $notification = array(
            'message' => 'Please Login First',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}


 public function ServiceReport(Request $request){


     $sid = $request->service_id;
        $tid = $request->technician_id;

        if (Auth::check()) {
            
        ReportService::insert([

            'user_id' => Auth::user()->id,
            'technician_id' => $tid,
            'service_id' => $sid,
            'msg_name' => $request->msg_name,
            'msg_email' => $request->msg_email,
            'msg_phone' => $request->msg_phone,
            'message' => $request->message,
            'is_read' => 0,
            'created_at' => Carbon::now(), 

        ]);

        $notification = array(
            'message' => 'Send Report Service Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



        }else{

            $notification = array(
            'message' => 'Please Login Your Account First',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
        }


    }




    public function TechnicianReport(Request $request){


        $tid = $request->technician_id;

        if (Auth::check()) {
            
        ReportTechnician::insert([

            'user_id' => Auth::user()->id,
            'technician_id' => $tid,
            'msg_name' => $request->msg_name,
            'msg_email' => $request->msg_email,
            'msg_phone' => $request->msg_phone,
            'message' => $request->message,
            'is_read' => 0,
            'created_at' => Carbon::now(), 

        ]);

        $notification = array(
            'message' => 'Send Report Technician Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



        }else{

            $notification = array(
            'message' => 'Please Login Your Account First',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
        }


    }



    public function TermsService() {
    
    $setting = SiteSetting::find(1);
    $terms = TermsSetting::find(1);
    return view('frontend.TermsandPrivacy.Terms_Service',compact('terms','setting'));
}

    public function PrivacyPolicy() {
    
    $setting = SiteSetting::find(1);
    $privacy = PrivacySetting::find(1);
    return view('frontend.TermsandPrivacy.Privacy_Policy',compact('privacy','setting'));
}

    public function AboutUs() {

    $setting = SiteSetting::find(1);
    $about = AboutSetting::find(1);
    return view('frontend.about.about_us',compact('about','setting'));
}
}
