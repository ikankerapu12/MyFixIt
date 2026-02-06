<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\MultiImage;
use App\Models\ServiceType;
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use App\Models\Seksyen;
use App\Events\ServiceStatusChanged;

class ServiceController extends Controller
{
    public function AllService(){

        $service = Service::latest()->get();
        return view('backend.service.all_service',compact('service'));

    }

    public function AddService(){

        $servicetype = ServiceType::latest()->get();
        $sseksyen = Seksyen::latest()->get();
        $activeTechnician = User::where('status','active')->where('role','technician')->latest()->get();
        return view('backend.service.add_service',compact('servicetype','activeTechnician','sseksyen'));

    }

    public function StoreService(Request $request) {

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
        'featured' => $request->featured,
        'hot' => $request->hot,
        'technician_id' => $request->technician_id,
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

        return redirect()->route('all.service')->with($notification);


    }

    public function EditService($id){

        $multiImage = MultiImage::where('service_id',$id)->get();

        $sseksyen = Seksyen::latest()->get();
        $service = Service::findOrFail($id);
        $servicetype = ServiceType::latest()->get();
        $activeTechnician = User::where('status','active')->where('role','technician')->latest()->get();

        return view('backend.service.edit_service',compact('service','servicetype','activeTechnician', 'multiImage', 'sseksyen'));

    }

    public function UpdateService(Request $request){

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
            'featured' => $request->featured,
            'hot' => $request->hot,
            'technician_id' => $request->technician_id, 
            'updated_at' => Carbon::now(), 

        ]);

        $notification = array(
            'message' => 'Service Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.service')->with($notification); 

    }

    public function UpdateServiceThumbnail(Request $request) {

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


    public function UpdateServiceMultiimage(Request $request) {

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

    public function ServiceMultiImageDelete($id) {

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


    public function StoreNewMultiimage(Request $request) {

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


    public function DeleteService($id) {

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

    public function DetailsService($id){

        $service = Service::findOrFail($id);

        $multiImage = MultiImage::where('service_id',$id)->get();

        $servicetype = ServiceType::latest()->get();
        $activeTechnician = User::where('status','active')->where('role','technician')->latest()->get();

        return view('backend.service.details_service',compact('service','servicetype','activeTechnician','multiImage'));

    }

    public function InactiveService(Request $request){

        $pid = $request->id;
        Service::findOrFail($pid)->update([

            'status' => 0,

        ]);

        $notification = array(
            'message' => 'Service Inactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.service')->with($notification); 


    }// End Method 


    public function ActiveService(Request $request){

        $pid = $request->id;
        Service::findOrFail($pid)->update([

            'status' => 1,

        ]);

        $notification = array(
            'message' => 'Service Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.service')->with($notification); 


    }

    /**
     * Change service status via AJAX with real-time broadcast
     * Status: 1=Available, 2=Busy, 3=Unavailable
     */
    public function changeServiceStatus(Request $request)
    {
        $service = Service::findOrFail($request->service_id);
        $service->status = $request->status;
        $service->save();

        // Broadcast the status change for real-time updates
        broadcast(new ServiceStatusChanged($service->id, $service->status))->toOthers();

        return response()->json([
            'success' => 'Service status changed successfully',
            'status' => $service->status
        ]);
    }
}
