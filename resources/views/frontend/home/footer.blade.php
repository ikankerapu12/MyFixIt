   @php
   $setting = App\Models\SiteSetting::find(1);
   @endphp

<footer class="main-footer">
            <div class="footer-top bg-color-2">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget about-widget">
                                <div class="widget-title">
                                    <h3>About</h3>
                                </div>
                                <div class="text">
                                    <p>{{ $setting?->about ?? 'MyFixit is a platform that connects customers with local technicians for various repair and maintenance services. Whether you need help with electronics, home appliances, or any other repair tasks, MyFixit provides a convenient and efficient way to find reliable technicians in your area.' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget links-widget ml-70">
                                <div class="widget-title">
                                    <h3>Services</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list class">
                                        <li><a href="{{ route('about.us') }}">About Us</a></li>
                                        <li><a href="{{ route('all.service.type') }}">All Service Category</a></li>
                                        <li><a href="{{ route('all.seksyen') }}">All Seksyen</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget contact-widget">
                                <div class="widget-title">
                                    <h3>Contacts</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="info-list clearfix">
                                        <li><i class="fas fa-map-marker-alt"></i>{{ $setting?->company_address ?? 'SHAH ALAM' }}</li>
<li>
    <i class="fas fa-microphone"></i>
    <a href="tel:{{ $setting?->support_phone ?? '01127076430' }}">
        +{{ $setting?->support_phone ?? '01127076430' }}
    </a>
</li>

<li>
    <i class="fas fa-envelope"></i>
    <a href="mailto:{{ $setting?->email ?? 'support@myfixit.com' }}">
        {{ $setting?->email ?? 'support@myfixit.com' }}
    </a>
</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="inner-box clearfix">
                        <figure class="footer-logo"><a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/images/myfixit-footer.png') }}" alt=""></a></figure>
                        <div class="copyright pull-left">
                             <p><a href="{{ url('/') }}">{{ $setting?->copyright ?? 'Copyright © 2026 MyFixit. All rights reserved.' }}</a></p>
                        </div>
                        <ul class="footer-nav pull-right clearfix">
                            <li><a href="{{ route('terms.service') }}">Terms of Service</a></li>
                            <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
