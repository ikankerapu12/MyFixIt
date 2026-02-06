
@php
$id = Auth::user()->id;
$technicianId = App\Models\User::find($id);
$status = $technicianId->status;
@endphp


<nav class="sidebar">
<div class="sidebar-header">
    <a href="#" class="sidebar-brand">
    Tech<span>Panel</span>
    </a>
    <div class="sidebar-toggler not-active">
    <span></span>
    <span></span>
    <span></span>
    </div>
</div>
<div class="sidebar-body">
    <ul class="nav">
    <li class="nav-item nav-category">Main</li>
    <li class="nav-item {{ Request::routeIs('technician.dashboard') ? 'active' : '' }}">
        <a href="{{ route('technician.dashboard') }}" class="nav-link">
        <i class="link-icon" data-feather="box"></i>
        <span class="link-title">Dashboard</span>
        </a>
    </li>


    @if($status === 'active')
    <li class="nav-item nav-category">MyFixIt</li>


<li class="nav-item">
    <a class="nav-link {{ Request::routeIs('technician.all.service') || Request::routeIs('technician.add.service') ? '' : 'collapsed' }}"
        data-bs-toggle="collapse"
        href="#emails"
        role="button"
        aria-expanded="{{ Request::routeIs('technician.all.service') || Request::routeIs('technician.add.service') ? 'true' : 'false' }}"
        aria-controls="emails">
        <i class="link-icon" data-feather="tool"></i>
        <span class="link-title">Service</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div class="collapse {{ Request::routeIs('technician.all.service') || Request::routeIs('technician.add.service') ? 'show' : '' }}" id="emails">
        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{ route('technician.all.service') }}"
                    class="nav-link {{ Request::routeIs('technician.all.service') ? 'active' : '' }}">
                    All Service
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('technician.add.service') }}"
                    class="nav-link {{ Request::routeIs('technician.add.service') ? 'active' : '' }}">
                    Add Service
                </a>
            </li>
        </ul>
    </div>
</li>

            <li class="nav-item {{ Request::routeIs('technician.booking.request') ? 'active' : '' }}">
            <a href="{{ route('technician.booking.request') }}" class="nav-link">
              <i class="link-icon" data-feather="inbox"></i>
              <span class="link-title">Booking Request </span>
            </a>
          </li>



            <li class="nav-item {{ Request::routeIs('technician.chat.message') ? 'active' : '' }}">
            <a href="{{ route('technician.chat.message') }}" class="nav-link">
              <i class="link-icon" data-feather="message-square"></i>
              <span class="link-title">Chat Message </span>
            </a>
          </li>

          <li class="nav-item {{ Request::routeIs('technician.all.reviews') || Request::routeIs('technician.show.review') ? 'active' : '' }}">
            <a href="{{ route('technician.all.reviews') }}" class="nav-link {{ Request::routeIs('technician.all.reviews') || Request::routeIs('technician.show.review') ? 'active' : '' }}">
              <i class="link-icon" data-feather="star"></i>
              <span class="link-title">Reviews & Ratings </span>
            </a>
          </li>


            @else

            @endif


    {{-- <li class="nav-item nav-category">Docs</li>
    <li class="nav-item">
        <a href="#" target="_blank" class="nav-link">
        <i class="link-icon" data-feather="hash"></i>
        <span class="link-title">Documentation</span>
        </a>
    </li> --}}
    </ul>
</div>
</nav>
{{-- <nav class="settings-sidebar">
<div class="sidebar-body">
    <a href="#" class="settings-sidebar-toggler">
    <i data-feather="settings"></i>
    </a>
    <div class="theme-wrapper">
    <h6 class="text-muted mb-2">Light Theme:</h6>
    <a class="theme-item" href="../demo1/dashboard.html">
        <img src="../assets/images/screenshots/light.jpg" alt="light theme">
    </a>
    <h6 class="text-muted mb-2">Dark Theme:</h6>
    <a class="theme-item active" href="../demo2/dashboard.html">
        <img src="../assets/images/screenshots/dark.jpg" alt="light theme">
    </a>
    </div>
</div>
</nav> --}}
