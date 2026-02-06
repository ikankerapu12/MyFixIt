<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class TechnicianController extends Controller
{
    public function TechnicianDashboard(){

        $technicianId = Auth::id();
        $bookingRequestCount = \App\Models\Booking::where('technician_id', $technicianId)->count();
        $serviceCount = \App\Models\Service::where('technician_id', $technicianId)->count();

        // Monthly Bookings for Chart (Technician specific)
        $monthlyBookings = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyBookings[] = \App\Models\Booking::where('technician_id', $technicianId)
                                    ->whereMonth('created_at', $month)
                                    ->whereYear('created_at', date('Y'))
                                    ->count();
        }

        // Recent Booking Requests
        $recentBookings = \App\Models\Booking::where('technician_id', $technicianId)
                            ->with(['user', 'service'])
                            ->latest()
                            ->take(6)
                            ->get();

        // My Services
        $myServices = \App\Models\Service::where('technician_id', $technicianId)->latest()->take(6)->get();

        return view('technician.index', compact('bookingRequestCount', 'serviceCount', 'monthlyBookings', 'recentBookings', 'myServices'));
    }

    public function TechnicianLogin(){

        return view('technician.technician_login');

    }

    public function TechnicianRegister(Request $request){

        $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'phone' => ['required', 'string'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'document' => 'required|mimes:pdf|max:2048',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'role' => 'technician',
        'status' => 'inactive',
    ]);

    if ($request->hasFile('document')) {
        $file = $request->file('document');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('upload/technician_pdfs'), $filename);

        // Store the file path in the user table
        $user->document = 'upload/technician_pdfs/' . $filename;
        $user->save();
    }

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('technician.dashboard', absolute: false));

    }

    public function TechnicianLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Technician Logout Successfully',
            'alert-type' => 'success'
        ); 

        return redirect('/technician/login')->with($notification);
    }

    public function TechnicianProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('technician.technician_profile_view',compact('profileData'));

    }

    public function TechnicianProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address; 
        $data->description = $request->description; 

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/technician_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName(); 
            $file->move(public_path('upload/technician_images'),$filename);
            $data['photo'] = $filename;  
        }

        if ($request->hasFile('document')) {
            // Delete the old document if exists
            if ($data->document && file_exists(public_path($data->document))) {
                @unlink(public_path($data->document));
            }

            $file = $request->file('document');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/technician_pdfs'), $filename);
            $data->document = 'upload/technician_pdfs/' . $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Technician Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function TechnicianChangePassword(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('technician.technician_change_password',compact('profileData'));

    }

    public function TechnicianUpdatePassword(Request $request){

        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'

        ]);


        if (!Hash::check($request->old_password, auth::user()->password)) {
            
            $notification = array(
            'message' => 'Old Password Does not Match!',
            'alert-type' => 'error'
        );

        return back()->with($notification);
        }


        User::whereId(Auth::id())->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification); 

    }


}
