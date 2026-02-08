<nav class="sidebar">
<div class="sidebar-header">
    <a href="#" class="sidebar-brand">
    Admin<span>Panel</span>
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
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="link-icon" data-feather="box"></i>
        <span class="link-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item nav-category">MyFixIt</li>

    <li class="nav-item">
    <a class="nav-link {{ Request::routeIs('all.type') || Request::routeIs('add.type') ? '' : 'collapsed' }}"
       data-bs-toggle="collapse"
       href="#type"
       role="button"
       aria-expanded="{{ Request::routeIs('all.type') || Request::routeIs('add.type') ? 'true' : 'false' }}"
       aria-controls="type">
        <i class="link-icon" data-feather="list"></i>
        <span class="link-title">Service Type</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div class="collapse {{ Request::routeIs('all.type') || Request::routeIs('add.type') ? 'show' : '' }}" id="type">
        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{ route('all.type') }}"
                   class="nav-link {{ Request::routeIs('all.type') ? 'active' : '' }}">
                   All Type
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('add.type') }}"
                    class="nav-link {{ Request::routeIs('add.type') ? 'active' : '' }}">
                    Add Type
                </a>
            </li>
        </ul>
    </div>
</li>




    <li class="nav-item">
    <a class="nav-link {{ Request::routeIs('all.seksyen') || Request::routeIs('add.seksyen') ? '' : 'collapsed' }}"
       data-bs-toggle="collapse"
       href="#map"
       role="button"
       aria-expanded="{{ Request::routeIs('all.seksyen') || Request::routeIs('add.seksyen') ? 'true' : 'false' }}"
       aria-controls="map">
        <i class="link-icon" data-feather="map-pin"></i>
        <span class="link-title">Seksyen</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div class="collapse {{ Request::routeIs('all.seksyen') || Request::routeIs('add.seksyen') ? 'show' : '' }}" id="map">
        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{ route('all.seksyen') }}"
                   class="nav-link {{ Request::routeIs('all.seksyen') ? 'active' : '' }}">
                   All Seksyen
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('add.seksyen') }}"
                    class="nav-link {{ Request::routeIs('add.seksyen') ? 'active' : '' }}">
                    Add Seksyen
                </a>
            </li>
        </ul>
    </div>
</li>





<li class="nav-item">
    <a class="nav-link {{ Request::routeIs('all.service') || Request::routeIs('add.service') ? '' : 'collapsed' }}"
        data-bs-toggle="collapse"
        href="#service"
        role="button"
        aria-expanded="{{ Request::routeIs('all.service') || Request::routeIs('add.service') ? 'true' : 'false' }}"
        aria-controls="service">
        <i class="link-icon" data-feather="tool"></i>
        <span class="link-title">Service</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div class="collapse {{ Request::routeIs('all.service') || Request::routeIs('add.service') ? 'show' : '' }}" id="service">
        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{ route('all.service') }}"
                    class="nav-link {{ Request::routeIs('all.service') ? 'active' : '' }}">
                    All Service
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('add.service') }}"
                    class="nav-link {{ Request::routeIs('add.service') ? 'active' : '' }}">
                    Add Service
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item {{ Request::routeIs('admin.all.reviews') || Request::routeIs('admin.show.review') ? 'active' : '' }}">
    <a href="{{ route('admin.all.reviews') }}" class="nav-link {{ Request::routeIs('admin.all.reviews') || Request::routeIs('admin.show.review') ? 'active' : '' }}">
        <i class="link-icon" data-feather="star"></i>
        <span class="link-title">Reviews & Ratings</span>
    </a>
</li>
   
    <li class="nav-item nav-category">User All Function</li>


    <li class="nav-item">
    <a class="nav-link {{ Request::routeIs('all.technician') || Request::routeIs('add.technician') ? '' : 'collapsed' }}"
        data-bs-toggle="collapse"
        href="#technician"
        role="button"
        aria-expanded="{{ Request::routeIs('all.technician') || Request::routeIs('add.technician') ? 'true' : 'false' }}"
        aria-controls="technician">
        <i class="link-icon" data-feather="user"></i>
        <span class="link-title">Manage Technician</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div class="collapse {{ Request::routeIs('all.technician') || Request::routeIs('add.technician') ? 'show' : '' }}" id="technician">
        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{ route('all.technician') }}"
                    class="nav-link {{ Request::routeIs('all.technician') ? 'active' : '' }}">
                    All Technician
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('add.technician') }}"
                    class="nav-link {{ Request::routeIs('add.technician') ? 'active' : '' }}">
                    Add Technician
                </a>
            </li>
        </ul>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link {{ Request::routeIs('all.user') || Request::routeIs('add.user') ? '' : 'collapsed' }}"
        data-bs-toggle="collapse"
        href="#user"
        role="button"
        aria-expanded="{{ Request::routeIs('all.user') || Request::routeIs('add.user') ? 'true' : 'false' }}"
        aria-controls="user">
        <i class="link-icon" data-feather="users"></i>
        <span class="link-title">Manage User</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div class="collapse {{ Request::routeIs('all.user') || Request::routeIs('add.user') ? 'show' : '' }}" id="user">
        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{ route('all.user') }}"
                    class="nav-link {{ Request::routeIs('all.user') ? 'active' : '' }}">
                    All User
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('add.user') }}"
                    class="nav-link {{ Request::routeIs('add.user') ? 'active' : '' }}">
                    Add User
                </a>
            </li>
        </ul>
    </div>
</li>





            {{-- <li class="nav-item {{ Request::routeIs('smtp.setting') ? 'active' : '' }}">
            <a href="{{ route('smtp.setting') }}" class="nav-link">
              <i class="link-icon" data-feather="database"></i>
              <span class="link-title">SMTP Setting </span>
            </a>
          </li> --}}

          <li class="nav-item {{ Request::routeIs('site.setting') ? 'active' : '' }}">
            <a href="{{ route('site.setting') }}" class="nav-link">
              <i class="link-icon" data-feather="settings"></i>
              <span class="link-title">Site Setting </span>
            </a>
          </li>

          <li class="nav-item {{ Request::routeIs('about.setting') ? 'active' : '' }}">
            <a href="{{ route('about.setting') }}" class="nav-link">
              <i class="link-icon" data-feather="info"></i>
              <span class="link-title">About Setting</span>
            </a>
          </li>

          <li class="nav-item {{ Request::routeIs('terms.setting') ? 'active' : '' }}">
            <a href="{{ route('terms.setting') }}" class="nav-link">
              <i class="link-icon" data-feather="file-text"></i>
              <span class="link-title">Terms Setting</span>
            </a>
          </li>

          <li class="nav-item {{ Request::routeIs('privacy.setting') ? 'active' : '' }}">
            <a href="{{ route('privacy.setting') }}" class="nav-link">
              <i class="link-icon" data-feather="shield"></i>
              <span class="link-title">Privacy Setting</span>
            </a>
          </li>




    <li class="nav-item nav-category">Issue All Function</li>
    <li class="nav-item {{ Request::routeIs('admin.service.report') ? 'active' : '' }}">
        <a href="{{ route('admin.service.report') }}" class="nav-link">
        <i class="link-icon" data-feather="clipboard"></i>
        <span class="link-title">All Service Report</span>
        </a>
    </li>


    <li class="nav-item {{ Request::routeIs('admin.technician.report') ? 'active' : '' }}">
        <a href="{{ route('admin.technician.report') }}" class="nav-link">
        <i class="link-icon" data-feather="briefcase"></i>
        <span class="link-title">All Technician Report</span>
        </a>
    </li>


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
