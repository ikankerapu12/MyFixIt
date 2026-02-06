@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
  Terms of Service | MyFixIt  
@endsection
<!--Page Title-->
<section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Terms of Service</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Terms of Service</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- Terms Content -->
<section class="legal-section">
    <div class="auto-container">
        <div class="legal-header">
            <h2>{{ $terms?->title ?? 'MyFixIt Terms of Service' }}</h2>
            <p>
                Last updated:
                {{ $terms?->last_updated ? \Carbon\Carbon::parse($terms->last_updated)->format('F j, Y') : 'February 5, 2026' }}
            </p>
            <p>{!! nl2br(e($terms?->intro ?? 'These Terms of Service explain how MyFixIt provides marketplace services for home maintenances. By accessing or using MyFixIt, you agree to these terms.')) !!}</p>
        </div>

        <div class="legal-grid">
            <div class="legal-card">
                <h3>{{ $terms?->section1_title ?? '1. Services' }}</h3>
                <p>{!! nl2br(e($terms?->section1_body ?? 'MyFixIt connects customers with independent service technicians for repair and maintenance services. We are not responsible for the services performed by technicians, but we help with booking and communication support.')) !!}</p>
            </div>
            <div class="legal-card">
                <h3>{{ $terms?->section2_title ?? '2. Eligibility & Accounts' }}</h3>
                <p>{!! nl2br(e($terms?->section2_body ?? 'You must be at least 18 years old to create an account. You agree to provide accurate information and keep your account secure. You are responsible for all activity under your account.')) !!}</p>
            </div>
            <div class="legal-card">
                <h3>{{ $terms?->section3_title ?? '3. Booking & Service Charges' }}</h3>
                <p>{!! nl2br(e($terms?->section3_body ?? 'Service prices and estimates are displayed before booking. Some services may require an in-person assessment for a final quote. MyFixIt issues invoices for record purposes, but all payments are handled directly between customers and technicians.')) !!}</p>
            </div>
            <div class="legal-card">
                <h3>{{ $terms?->section4_title ?? '4. Cancellations & Refunds' }}</h3>
                <p>{!! nl2br(e($terms?->section4_body ?? 'MyFixIt does not process cancellations or refunds directly. If you wish to cancel or modify a booking, you must contact the technician through the in-platform chat feature. Any cancellation terms or charges are determined by the technician.')) !!}</p>
            </div>
        </div>

        <div class="legal-body">
            <h3>{{ $terms?->section5_title ?? '5. User Responsibilities' }}</h3>
            @php
                $termsSection5Items = preg_split("/\r\n|\n|\r/", $terms?->section5_body ?? "Provide accurate details about the job and site conditions.\nEnsure safe access to the service location.\nUse MyFixIt in compliance with all applicable laws.");
            @endphp
            <ul class="legal-list">
                @foreach($termsSection5Items as $item)
                    @if(trim($item) !== '')
                        <li>{{ $item }}</li>
                    @endif
                @endforeach
            </ul>

            <h3>{{ $terms?->section6_title ?? '6. Prohibited Conduct' }}</h3>
            @php
                $termsSection6Items = preg_split("/\r\n|\n|\r/", $terms?->section6_body ?? "No misuse of the platform, including fraud, harassment, or impersonation.\nNo interference with MyFixIt systems, security, or networks.\nNo uploading of unlawful or harmful content.");
            @endphp
            <ul class="legal-list">
                @foreach($termsSection6Items as $item)
                    @if(trim($item) !== '')
                        <li>{{ $item }}</li>
                    @endif
                @endforeach
            </ul>

            <h3>{{ $terms?->section7_title ?? '7. Warranties & Liability' }}</h3>
            <p>{!! nl2br(e($terms?->section7_body ?? 'Services are provided by independent technicians and providers. MyFixIt disclaims warranties to the fullest extent permitted by law. MyFixIt is not liable for indirect or consequential damages related to services.')) !!}</p>

            <h3>{{ $terms?->section8_title ?? '8. Disputes' }}</h3>
            <p>{!! nl2br(e($terms?->section8_body ?? 'If a dispute arises, please contact MyFixIt support first so we can try to resolve it quickly and fairly. Additional dispute resolution options may be available depending on your location.')) !!}</p>

            <h3>{{ $terms?->section9_title ?? '9. Changes to These Terms' }}</h3>
            <p>{!! nl2br(e($terms?->section9_body ?? 'We may update these Terms from time to time. Changes become effective when posted on this page with a new \"Last updated\" date.')) !!}</p>

            <h3>{{ $terms?->section10_title ?? '10. Contact Us' }}</h3>
            @php
                $termsContactFallback = 'For questions about these Terms, contact MyFixIt support at ' . ($setting?->email ?? 'support@myfixit.com') . '.';
            @endphp
            <p>{!! nl2br(e($terms?->section10_body ?? $termsContactFallback)) !!}</p>
        </div>
    </div>
</section>
<!-- /Terms Content -->


   <!-- subscribe-section -->
        <section class="subscribe-section bg-color-3">
            <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }});"></div>
            <div class="auto-container">
                        <div class="text">
                            <h2>WELCOME TO MYFIXIT!</h2>
                    </div>
                    
                
            </div>
        </section>
        <!-- subscribe-section end -->


<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap');

    .subscribe-section .text {
        text-align: center;
        width: 100%;
    }

    @keyframes moveBackground {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: -2235px 0;
    }
    
}
.page-title {
    animation: moveBackground 45s linear infinite; /* Slower movement, infinite loop */
}

.buy-btn.pull-right a {
    font-size: 12px;  /* Smaller font size */
    color: #fff;  /* Ensure text is visible */
    text-overflow: ellipsis;  /* Add ellipsis when text overflows */
    white-space: nowrap;  /* Prevent text from wrapping */
    overflow: hidden;  /* Hide overflowing text */
    max-width: 150px;  /* Limit width to avoid overflow */
    display: inline-block;
    padding: 5px 10px;
    text-align: center;
}

.more-details.clearfix {
    display: flex;
    justify-content: space-between; /* Space out items across the container */
    align-items: center;
    padding: 0;
    margin: 0 0 20px;
    list-style: none;
    min-height: 24px;
}

.more-details.clearfix::after {
    content: none;
}

.more-details li {
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #9aa0a6;
    margin-right: 15px;  /* Adjust margin to create more space */
}

.more-details li i {
    width: 18px;
    text-align: center;
    margin-right: 6px;
    font-size: 14px;
    color: #9aa0a6;
}

.more-details li span {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    flex-shrink: 0; /* Prevent text shrinkage */
}

.legal-section {
    --legal-accent: #5a83ff;
    --legal-ink: #0b1b3a;
    --legal-muted: #5f6b7a;
    position: relative;
    overflow: hidden;
    padding: 90px 0 50px;
    background: linear-gradient(180deg, #f2f6ff 0%, #eef3ff 45%, #f8faff 100%);
    font-family: "Manrope", "Segoe UI", sans-serif;
}

.legal-section::before,
.legal-section::after {
    content: "";
    position: absolute;
    width: 360px;
    height: 360px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(90, 131, 255, 0.22), rgba(90, 131, 255, 0));
    z-index: 0;
}

.legal-section::before {
    top: -120px;
    left: -80px;
}

.legal-section::after {
    bottom: -140px;
    right: -90px;
}

.legal-section .auto-container {
    position: relative;
    z-index: 1;
}

.legal-header {
    max-width: 900px;
    margin: 0 auto 30px;
    text-align: center;
    background: #ffffff;
    padding: 26px 28px;
    border-radius: 20px;
    box-shadow: 0 12px 30px rgba(15, 36, 62, 0.12);
    border: 1px solid rgba(90, 131, 255, 0.12);
}

.legal-header h2 {
    font-family: "Fraunces", "Manrope", serif;
    font-size: clamp(28px, 3vw, 38px);
    margin-bottom: 10px;
    color: var(--legal-ink);
    letter-spacing: -0.5px;
}

.legal-header p {
    color: var(--legal-muted);
}

.legal-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 22px;
    margin-bottom: 30px;
}

.legal-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 22px 24px;
    box-shadow: 0 12px 30px rgba(15, 36, 62, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(90, 131, 255, 0.12);
}

.legal-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(15, 36, 62, 0.16);
}

.legal-card h3 {
    font-size: 18px;
    margin-bottom: 10px;
    color: var(--legal-ink);
}

.legal-card p {
    color: var(--legal-muted);
}

.legal-body {
    max-width: 960px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 20px;
    padding: 26px 28px;
    box-shadow: 0 12px 30px rgba(15, 36, 62, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(90, 131, 255, 0.12);
}

.legal-body:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 40px rgba(15, 36, 62, 0.16);
}

.legal-body h3 {
    font-size: 18px;
    margin: 20px 0 10px;
    color: var(--legal-ink);
}

.legal-list {
    margin: 0 0 12px 0;
    padding: 0;
    list-style: none;
    color: var(--legal-muted);
}

.legal-list li {
    position: relative;
    padding-left: 22px;
    margin-bottom: 10px;
}

.legal-list li::before {
    content: "";
    position: absolute;
    left: 0;
    top: 8px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--legal-accent);
    box-shadow: 0 0 0 4px rgba(90, 131, 255, 0.18);
}

@media (max-width: 575px) {
    .legal-header,
    .legal-body {
        border-radius: 16px;
        padding: 22px 22px;
    }
}



</style>


@endsection
