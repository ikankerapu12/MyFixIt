<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compare;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Service;
use App\Models\MultiImage;
use App\Models\ServiceType;
use App\Models\User;

class CompareController extends Controller
{
    public function AddToCompare(Request $request, $service_id){

        if(Auth::check()){

            $exists = Compare::where('user_id',Auth::id())->where('service_id',$service_id)->first();

            if (!$exists) {
                Compare::insert([
                'user_id' => Auth::id(),
                'service_id' => $service_id,
                'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Successfully Added On Your Compare']);
            }else{
                return response()->json(['error' => 'This Service Has Already in your CompareList']);
            }

        }else{
            return response()->json(['error' => 'Please Login First']);
        }


    } 

    public function UserCompare(){ 

        return view('frontend.dashboard.compare');



    }

    public function GetCompareService(){

        $compare = Compare::with('service.type', 'service.sseksyen')
    ->where('user_id',Auth::id())
    ->latest()
    ->get();

        return response()->json($compare);

    }

    public function CompareRemove($id){

      Compare::where('user_id',Auth::id())->where('id',$id)->delete();
      return response()->json(['success' => 'Successfully Service Remove']);

    }
}
