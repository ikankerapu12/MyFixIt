<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceType;
use Carbon\Carbon;  
use App\Models\Seksyen;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SeksyenController extends Controller
{
    public function AllSeksyen(){

        $seksyen = Seksyen::latest()->get();
        return view('backend.seksyen.all_seksyen',compact('seksyen'));

    }

    public function AddSeksyen(){
        return view('backend.seksyen.add_seksyen');
    }


    public function StoreSeksyen(Request $request) {

        $request->validate([
            'seksyen_name'  => 'required|string|max:255|unique:seksyens',
            'seksyen_image' => 'required|image|mimes:jpg,jpeg,png,webp',
        ]);

      
        $manager = new ImageManager(new Driver());

        $image = $request->file('seksyen_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        
        $manager->read($image)
            ->resize(370, 275)
            ->toJpeg(80)
            ->save(public_path('upload/seksyen/'.$name_gen));

        $save_url = 'upload/seksyen/'.$name_gen;

        
        Seksyen::insert([
            'seksyen_name'  => $request->seksyen_name,
            'seksyen_image'=> $save_url,
            'created_at' => Carbon::now(),
        ]);

        // ✅ Notification
        $notification = [
            'message' => 'Seksyen Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.seksyen')->with($notification);
    }


    public function EditSeksyen($id){

        $seksyen = Seksyen::findOrFail($id);
        return view('backend.seksyen.edit_seksyen',compact('seksyen'));

    }


    public function UpdateSeksyen(Request $request)
{
    $seksyen_id = $request->id;
    $oldImage   = $request->old_img; // IMPORTANT

    $request->validate([
        'seksyen_name'  => 'required|string|max:255|unique:seksyens',
        'seksyen_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
    ]);

 
    if ($request->hasFile('seksyen_image')) {

        $manager = new ImageManager(new Driver());
        $image   = $request->file('seksyen_image');

        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        $manager->read($image)
            ->resize(370, 275)
            ->toJpeg(80)
            ->save(public_path('upload/seksyen/'.$name_gen));

        $save_url = 'upload/seksyen/'.$name_gen;

    
        if ($oldImage && file_exists(public_path($oldImage))) {
            unlink(public_path($oldImage));
        }

        Seksyen::findOrFail($seksyen_id)->update([
            'seksyen_name'  => $request->seksyen_name,
            'seksyen_image' => $save_url,
            'updated_at'    => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Seksyen Updated with Image Successfully',
            'alert-type' => 'success'
        ];

    } else {

        Seksyen::findOrFail($seksyen_id)->update([
            'seksyen_name' => $request->seksyen_name,
            'updated_at'   => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Seksyen Updated Successfully',
            'alert-type' => 'success'
        ];
    }

    return redirect()->route('all.seksyen')->with($notification);
}


    public function DeleteSeksyen($id) {
        $seksyen = Seksyen::findOrFail($id);

    
        if ($seksyen->seksyen_image &&
            file_exists(public_path($seksyen->seksyen_image))) {

            unlink(public_path($seksyen->seksyen_image));
        }

    
        $seksyen->delete();

        return redirect()->back()->with([
            'message' => 'Seksyen Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }



}
