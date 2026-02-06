   @php
   $setting = App\Models\SiteSetting::find(1);
   @endphp

<header class="main-header">
            <!-- header-top -->
            <div class="header-top">
                <div class="top-inner clearfix">
                    <div class="left-column pull-left">
                        <ul class="info clearfix">
                            <li><i class="far fa-map-marker-alt"></i>{{ $setting?->company_address ?? 'SHAH ALAM' }}</li>
                            <li><i class="far fa-clock"></i>Mon - Sun  24 Hours</li>
                            <li>
    <i class="far fa-phone"></i>
    <a href="tel:{{ $setting?->support_phone ?? '01127076430' }}">
        +{{ $setting?->support_phone ?? '01127076430' }}
    </a>
</li>
                        </ul>
                    </div>
                    <div class="right-column pull-right">
                        
                        @auth

                <div class="sign-box">
                    <a href="{{ route('dashboard') }}" style="margin-right: 15px;"><i class="fas fa-bars"></i> Dashboard</a>
                    <a href="{{ route('user.logout') }}"><i class="fas fa-user"></i> Logout</a>
                </div> 

                        @else 

                <div class="sign-box">
                    <a href="{{ route('login') }}"><i class="fas fa-user"></i>Sign In</a>
                </div>

                        @endauth 
                    </div>
                </div>
            </div>
<!-- header-lower -->
<div class="header-lower">
<div class="outer-box">
<div class="main-box">
<div class="logo-box">
    <figure class="logo">
    <a href="{{ url('/') }}">
        <img src="{{ optional($setting)->logo 
            ? asset(optional($setting)->logo) 
            : asset('frontend/assets/images/myfixit_logo1.png') }}" 
            alt="MyFixIt Logo">
    </a>
</figure>

</div>
<div class="menu-area clearfix">
    <!--Mobile Navigation Toggler-->
    <div class="mobile-nav-toggler">
        <i class="icon-bar"></i>
        <i class="icon-bar"></i>
        <i class="icon-bar"></i>
    </div>
    <nav class="main-menu navbar-expand-md navbar-light">
        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
            <ul class="navigation clearfix">


     <li><a href="{{ url('/') }}"><span>Home</span></a> </li>
     <li><a href="{{ route('about.us') }}"><span>About Us </span></a> </li>
                @php
$stype = App\Models\ServiceType::latest()->get();

@endphp
<li class="dropdown">
    <a href="{{ route('all.service.type') }}"><span>Services</span></a>
    <ul>
        @foreach($stype as $item)
        @php
            $service = App\Models\Service::where('stype_id',$item->id)->get();
        @endphp
            <li>
                <a href="{{ route('service.type',$item->id) }}">
                    {{ $item->type_name }}
                </a>
            </li>
        @endforeach
    </ul>
</li>
         <li><a href="{{ url('/') }}"><span>Technician </span></a> </li>       
             


     <li><a href="{{ url('/') }}"><span>Contact</span></a></li> 
    
     <li> 
    <a href="{{ url('/technician/login') }}" class="btn btn-primary"><span>+</span>Add Service Listing</a> 
</li> 
                
                

            </ul>
        </div>
    </nav>
</div>
</div>
</div>
</div>

            <!--sticky Header-->
            <div class="sticky-header">
                <div class="outer-box">
                    <div class="main-box">
                        <div class="logo-box">
                            <figure class="logo"><a href="index.html"><img src="{{ asset('frontend/assets/images/myfixit_logo1.png') }}" alt=""></a></figure>
                        </div>
                        <div class="menu-area clearfix">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
