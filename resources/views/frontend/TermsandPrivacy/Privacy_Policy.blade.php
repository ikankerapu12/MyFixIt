@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
  Privacy Policy | MyFixIt  
@endsection
<!--Page Title-->
<section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Privacy Policy</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Privacy Policy</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- Privacy Content -->
<section class="legal-section">
    <div class="auto-container">
        <div class="legal-header">
            <h2>{{ $privacy?->title ?? 'MyFixIt Privacy Policy' }}</h2>
            <p>
                Last updated:
                {{ $privacy?->last_updated ? \Carbon\Carbon::parse($privacy->last_updated)->format('F j, Y') : 'February 5, 2026' }}
            </p>
            <p>{!! nl2br(e($privacy?->intro ?? 'This Privacy Policy explains how MyFixIt collects, uses, and shares information when you use our website, app, and services.')) !!}</p>
        </div>

        <div class="legal-grid">
            <div class="legal-card">
                <h3>{{ $privacy?->section1_title ?? '1. Information We Collect' }}</h3>
                @php
                    $privacySection1Items = preg_split("/\r\n|\n|\r/", $privacy?->section1_body ?? "Contact details such as name, email, phone number, and address.\nService details, photos, and notes you submit for repair requests.\nPayment and transaction data processed by our payment partners.\nDevice and usage data like IP address, browser type, and pages viewed.");
                @endphp
                <ul class="legal-list">
                    @foreach($privacySection1Items as $item)
                        @if(trim($item) !== '')
                            <li>{{ $item }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="legal-card">
                <h3>{{ $privacy?->section2_title ?? '2. How We Use Information' }}</h3>
                @php
                    $privacySection2Items = preg_split("/\r\n|\n|\r/", $privacy?->section2_body ?? "Provide, booking, and manage services.\nProcess payments and send confirmations.\nImprove platform performance and customer support.\nSend service updates and essential notices.");
                @endphp
                <ul class="legal-list">
                    @foreach($privacySection2Items as $item)
                        @if(trim($item) !== '')
                            <li>{{ $item }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="legal-card">
                <h3>{{ $privacy?->section3_title ?? '3. Sharing Information' }}</h3>
                @php
                    $privacySection3Items = preg_split("/\r\n|\n|\r/", $privacy?->section3_body ?? "With service providers to complete your requests.\nWith vendors that help us operate the platform.\nWhen required by law or to protect user safety.");
                @endphp
                <ul class="legal-list">
                    @foreach($privacySection3Items as $item)
                        @if(trim($item) !== '')
                            <li>{{ $item }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="legal-card">
                <h3>{{ $privacy?->section4_title ?? '4. Cookies & Analytics' }}</h3>
                <p>{!! nl2br(e($privacy?->section4_body ?? 'We use cookies and similar technologies to keep you signed in, remember preferences, and measure site performance. You can control cookies through your browser settings.')) !!}</p>
            </div>
        </div>

        <div class="legal-body">
            <h3>{{ $privacy?->section5_title ?? '5. Data Retention' }}</h3>
            <p>{!! nl2br(e($privacy?->section5_body ?? 'We retain information as long as needed to provide services and meet legal requirements. When data is no longer needed, we delete or anonymize it.')) !!}</p>

            <h3>{{ $privacy?->section6_title ?? '6. Security' }}</h3>
            <p>{!! nl2br(e($privacy?->section6_body ?? 'We use reasonable safeguards to protect information, but no system is completely secure. Please protect your account credentials.')) !!}</p>

            <h3>{{ $privacy?->section7_title ?? '7. Your Choices' }}</h3>
            @php
                $privacySection7Items = preg_split("/\r\n|\n|\r/", $privacy?->section7_body ?? "Update account details from your profile settings.\nOpt out of marketing emails using the unsubscribe link.\nRequest access, correction, or deletion of your data where applicable.");
            @endphp
            <ul class="legal-list">
                @foreach($privacySection7Items as $item)
                    @if(trim($item) !== '')
                        <li>{{ $item }}</li>
                    @endif
                @endforeach
            </ul>

            <h3>{{ $privacy?->section8_title ?? '8. Children\'s Privacy' }}</h3>
            <p>{!! nl2br(e($privacy?->section8_body ?? 'MyFixIt is not intended for children under 13. We do not knowingly collect data from children under 13.')) !!}</p>

            <h3>{{ $privacy?->section9_title ?? '9. Changes to This Policy' }}</h3>
            <p>{!! nl2br(e($privacy?->section9_body ?? 'We may update this Privacy Policy from time to time. Changes become effective when posted on this page with a new \"Last updated\" date.')) !!}</p>

            <h3>{{ $privacy?->section10_title ?? '10. Contact Us' }}</h3>
            @php
                $privacyContactFallback = 'For questions about this Privacy Policy, contact MyFixIt support at ' . ($setting?->email ?? 'support@myfixit.com') . '.';
            @endphp
            <p>{!! nl2br(e($privacy?->section10_body ?? $privacyContactFallback)) !!}</p>
        </div>
    </div>
</section>
<!-- /Privacy Content -->


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
