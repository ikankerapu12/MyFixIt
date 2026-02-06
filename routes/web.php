<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\ServiceTypeController;
use App\Http\Controllers\Backend\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectByRole;
use App\Http\Controllers\Technician\TechnicianServiceController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Backend\SeksyenController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Frontend\ReviewController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [UserController::class, 'Index']);
Route::get('/', function () {

    if (Auth::check()) {
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'technician' => redirect()->route('technician.dashboard'),
            'user' => app(App\Http\Controllers\UserController::class)->Index(),
            default => redirect()->route('login'),
        };
    }

    // Guest (not logged in) → index page
    return app(App\Http\Controllers\UserController::class)->Index();

});

Route::get('/dashboard', [UserController::class, 'UserDashboard'])
->middleware(['auth', 'verified', 'role:user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile'); 
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store'); 
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password'); 
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
    Route::get('/user/booking/request', [UserController::class, 'UserBookingRequest'])->name('user.booking.request'); 
    Route::get('/user/chat', [UserController::class, 'UserChat'])->name('user.chat'); 
    Route::get('/user/booking/invoice/{id}', [UserController::class, 'UserBookingInvoice'])->name('user.booking.invoice');
    Route::get('/user/delete/booking/{id}', [UserController::class, 'UserDeleteBooking'])->name('user.delete.booking');
    
    // User Review Routes
    Route::get('/user/write-review/{booking_id}', [ReviewController::class, 'writeReview'])->name('user.write.review');
    Route::post('/user/store-review', [ReviewController::class, 'storeReview'])->name('user.store.review');
});

require __DIR__.'/auth.php';


// Admin
Route::middleware(['auth','role:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store'); 
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password'); 
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password'); 
});


// Technician
Route::middleware(['auth','role:technician'])->group(function() {
Route::get('/technician/dashboard', [TechnicianController::class, 'TechnicianDashboard'])->name('technician.dashboard');
Route::get('/technician/logout', [TechnicianController::class, 'TechnicianLogout'])->name('technician.logout');
Route::get('/technician/profile', [TechnicianController::class, 'TechnicianProfile'])->name('technician.profile');
Route::post('/technician/profile/store', [TechnicianController::class, 'TechnicianProfileStore'])->name('technician.profile.store');
Route::get('/technician/change/password', [TechnicianController::class, 'TechnicianChangePassword'])->name('technician.change.password');
Route::post('/technician/update/password', [TechnicianController::class, 'TechnicianUpdatePassword'])->name('technician.update.password');

// Service status change for technician
Route::get('/technician/change/service/status', [App\Http\Controllers\Backend\ServiceController::class, 'changeServiceStatus'])->name('technician.change.service.status');
});


Route::post('/technician/register', [TechnicianController::class, 'TechnicianRegister'])->name('technician.register'); 

// Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectByRole::class);


// admin group middleware
Route::middleware(['auth','role:admin'])->group(function(){ 


 // Service Type All Route 
Route::controller(ServiceTypeController::class)->group(function(){

    Route::get('/all/type', 'AllType')->name('all.type');  
    Route::get('/add/type', 'AddType')->name('add.type');  
    Route::post('/store/type', 'StoreType')->name('store.type');  
    Route::get('/edit/type/{id}', 'EditType')->name('edit.type');
    Route::post('/update/type', 'UpdateType')->name('update.type');
    Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type');
});

// Service All Route 
Route::controller(ServiceController::class)->group(function(){

    Route::get('/all/service', 'AllService')->name('all.service'); 
    Route::get('/add/service', 'AddService')->name('add.service');
    Route::post('/store/service', 'StoreService')->name('store.service');
    Route::get('/edit/service/{id}', 'EditService')->name('edit.service');
    Route::post('/update/service', 'UpdateService')->name('update.service');
    Route::post('/update/service/thumbnail', 'UpdateServiceThumbnail')->name('update.service.thumbnail');
    Route::post('/update/service/multiimage', 'UpdateServiceMultiimage')->name('update.service.multiimage');
    Route::get('/service/multiimg/delete/{id}', 'ServiceMultiImageDelete')->name('service.multiimg.delete');
    Route::post('/store/new/multiimage', 'StoreNewMultiimage')->name('store.new.multiimage');
    Route::get('/delete/service/{id}', 'DeleteService')->name('delete.service');
    Route::get('/details/service/{id}', 'DetailsService')->name('details.service');

    Route::post('/inactive/service', 'InactiveService')->name('inactive.service');
    Route::post('/active/service', 'ActiveService')->name('active.service');
    Route::get('/change/service/status', 'changeServiceStatus')->name('change.service.status');
});


// technician All Route from admin 
Route::controller(AdminController::class)->group(function(){

    Route::get('/all/technician', 'AllTechnician')->name('all.technician'); 
    Route::get('/add/technician', 'AddTechnician')->name('add.technician');
    Route::post('/store/technician', 'StoreTechnician')->name('store.technician'); 
    Route::get('/edit/technician/{id}', 'EditTechnician')->name('edit.technician');
    Route::post('/update/technician', 'UpdateTechnician')->name('update.technician');
    Route::get('/delete/technician/{id}', 'DeleteTechnician')->name('delete.technician'); 
    Route::get('/details/technician/{id}', 'DetailsTechnician')->name('details.technician');
    Route::get('/changeStatus', 'changeStatus');
});



// user All Route from admin 
Route::controller(AdminController::class)->group(function(){

    Route::get('/all/user', 'AllUser')->name('all.user'); 
    Route::get('/add/user', 'AddUser')->name('add.user');
    Route::post('/store/user', 'StoreUser')->name('store.user'); 
    Route::get('/edit/user/{id}', 'EditUser')->name('edit.user');
    Route::post('/update/user', 'UpdateUser')->name('update.user');
    Route::get('/delete/user/{id}', 'DeleteUser')->name('delete.user'); 
    Route::get('/details/user/{id}', 'DetailsUser')->name('details.user');
});

// admin reviews routes
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/all/reviews', 'AdminAllReviews')->name('admin.all.reviews');
    Route::get('/admin/show/review/{id}', 'AdminShowReview')->name('admin.show.review');
    Route::get('/admin/delete/review/{id}', 'AdminDeleteReview')->name('admin.delete.review');
});



 // Seksyen  All Route 
Route::controller(SeksyenController::class)->group(function(){

     Route::get('/all/seksyen', 'AllSeksyen')->name('all.seksyen'); 
     Route::get('/add/seksyen', 'AddSeksyen')->name('add.seksyen');
     Route::post('/store/seksyen', 'StoreSeksyen')->name('store.seksyen'); 
     Route::get('/edit/seksyen/{id}', 'EditSeksyen')->name('edit.seksyen');
     Route::post('/update/seksyen', 'UpdateSeksyen')->name('update.seksyen');
     Route::get('/delete/seksyen/{id}', 'DeleteSeksyen')->name('delete.seksyen');  

});

 // SMTP Setting  All Route 
Route::controller(SettingController::class)->group(function(){

     Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting'); 
         Route::post('/update/smpt/setting', 'UpdateSmtpSetting')->name('update.smpt.setting'); 

});

 // Site Setting  All Route 
Route::controller(SettingController::class)->group(function(){

    Route::get('/site/setting', 'SiteSetting')->name('site.setting');
    Route::post('/update/site/setting', 'UpdateSiteSetting')->name('update.site.setting');  
});

 // Terms Setting All Route
Route::controller(SettingController::class)->group(function(){

    Route::get('/terms/setting', 'TermsSetting')->name('terms.setting');
    Route::post('/update/terms/setting', 'UpdateTermsSetting')->name('update.terms.setting');
});

 // Privacy Setting All Route
Route::controller(SettingController::class)->group(function(){

    Route::get('/privacy/setting', 'PrivacySetting')->name('privacy.setting');
    Route::post('/update/privacy/setting', 'UpdatePrivacySetting')->name('update.privacy.setting');
});

 // About Setting All Route
Route::controller(SettingController::class)->group(function(){

    Route::get('/about/setting', 'AboutSetting')->name('about.setting');
    Route::post('/update/about/setting', 'UpdateAboutSetting')->name('update.about.setting');
});



Route::get('/admin/service/report/', [AdminController::class, 'ServiceReportAll'])->name('admin.service.report');
Route::get('/admin/service/report/details/{id}', [AdminController::class, 'ServiceReportDetails'])->name('service.report.details');


Route::get('/admin/technician/report/', [AdminController::class, 'TechnicianReportAll'])->name('admin.technician.report');
Route::get('/admin/technician/report/details/{id}', [AdminController::class, 'TechnicianReportDetails'])->name('technician.report.details');


}); // end admin group middleware


/// technician Group Middleware 
Route::middleware(['auth','role:technician'])->group(function(){

      // technician All service  
Route::controller(TechnicianServiceController::class)->group(function(){

     Route::get('/technician/all/service', 'TechnicianAllService')->name('technician.all.service'); 
     Route::get('/technician/add/service', 'TechnicianAddService')->name('technician.add.service'); 
     Route::post('/technician/store/service', 'TechnicianStoreService')->name('technician.store.service'); 
     Route::get('/technician/edit/service/{id}', 'TechnicianEditService')->name('technician.edit.service');
     Route::post('/technician/update/service', 'TechnicianUpdateService')->name('technician.update.service');
     Route::post('/technician/update/service/thumbnail', 'TechnicianUpdateServiceThumbnail')->name('technician.update.service.thumbnail');
     Route::post('/technician/update/service/multiimage', 'TechnicianUpdateServiceMultiimage')->name('technician.update.service.multiimage');
     Route::get('/technician/service/multiimg/delete/{id}', 'TechnicianServiceMultiImageDelete')->name('technician.service.multiimg.delete');
     Route::post('/technician/store/new/multiimage', 'TechnicianStoreNewMultiimage')->name('technician.store.new.multiimage');
     Route::get('/technician/delete/service/{id}', 'TechnicianDeleteService')->name('technician.delete.service');
     Route::get('/technician/details/service/{id}', 'TechnicianDetailsService')->name('technician.details.service');
     
     
     
     //booking request route 
    Route::get('/technician/booking/request/', 'TechnicianBookingRequest')->name('technician.booking.request'); 

    Route::get('/technician/details/booking/{id}', 'TechnicianDetailsBooking')->name('technician.details.booking'); 
    Route::post('/technician/update/booking/', 'TechnicianUpdateBooking')->name('technician.update.booking');
    // Booking routes
Route::post('/technician/reject/booking', 'TechnicianRejectBooking')->name('technician.reject.booking');
Route::post('/technician/cancel/booking', 'TechnicianCancelBooking')->name('technician.cancel.booking');
Route::get('/technician/delete/booking/{id}', 'TechnicianDeleteBooking')->name('technician.delete.booking');
 
});


Route::get('/technician/chat-message', [ChatController::class, 'TechnicianChatMessage'])->name('technician.chat.message');

// Technician Reviews Routes
Route::get('/technician/all/reviews', [TechnicianServiceController::class, 'AllReviews'])->name('technician.all.reviews');
Route::get('/technician/show/review/{id}', [TechnicianServiceController::class, 'ShowReview'])->name('technician.show.review');
Route::post('/technician/reply/review', [TechnicianServiceController::class, 'ReplyReview'])->name('technician.reply.review');

}); // end technician group middleware


// Frontend Service Details All Route 

 Route::get('/service/details/{id}/{slug}', [IndexController::class, 'ServiceDetails']); 

// Wishlist Add Route 
  Route::post('/add-to-wishList/{service_id}', [WishlistController::class, 'AddToWishList']);  

    // Compare Add Route 
  Route::post('/add-to-compare/{service_id}', [CompareController::class, 'AddToCompare']);   

  // Technician Details Page in Frontend 
  Route::get('/technician/details/{id}', [IndexController::class, 'TechnicianDetails'])->name('technician.details');

  // User WishlistAll Route 
Route::controller(WishlistController::class)->group(function(){

    Route::get('/user/wishlist', 'UserWishlist')->name('user.wishlist'); 
    Route::get('/get-wishlist-service', 'GetWishlistService'); 
    Route::get('/wishlist-remove/{id}', 'WishlistRemove'); 

});

 // User Compare All Route 
Route::controller(CompareController::class)->group(function(){

     Route::get('/user/compare', 'UserCompare')->name('user.compare');
    Route::get('/get-compare-service', 'GetCompareService');
     Route::get('/compare-remove/{id}', 'CompareRemove');
});


// Get All Service Type Data 
Route::get('/service/type/{id}', [IndexController::class, 'ServiceType'])->name('service.type');
Route::get('/all/service/type', [IndexController::class, 'AllServiceType'])->name('all.service.type');

 // Get Seksyen Details Data 
 Route::get('/seksyen/details/{id}', [IndexController::class, 'SeksyenDetails'])->name('seksyen.details');

// Home Page Service Seach Option
// Route::post('/service/search', [IndexController::class, 'ServiceSearch'])->name('service.search');
Route::match(['get', 'post'], '/service/search', [IndexController::class, 'ServiceSearch'])->name('service.search');

// Get All Featured Services Data 
Route::get('/featured-services', [IndexController::class, 'AllFeaturedServices'])->name('all.featured.services');



Route::get('/all/seksyen/view', [IndexController::class, 'AllSeksyenView'])->name('all.seksyen.view');


        // All Property Seach Option
   Route::post('/all/service/search', [IndexController::class, 'AllServiceSearch'])->name('all.service.search');



     // Booking Message Request Route 
   Route::post('/store/booking', [IndexController::class, 'StoreBooking'])->name('store.booking');


        // Chat Post Request Route 
   Route::post('/send-message', [ChatController::class, 'SendMsg'])->name('send.msg');

   Route::get('/user-all', [ChatController::class, 'GetAllUsers']);

Route::get('/user-message/{id}', [ChatController::class, 'UserMsgById']);



Route::post('/service/report', [IndexController::class, 'ServiceReport'])->name('service.report');


Route::post('/technician/report', [IndexController::class, 'TechnicianReport'])->name('technician.report');



Route::get('/terms-service', [IndexController::class, 'TermsService'])->name('terms.service');
Route::get('/privacy-policy', [IndexController::class, 'PrivacyPolicy'])->name('privacy.policy');
Route::get('/about-us', [IndexController::class, 'AboutUs'])->name('about.us');

