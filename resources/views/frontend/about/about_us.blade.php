@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
  About Us | MyFixIt  
@endsection
<!--Page Title-->
<section class="page-title centred" style="background-color: #5a83ff; background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }}); background-repeat: repeat-x; background-size: cover;">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>About Us</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- About Content -->
<section class="about-section">
    <div class="auto-container">
        @php
            $aboutLogo = $about?->logo
                ? asset($about->logo)
                : asset('frontend/assets/images/myfixit_logo1.png');
            $aboutValues = preg_split("/\r\n|\n|\r/", $about?->section4_body ?? "Trust and transparency\nQuality workmanship\nRespect for your time and space");
        @endphp

        <div class="about-hero">
            <div class="about-hero-text">
                <h2>{{ $about?->title ?? 'About MyFixIt' }}</h2>
                <p class="about-subtitle">{{ $about?->subtitle ?? 'Reliable repairs. Real people. Right in your neighborhood.' }}</p>
                <p class="about-intro">{!! nl2br(e($about?->intro ?? 'MyFixIt is a marketplace that connects customers with trusted local technicians for fast, dependable repairs. We make it simple to book, communicate, and get the job done with confidence.')) !!}</p>
            </div>
            <div class="about-hero-logo">
                <div class="logo-badge">
                    <img src="{{ $aboutLogo }}" alt="MyFixIt Logo">
                </div>
            </div>
        </div>

        <div class="about-cards">
            <div class="about-card">
                <h3>{{ $about?->section1_title ?? 'What We Do' }}</h3>
                <p>{!! nl2br(e($about?->section1_body ?? 'We connect customers to skilled technicians for home and device repairs. From everyday fixes to urgent issues, MyFixIt helps you find the right help quickly.')) !!}</p>
            </div>
            <div class="about-card">
                <h3>{{ $about?->section2_title ?? 'Why It Works' }}</h3>
                <p>{!! nl2br(e($about?->section2_body ?? 'Transparent listings, verified profiles, and clear communication tools help you choose the right technician and track your service from start to finish.')) !!}</p>
            </div>
            <div class="about-card">
                <h3>{{ $about?->section3_title ?? 'Built For Speed' }}</h3>
                <p>{!! nl2br(e($about?->section3_body ?? 'Our platform is designed for fast booking, quick responses, and a smooth experience on both mobile and desktop.')) !!}</p>
            </div>
        </div>

        <div class="about-values">
            <h3>{{ $about?->section4_title ?? 'Our Values' }}</h3>
            <ul class="about-list">
                @foreach($aboutValues as $item)
                    @if(trim($item) !== '')
                        <li>{{ $item }}</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="about-split">
            <div class="about-panel">
                <h3>{{ $about?->section5_title ?? 'Our Promise' }}</h3>
                <p>{!! nl2br(e($about?->section5_body ?? 'We support every booking with responsive customer care and a focus on fairness for both customers and technicians.')) !!}</p>
            </div>
            <div class="about-panel">
                <h3>{{ $about?->section6_title ?? 'Community First' }}</h3>
                <p>{!! nl2br(e($about?->section6_body ?? 'We believe in empowering local technicians and building stronger neighborhoods through reliable service.')) !!}</p>
            </div>
        </div>
    </div>
</section>
<!-- /About Content -->


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

.about-section {
    --about-accent: #5a83ff;
    --about-ink: #0b1b3a;
    --about-muted: #5f6b7a;
    position: relative;
    overflow: hidden;
    padding: 90px 0 50px;
    background: linear-gradient(180deg, #f2f6ff 0%, #eef3ff 45%, #f8faff 100%);
    font-family: "Manrope", "Segoe UI", sans-serif;
}

.about-section::before,
.about-section::after {
    content: "";
    position: absolute;
    width: 380px;
    height: 380px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(90, 131, 255, 0.22), rgba(90, 131, 255, 0));
    z-index: 0;
}

.about-section::before {
    top: -120px;
    left: -80px;
}

.about-section::after {
    bottom: -140px;
    right: -90px;
}

.about-section .auto-container {
    position: relative;
    z-index: 1;
}

.about-hero {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 28px;
    align-items: center;
    margin-bottom: 34px;
}

.about-hero-text h2 {
    font-family: "Fraunces", "Manrope", serif;
    font-size: clamp(30px, 3vw, 40px);
    color: var(--about-ink);
    margin-bottom: 10px;
    letter-spacing: -0.6px;
}

.about-subtitle {
    display: inline-block;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    color: var(--about-accent);
    background: rgba(90, 131, 255, 0.12);
    border: 1px dashed rgba(90, 131, 255, 0.45);
    padding: 6px 12px;
    border-radius: 999px;
    margin-bottom: 14px;
}

.about-hero-text {
    background: #ffffff;
    border-radius: 20px;
    padding: 26px 28px;
    box-shadow: 0 12px 30px rgba(15, 36, 62, 0.12);
    border: 1px solid rgba(90, 131, 255, 0.12);
}

.about-intro {
    color: var(--about-muted);
    font-size: 16px;
    line-height: 1.7;
}

.about-hero-logo {
    display: flex;
    justify-content: center;
}

.logo-badge {
    position: relative;
    background: #ffffff;
    padding: 24px 28px;
    border-radius: 22px;
    box-shadow: 0 18px 40px rgba(15, 36, 62, 0.16);
    border: 1px solid rgba(90, 131, 255, 0.2);
    animation: floatLogo 4.5s ease-in-out infinite;
}

.logo-badge img {
    max-height: 96px;
    width: auto;
    display: block;
}

@keyframes floatLogo {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-8px);
    }
}

.about-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 22px;
    margin-bottom: 32px;
}

.about-card {
    position: relative;
    background: #ffffff;
    border-radius: 18px;
    padding: 22px 24px 26px;
    box-shadow: 0 12px 30px rgba(15, 36, 62, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(90, 131, 255, 0.12);
}

.about-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(15, 36, 62, 0.16);
}

.about-card h3 {
    font-size: 18px;
    margin-bottom: 10px;
    color: var(--about-ink);
}

.about-card p {
    color: var(--about-muted);
}

.about-values {
    background: linear-gradient(135deg, #ffffff 0%, #f7f9ff 100%);
    border-radius: 18px;
    padding: 26px 28px;
    box-shadow: 0 12px 30px rgba(15, 36, 62, 0.1);
    margin-bottom: 26px;
    border: 1px solid rgba(90, 131, 255, 0.12);
}

.about-values h3 {
    font-size: 18px;
    color: var(--about-ink);
    margin-bottom: 14px;
}

.about-list {
    margin: 0;
    padding: 0;
    list-style: none;
    color: var(--about-muted);
    columns: 2;
    column-gap: 24px;
}

.about-list li {
    position: relative;
    padding-left: 22px;
    margin-bottom: 12px;
    break-inside: avoid;
}

.about-list li::before {
    content: "";
    position: absolute;
    left: 0;
    top: 8px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--about-accent);
    box-shadow: 0 0 0 4px rgba(90, 131, 255, 0.18);
}

.about-split {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 22px;
}

.about-panel {
    background: #ffffff;
    border-radius: 18px;
    padding: 22px 24px 26px;
    box-shadow: 0 12px 30px rgba(15, 36, 62, 0.1);
    border: 1px solid rgba(90, 131, 255, 0.12);
}

.about-panel h3 {
    font-size: 18px;
    margin-bottom: 10px;
    color: var(--about-ink);
}

.about-panel p {
    color: var(--about-muted);
}

@media (max-width: 991px) {
    .about-hero-text {
        padding: 22px 22px;
    }

    .about-list {
        columns: 1;
    }
}

@media (max-width: 575px) {
    .about-hero {
        gap: 18px;
    }

    .about-hero-text {
        border-radius: 16px;
    }

    .logo-badge {
        padding: 18px 20px;
        border-radius: 16px;
    }
}

</style>


@endsection
