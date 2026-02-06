<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Events\TechnicianStatusChanged;
use App\Models\ReportService;
use App\Models\ReportTechnician;
use App\Models\ServiceReview;

class AdminController extends Controller
{
    public function AdminDashboard(){

        $bookingCount = \App\Models\Booking::count();
        $serviceCount = \App\Models\Service::count();
        $seksyenCount = \App\Models\Seksyen::count();
        $serviceTypeCount = \App\Models\ServiceType::count();
        $userCount = User::where('role','user')->count();
        $technicianCount = User::where('role','technician')->count();

        // Monthly Bookings for Chart
        $monthlyBookings = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyBookings[] = \App\Models\Booking::whereMonth('created_at', $month)->whereYear('created_at', date('Y'))->count();
        }

        // Latest Bookings
        $latestBookings = \App\Models\Booking::with(['user', 'service', 'technician'])->latest()->take(6)->get();

        // Latest Services (All)
        $latestServices = \App\Models\Service::with('user')->latest()->take(6)->get();

        // Latest Technicians
        $latestTechnicians = User::where('role', 'technician')->latest()->take(6)->get();

        // Latest Users
        $latestUsers = User::where('role', 'user')->latest()->take(6)->get();

        return view('admin.index', compact('bookingCount', 'seksyenCount', 'serviceCount', 'serviceTypeCount', 'userCount', 'technicianCount', 'monthlyBookings', 'latestBookings', 'latestServices', 'latestTechnicians', 'latestUsers'));
    }

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    // public function AdminLogin(){

    //     return view('admin.admin_login');
    // }


    public function AdminProfile(){
        
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));
    }

    public function AdminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address; 

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName(); 
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;  
        }

        $data->save();

            $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function AdminChangePassword(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password',compact('profileData'));

    }

    public function AdminUpdatePassword(Request $request){

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


/////////// Technician User All Method ////////////
    public function AllTechnician(){

    $alltechnician = User::where('role','technician')->get();
    return view('backend.technicianuser.all_technician',compact('alltechnician'));

    }

    public function AddTechnician(){

    return view('backend.technicianuser.add_technician');

    }


    public function StoreTechnician(Request $request){

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'technician',
            'status' => 'active', 
        ]);


        $notification = array(
            'message' => 'Technician Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.technician')->with($notification); 


    }


    public function EditTechnician($id){

    $alltechnician = User::findOrFail($id);
    return view('backend.technicianuser.edit_technician',compact('alltechnician'));

    }// End Method 


    public function UpdateTechnician(Request $request){

        $user_id = $request->id;

        User::findOrFail($user_id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address, 
    ]);


        $notification = array(
            'message' => 'Technician Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.technician')->with($notification);  

    }// End Method 


    public function DeleteTechnician($id){

        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Technician Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }

    public function changeStatus(Request $request)
{
    $user = User::findOrFail($request->user_id);
    $user->status = $request->status;
    $user->save();

    // Broadcast the status change for real-time updates
    broadcast(new TechnicianStatusChanged($user->id, $user->status))->toOthers();

    return response()->json([
        'success' => 'Status Changed Successfully',
        'status' => $user->status
    ]);
}
        public function DetailsTechnician($id)
        {
            $technician = User::where('role', 'technician')->findOrFail($id);
            return view('backend.technicianuser.details_technician', compact('technician'));
        }





        /////////// User All Method ////////////
    public function AllUser(){

    $alluser = User::where('role','user')->get();
    return view('backend.user.all_user',compact('alluser'));

    }

    public function AddUser(){

    return view('backend.user.add_user');

    }


    public function StoreUser(Request $request){

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 'active', 
        ]);


        $notification = array(
            'message' => 'User Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.user')->with($notification); 


    }


    public function EditUser($id){

    $alluser = User::findOrFail($id);
    return view('backend.user.edit_user',compact('alluser'));

    }// End Method 


    public function UpdateUser(Request $request){

        $user_id = $request->id;

        User::findOrFail($user_id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address, 
    ]);


        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.user')->with($notification);  

    }// End Method 


    public function DeleteUser($id){

        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }


        public function DetailsUser($id)
        {
            $user = User::where('role', 'user')->findOrFail($id);
            return view('backend.user.details_user', compact('user'));
        }

     public function ServiceReportAll(){
 
        $usermsg = ReportService::latest()->get();
        $unreadCount = ReportService::where('is_read', 0)->count();
        return view('backend.service_report.all_service_report',compact('usermsg','unreadCount'));

    }

    public function ServiceReportDetails($id){

        $msgdetails = ReportService::findOrFail($id);
        if ((int) $msgdetails->is_read === 0) {
            $msgdetails->is_read = 1;
            $msgdetails->save();
        }

        $usermsg = ReportService::all();
        $unreadCount = ReportService::where('is_read', 0)->count();
        return view('backend.service_report.service_report_details',compact('usermsg','msgdetails','unreadCount'));

    }

    public function TechnicianReportAll(){

        $usermsg = ReportTechnician::latest()->get();
        $unreadCount = ReportTechnician::where('is_read', 0)->count();
        return view('backend.technician_report.all_technician_report',compact('usermsg','unreadCount'));

    }

    public function TechnicianReportDetails($id){

    $msgdetails = ReportTechnician::findOrFail($id);
    if ((int) $msgdetails->is_read === 0) {
        $msgdetails->is_read = 1;
        $msgdetails->save();
    }

    $usermsg = ReportTechnician::all();
    $unreadCount = ReportTechnician::where('is_read', 0)->count();

        return view('backend.technician_report.technician_report_details',compact('usermsg','msgdetails','unreadCount'));

    }

    /////////// Reviews Management ////////////
    public function AdminAllReviews()
    {
        $reviews = ServiceReview::with(['service', 'user', 'booking', 'technician'])
            ->latest()
            ->get();

        return view('admin.reviews.all_reviews', compact('reviews'));
    }

    public function AdminShowReview($id)
    {
        $review = ServiceReview::with(['service', 'user', 'booking', 'technician'])
            ->findOrFail($id);

        return view('admin.reviews.show_review', compact('review'));
    }

    public function AdminDeleteReview($id)
    {
        $review = ServiceReview::findOrFail($id);
        $review->delete();

        $notification = [
            'message' => 'Review deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.all.reviews')->with($notification);
    }

}
