<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceType;

class ServiceTypeController extends Controller
{
    public function AllType(){

        $types = ServiceType::latest()->get();
        return view('backend.type.all_type',compact('types'));

    }

    public function AddType(){

        return view('backend.type.add_type');

    }

    public function StoreType(Request $request){

        $request->validate([
            'type_name' => 'required|unique:service_types|max:160',
            'type_icon' => 'required'

        ]);

        ServiceType::insert([

            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);

        $notification = array(
            'message' => 'Service Type Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.type')->with($notification);

    }

    public function EditType($id){

        $types = ServiceType::findOrFail($id);
        return view('backend.type.edit_type',compact('types'));

    }// End Method 

    public function UpdateType(Request $request){

        $sid = $request->id;
    
        ServiceType::findOrFail($sid)->update([ 

            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon, 
        ]);

        $notification = array(
            'message' => 'Service Type Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.type')->with($notification);

    }

    public function DeleteType($id){

        ServiceType::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Service Type Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

}
