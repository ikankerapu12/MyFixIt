<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SiteSetting;

class UserController extends Controller
{
    public function Index(){
        return view('frontend.index');
    }

    public function UserDashboard(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        $bookingRequestCount = Booking::where('user_id', $id)->count();
        $wishlistCount = \App\Models\Wishlist::where('user_id', $id)->count();
        $compareCount = \App\Models\Compare::where('user_id', $id)->count();

        return view('dashboard', compact('userData', 'bookingRequestCount', 'wishlistCount', 'compareCount'));
    }

    public function UserProfile(){

        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.edit_profile',compact('userData'));

    }

    public function UserProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address; 

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName(); 
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;  
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function UserLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function UserChangePassword(){

        return view('frontend.dashboard.change_password');

    }// End Method 


    public function UserPasswordUpdate(Request $request){

        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'

        ]);

        /// Match The Old Password

        if (!Hash::check($request->old_password, auth::user()->password)) {
        
        $notification = array(
            'message' => 'Old Password Does not Match!',
            'alert-type' => 'error'
        );

        return back()->with($notification);
        }

        /// Update The New Password 

        User::whereId(Auth::id())->update([
            'password' => Hash::make($request->new_password)

        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification); 

    }
    

    public function UserBookingRequest(){

        $id = Auth::user()->id;
        $userData = User::find($id);

        $srequest = Booking::where('user_id',$id)->get();
        return view('frontend.message.booking_request',compact('userData','srequest'));

    }

        public function UserBookingInvoice($id){

        $invoice = Booking::where('id',$id)->first();

        $siteSettings = SiteSetting::first();
        $pdf = Pdf::loadView('frontend.message.booking_invoice', compact('invoice','siteSettings'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('myfixit-invoice.pdf');

    }

    public function UserDeleteBooking($id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);

        // Delete the booking
        $booking->delete();

        // Send notification to the user
        $notification = array(
            'message' => 'Booking Request Deleted Successfully',
            'alert-type' => 'error'
        );

        // Redirect back to the booking request list with a success message
        return back()->with($notification);
    }

    public function UserChat(){

        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.chat_message',compact('userData'));

    }

}
