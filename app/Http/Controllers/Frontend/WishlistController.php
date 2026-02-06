<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\MultiImage;
use App\Models\ServiceType;
use App\Models\User;
use App\Models\Wishlist; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WishlistController extends Controller
{
        public function AddToWishList(Request $request, $service_id){
             if(Auth::check()){

            $exists = Wishlist::where('user_id',Auth::id())->where('service_id',$service_id)->first();

            if (!$exists) {
                Wishlist::insert([
                'user_id' => Auth::id(),
                'service_id' => $service_id,
                'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist']);
            }else{
                return response()->json(['error' => 'This Service Has Already in your WishList']);
            }

        }else{
            return response()->json(['error' => 'Please Login First']);

    }
}

        public function UserWishlist(){

        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('frontend.dashboard.wishlist',compact('userData'));

    }

    public function GetWishlistService(){

        $wishlist = Wishlist::with('service.type', 'service.sseksyen')
    ->where('user_id',Auth::id())
    ->latest()
    ->get();

        $wishQty = wishlist::count();

        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);



    }

    public function WishlistRemove($id){

      Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
      return response()->json(['success' => 'Successfully Service Remove']);



    }
}
