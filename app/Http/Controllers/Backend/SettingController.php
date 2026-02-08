<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmtpSetting;
use App\Models\SiteSetting;
use App\Models\TermsSetting;
use App\Models\PrivacySetting;
use App\Models\AboutSetting;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class SettingController extends Controller
{
    // public function SmtpSetting(){

    //     $setting = SmtpSetting::find(1);
    //     return view('backend.setting.smpt_update',compact('setting'));

    // }


    // public function UpdateSmtpSetting(Request $request){

    //     $stmp_id = $request->id;

    //     SmtpSetting::findOrFail($stmp_id)->update([

    //             'mailer' => $request->mailer,
    //             'host' => $request->host,
    //             'port' => $request->port,
    //             'username' => $request->username,
    //             'password' => $request->password,
    //             'from_address' => $request->from_address, 
    //     ]);


    //        $notification = array(
    //         'message' => 'Smtp Setting Updated Successfully',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->back()->with($notification);


    // }

    public function SiteSetting(){

         $sitesetting = SiteSetting::find(1);
        return view('backend.setting.site_update',compact('sitesetting'));

    }

        public function UpdateSiteSetting(Request $request) {

            $site_id = $request->id;

            $request->validate([
                'support_phone'    => 'required|string|max:255',
                'company_address'  => 'required|string|max:255',
                'email'            => 'required|email',
                'about'            => 'required|string',
                'copyright'        => 'required|string',
            ]);

                SiteSetting::findOrFail($site_id)->update([
                    'support_phone'   => $request->support_phone,
                    'company_address' => $request->company_address,
                    'email'           => $request->email,
                    'about'           => $request->about,
                    'copyright'       => $request->copyright,
                ]);

                $notification = [
                    'message' => 'SiteSetting Updated Successfully',
                    'alert-type' => 'success'
                ];

            return redirect()->back()->with($notification);  
    }

    public function TermsSetting(){

        $terms = TermsSetting::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'MyFixIt Terms of Service',
                'last_updated' => now()->toDateString(),
                'intro' => 'These Terms of Service explain how MyFixIt provides marketplace services for home maintenances. By accessing or using MyFixIt, you agree to these terms.',
                'section1_title' => '1. Services',
                'section1_body' => 'MyFixIt connects customers with independent service technicians for repair and maintenance services. We are not responsible for the services performed by technicians, but we help with booking and communication support.',
                'section2_title' => '2. Eligibility & Accounts',
                'section2_body' => 'You must be at least 18 years old to create an account. You agree to provide accurate information and keep your account secure. You are responsible for all activity under your account.',
                'section3_title' => '3. Booking & Service Charges',
                'section3_body' => 'Service prices and estimates are displayed before booking. Some services may require an in-person assessment for a final quote. MyFixIt issues invoices for record purposes, but all payments are handled directly between customers and technicians.',
                'section4_title' => '4. Cancellations & Refunds',
                'section4_body' => 'MyFixIt does not process cancellations or refunds directly. If you wish to cancel or modify a booking, you must contact the technician through the in-platform chat feature. Any cancellation terms or charges are determined by the technician.',
                'section5_title' => '5. User Responsibilities',
                'section5_body' => "Provide accurate details about the job and site conditions.\nEnsure safe access to the service location.\nUse MyFixIt in compliance with all applicable laws.",
                'section6_title' => '6. Prohibited Conduct',
                'section6_body' => "No misuse of the platform, including fraud, harassment, or impersonation.\nNo interference with MyFixIt systems, security, or networks.\nNo uploading of unlawful or harmful content.",
                'section7_title' => '7. Warranties & Liability',
                'section7_body' => 'Services are provided by independent technicians and providers. MyFixIt disclaims warranties to the fullest extent permitted by law. MyFixIt is not liable for indirect or consequential damages related to services.',
                'section8_title' => '8. Disputes',
                'section8_body' => 'If a dispute arises, please contact MyFixIt support first so we can try to resolve it quickly and fairly. Additional dispute resolution options may be available depending on your location.',
                'section9_title' => '9. Changes to These Terms',
                'section9_body' => 'We may update these Terms from time to time. Changes become effective when posted on this page with a new "Last updated" date.',
                'section10_title' => '10. Contact Us',
                'section10_body' => 'For questions about these Terms, contact MyFixIt support at support@myfixit.com.',
            ]
        );
        return view('backend.setting.terms_update',compact('terms'));

    }

    public function UpdateTermsSetting(Request $request){

        $fields = [
            'title',
            'last_updated',
            'intro',
            'section1_title', 'section1_body',
            'section2_title', 'section2_body',
            'section3_title', 'section3_body',
            'section4_title', 'section4_body',
            'section5_title', 'section5_body',
            'section6_title', 'section6_body',
            'section7_title', 'section7_body',
            'section8_title', 'section8_body',
            'section9_title', 'section9_body',
            'section10_title', 'section10_body',
        ];

        $request->validate([
            'title' => 'nullable|string|max:255',
            'last_updated' => 'nullable|date',
            'intro' => 'nullable|string',
            'section1_title' => 'nullable|string|max:255',
            'section1_body' => 'nullable|string',
            'section2_title' => 'nullable|string|max:255',
            'section2_body' => 'nullable|string',
            'section3_title' => 'nullable|string|max:255',
            'section3_body' => 'nullable|string',
            'section4_title' => 'nullable|string|max:255',
            'section4_body' => 'nullable|string',
            'section5_title' => 'nullable|string|max:255',
            'section5_body' => 'nullable|string',
            'section6_title' => 'nullable|string|max:255',
            'section6_body' => 'nullable|string',
            'section7_title' => 'nullable|string|max:255',
            'section7_body' => 'nullable|string',
            'section8_title' => 'nullable|string|max:255',
            'section8_body' => 'nullable|string',
            'section9_title' => 'nullable|string|max:255',
            'section9_body' => 'nullable|string',
            'section10_title' => 'nullable|string|max:255',
            'section10_body' => 'nullable|string',
        ]);

        $terms = TermsSetting::firstOrCreate(['id' => $request->id ?? 1]);
        $terms->update($request->only($fields));

        $notification = [
            'message' => 'Terms Setting Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function PrivacySetting(){

        $privacy = PrivacySetting::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'MyFixIt Privacy Policy',
                'last_updated' => now()->toDateString(),
                'intro' => 'This Privacy Policy explains how MyFixIt collects, uses, and shares information when you use our website, app, and services.',
                'section1_title' => '1. Information We Collect',
                'section1_body' => "Contact details such as name, email, phone number, and address.\nService details, photos, and notes you submit for repair requests.\nPayment and transaction data processed by our payment partners.\nDevice and usage data like IP address, browser type, and pages viewed.",
                'section2_title' => '2. How We Use Information',
                'section2_body' => "Provide, schedule, and manage services.\nProcess payments and send confirmations.\nImprove platform performance and customer support.\nSend service updates and essential notices.",
                'section3_title' => '3. Sharing Information',
                'section3_body' => "With service providers to complete your requests.\nWith vendors that help us operate the platform.\nWhen required by law or to protect user safety.",
                'section4_title' => '4. Cookies & Analytics',
                'section4_body' => 'We use cookies and similar technologies to keep you signed in, remember preferences, and measure site performance. You can control cookies through your browser settings.',
                'section5_title' => '5. Data Retention',
                'section5_body' => 'We retain information as long as needed to provide services and meet legal requirements. When data is no longer needed, we delete or anonymize it.',
                'section6_title' => '6. Security',
                'section6_body' => 'We use reasonable safeguards to protect information, but no system is completely secure. Please protect your account credentials.',
                'section7_title' => '7. Your Choices',
                'section7_body' => "Update account details from your profile settings.\nOpt out of marketing emails using the unsubscribe link.\nRequest access, correction, or deletion of your data where applicable.",
                'section8_title' => '8. Children\'s Privacy',
                'section8_body' => 'MyFixIt is not intended for children under 13. We do not knowingly collect data from children under 13.',
                'section9_title' => '9. Changes to This Policy',
                'section9_body' => 'We may update this Privacy Policy from time to time. Changes become effective when posted on this page with a new "Last updated" date.',
                'section10_title' => '10. Contact Us',
                'section10_body' => 'For questions about this Privacy Policy, contact MyFixIt support at support@myfixit.com.',
            ]
        );
        return view('backend.setting.privacy_update',compact('privacy'));

    }

    public function UpdatePrivacySetting(Request $request){

        $fields = [
            'title',
            'last_updated',
            'intro',
            'section1_title', 'section1_body',
            'section2_title', 'section2_body',
            'section3_title', 'section3_body',
            'section4_title', 'section4_body',
            'section5_title', 'section5_body',
            'section6_title', 'section6_body',
            'section7_title', 'section7_body',
            'section8_title', 'section8_body',
            'section9_title', 'section9_body',
            'section10_title', 'section10_body',
        ];

        $request->validate([
            'title' => 'nullable|string|max:255',
            'last_updated' => 'nullable|date',
            'intro' => 'nullable|string',
            'section1_title' => 'nullable|string|max:255',
            'section1_body' => 'nullable|string',
            'section2_title' => 'nullable|string|max:255',
            'section2_body' => 'nullable|string',
            'section3_title' => 'nullable|string|max:255',
            'section3_body' => 'nullable|string',
            'section4_title' => 'nullable|string|max:255',
            'section4_body' => 'nullable|string',
            'section5_title' => 'nullable|string|max:255',
            'section5_body' => 'nullable|string',
            'section6_title' => 'nullable|string|max:255',
            'section6_body' => 'nullable|string',
            'section7_title' => 'nullable|string|max:255',
            'section7_body' => 'nullable|string',
            'section8_title' => 'nullable|string|max:255',
            'section8_body' => 'nullable|string',
            'section9_title' => 'nullable|string|max:255',
            'section9_body' => 'nullable|string',
            'section10_title' => 'nullable|string|max:255',
            'section10_body' => 'nullable|string',
        ]);

        $privacy = PrivacySetting::firstOrCreate(['id' => $request->id ?? 1]);
        $privacy->update($request->only($fields));

        $notification = [
            'message' => 'Privacy Setting Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function AboutSetting(){

        $about = AboutSetting::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'About MyFixIt',
                'subtitle' => 'Reliable repairs. Real people. Right in your neighborhood.',
                'intro' => 'MyFixIt is a marketplace that connects customers with trusted local technicians for fast, dependable repairs. We make it simple to book, communicate, and get the job done with confidence.',
                'section1_title' => 'What We Do',
                'section1_body' => 'We connect customers to skilled technicians for home and device repairs. From everyday fixes to urgent issues, MyFixIt helps you find the right help quickly.',
                'section2_title' => 'Why It Works',
                'section2_body' => 'Transparent listings, verified profiles, and clear communication tools help you choose the right technician and track your service from start to finish.',
                'section3_title' => 'Built For Speed',
                'section3_body' => 'Our platform is designed for fast booking, quick responses, and a smooth experience on both mobile and desktop.',
                'section4_title' => 'Our Values',
                'section4_body' => "Trust and transparency\nQuality workmanship\nRespect for your time and space",
                'section5_title' => 'Our Promise',
                'section5_body' => 'We support every booking with responsive customer care and a focus on fairness for both customers and technicians.',
                'section6_title' => 'Community First',
                'section6_body' => 'We believe in empowering local technicians and building stronger neighborhoods through reliable service.',
            ]
        );

        return view('backend.setting.about_update',compact('about'));

    }

    public function UpdateAboutSetting(Request $request){

        $fields = [
            'title',
            'subtitle',
            'intro',
            'section1_title', 'section1_body',
            'section2_title', 'section2_body',
            'section3_title', 'section3_body',
            'section4_title', 'section4_body',
            'section5_title', 'section5_body',
            'section6_title', 'section6_body',
        ];

        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'intro' => 'nullable|string',
            'section1_title' => 'nullable|string|max:255',
            'section1_body' => 'nullable|string',
            'section2_title' => 'nullable|string|max:255',
            'section2_body' => 'nullable|string',
            'section3_title' => 'nullable|string|max:255',
            'section3_body' => 'nullable|string',
            'section4_title' => 'nullable|string|max:255',
            'section4_body' => 'nullable|string',
            'section5_title' => 'nullable|string|max:255',
            'section5_body' => 'nullable|string',
            'section6_title' => 'nullable|string|max:255',
            'section6_body' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $about = AboutSetting::firstOrCreate(['id' => $request->id ?? 1]);

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $oldLogo = $request->old_logo;
            if ($oldLogo && file_exists(public_path($oldLogo))) {
                @unlink(public_path($oldLogo));
            }
            if (!file_exists(public_path('upload/about'))) {
                @mkdir(public_path('upload/about'), 0775, true);
            }
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/about'), $filename);
            $about->logo = 'upload/about/'.$filename;
        }

        $about->update($request->only($fields));

        $notification = [
            'message' => 'About Setting Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


}


