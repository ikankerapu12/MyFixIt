<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>@yield('title') </title>
 @vite(['resources/js/app.js'])
<!-- Fav Icon -->
<link rel="icon" href="{{ asset('frontend/assets/images/myfixit_title.png') }}" type="image/x-icon">
<meta name="csrf-token" content="{{ csrf_token() }}" >
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{ asset('frontend/assets/css/font-awesome-all.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/icomoon.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css11/flaticon.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/owl.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/nice-select.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/color/theme-color.css') }}" id="jssDefault" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/switcher-style.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/responsive.css') }}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

<script src="https://cdn.jsdelivr.net/npm/feather-icons"></script>
<style>
body.site-soft-bg {
  background: linear-gradient(180deg, #f2f6ff 0%, #eef3ff 45%, #f8faff 100%);
}

body.site-soft-bg .boxed_wrapper {
  background: transparent;
}
</style>
</head>


@php
    $isHome = request()->is('/') || request()->path() === '' || request()->path() === '/';
@endphp
<!-- page wrapper -->
<body class="{{ $isHome ? '' : 'site-soft-bg' }}">

    <div class="boxed_wrapper">


        <!-- preloader -->
        @include('frontend.home.preload')
        <!-- preloader end -->


        <!-- switcher menu -->

        <!-- end switcher menu -->


        <!-- main header -->
        @include('frontend.home.header')
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        @include('frontend.home.mobile_menu')
        <!-- End Mobile Menu -->


        @yield('main')


        <!-- main-footer -->
        @include('frontend.home.footer')
        <!-- main-footer end -->



        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>
    </div>


    <!-- jequery plugins -->
    <script src="{{ asset('frontend/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/validation.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/appear.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jQuery.style.switcher.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/nav-tool.js') }}"></script>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
    <script src="{{ asset('frontend/assets/js/gmaps.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/map-helper.js') }}"></script>


    <!-- main-js -->
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
@if(Session::has('message'))
var type = "{{ Session::get('alert-type','info') }}"
switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
}
@endif 
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
    
    // Add To Wishlist 
    function addToWishList(service_id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/add-to-wishList/"+service_id,

            success:function(data){
                wishlist();
                // Start Message 

            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  
                  showConfirmButton: false,
                  timer: 3000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    icon: 'success', 
                    title: data.success, 
                    })

            }else{
               
           Toast.fire({
                    type: 'error',
                    icon: 'error', 
                    title: data.error, 
                    })
                }

              // End Message  

            }
        })

    }


</script>

<!-- // start load Wishlist Data  -->

<script type="text/javascript">

    function wishlist(){
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-wishlist-service/",

            success:function(response){

                $('#wishQty').text(response.wishQty);


                                var rows = ""
                $.each(response.wishlist, function(key,value){

                  rows += `<div class="deals-block-one" data-service-id="${value.service.id}">
        <div class="inner-box">
            <div class="image-box">
                <figure class="image"><img src="/${value.service.service_thumbnail}" alt=""></figure>
                <div class="batch"><i class="icon-11"></i></div>
                <span class="category">${value.service.featured == 1 ? 'Featured' : 'New'}</span>
            </div>
            <div class="lower-content">
                <div class="title-text"><h4><a href="">${value.service.service_name}</a></h4></div>
                <h5 class="service-status-badge">
            <span class="badge rounded-pill 
                ${value.service.status == 1 ? 'bg-success text-white' : 
                    value.service.status == 2 ? 'bg-warning text-dark' : 'bg-danger text-white'}">
                ${value.service.status == 1 ? 'Available' : 
                    value.service.status == 2 ? 'Busy' : 'Unavailable'}
            </span>
        </h5>
                <div class="price-box clearfix">
                    <div class="price-info pull-left">
                        <h6>Start From</h6>
                        <h4>RM ${value.service.lowest_fee}</h4>
                    </div>
                    <div class="price-info pull-right">
                        <h6>To</h6>
                        <h4>RM ${value.service.max_fee}</h4>
                    </div>
                     
                </div>
               <p>${value.service.short_descp}</p>
                <ul class="more-details clearfix">
                    <li><i class="fas fa-map-marker-alt"></i>${value.service.sseksyen?.seksyen_name}</li>
                    <li><i class="fas fa-tools"></i>${value.service.type.type_name}</li>
                </ul>
                <div class="other-info-box clearfix">
                    
                    <ul class="other-option pull-right clearfix">
                       
                        <li><a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)" ><i class="fa fa-trash"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> `  
                });

      $('#wishlist').html(rows);   
            }
        })
    }
     wishlist();
         // Wishlist Remove Start 

    function wishlistRemove(id){
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/wishlist-remove/"+id,

            success:function(data){
                wishlist();

                 // Start Message 

            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  
                  showConfirmButton: false,
                  timer: 3000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    icon: 'success', 
                    title: data.success, 
                    })

            }else{
               
           Toast.fire({
                    type: 'error',
                    icon: 'error', 
                    title: data.error, 
                    })
                }

              // End Message  


            }
        })

    }

    /// End Wishlist Remove 
</script>



<!-- /// Add to Compare page  -->
<script type="text/javascript">

     function addToCompare(service_id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/add-to-compare/"+service_id,

            success:function(data){
               
                // Start Message 

            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  
                  showConfirmButton: false,
                  timer: 3000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    icon: 'success', 
                    title: data.success, 
                    })

            }else{
               
           Toast.fire({
                    type: 'error',
                    icon: 'error', 
                    title: data.error, 
                    })
                }

              // End Message  

            }
        })

    }
    

</script>

    <!-- // start load Compare Data  -->

<script type="text/javascript">
    function compare() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-compare-service/",

            success: function(response) {
                var rows = "<div class='compare-container'>";  // Start grid container
                $.each(response, function(key, value) {
                    rows += `
                    <div class="compare-block" data-service-id="${value.service.id}">
                        <div class="image-box">
                            <img src="/${value.service.service_thumbnail}" alt="">
                        </div>
                        <div class="service-info">
                            <h3>${value.service.service_name}</h3>
                                    <h5 class="service-status-badge">
            <span class="badge rounded-pill 
                ${value.service.status == 1 ? 'bg-success text-white' : 
                    value.service.status == 2 ? 'bg-warning text-dark' : 'bg-danger text-white'}">
                ${value.service.status == 1 ? 'Available' : 
                    value.service.status == 2 ? 'Busy' : 'Unavailable'}
            </span>
        </h5>
                            <p><strong>Start From:</strong> RM ${value.service.lowest_fee}</p>
                            <p><strong>To:</strong> RM ${value.service.max_fee}</p>
                            <p><strong>Service Type:</strong> ${value.service.type.type_name}</p>
                            <p><strong>Seksyen:</strong> ${value.service.sseksyen?.seksyen_name}</p>
                            <p><strong>Short Description:</strong> ${value.service.short_descp}</p>
                        </div>
                        <div class="action">
                            <a href="javascript:void(0);" class="text-body" id="${value.id}" onclick="compareRemove(this.id)">
                                <i class="fa fa-trash"></i> Remove
                            </a>
                        </div>
                    </div>`;
                });

                rows += "</div>";  // End of grid container
                $('#compare').html(rows);
            }
        })
    }
    compare();
    // Compare Remove Start 

    function compareRemove(id) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/compare-remove/" + id,

            success: function(data) {
                compare();

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })

                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
            }
        })
    }
</script>

<script>
    feather.replace();
</script>

{{-- Global WebSocket listener for real-time service status updates --}}
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    // Wait for Echo to be available
    const checkEcho = setInterval(function() {
        if (typeof window.Echo !== 'undefined') {
            clearInterval(checkEcho);
            
            console.log('Echo connected on frontend - listening for service status changes');
            
            // Listen for service status changes
            window.Echo.channel('services')
                .listen('.status.changed', (e) => {
                    console.log('Received service status change on frontend:', e);
                    
                    // Update main service status badge (on service details page)
                    var mainBadge = document.getElementById('main-service-status-badge');
                    if (mainBadge && typeof mainServiceId !== 'undefined' && e.serviceId == mainServiceId) {
                        updateStatusBadgeHTML(mainBadge, e.status);
                    }
                    
                    // Update service cards with matching data-service-id
                    var serviceCards = document.querySelectorAll('[data-service-id="' + e.serviceId + '"]');
                    serviceCards.forEach(function(card) {
                        var statusBadge = card.querySelector('.service-status-badge');
                        if (statusBadge) {
                            updateStatusBadgeHTML(statusBadge, e.status);
                        }
                    });
                });

            // Listen for technician status changes
            window.Echo.channel('technicians')
                .listen('.status.changed', (e) => {
                    console.log('Received technician status change on frontend:', e);

                    var techBadges = document.querySelectorAll('.technician-status-badge[data-technician-id="' + e.userId + '"]');
                    techBadges.forEach(function(badge) {
                        updateTechnicianBadgeHTML(badge, e.status);
                    });

                    var chatWrappers = document.querySelectorAll('.technician-chat-wrapper[data-technician-id="' + e.userId + '"]');
                    chatWrappers.forEach(function(wrapper) {
                        toggleTechnicianChat(wrapper, e.status);
                    });
                });
        }
    }, 100);
    
    // Helper function to update status badge HTML
    function updateStatusBadgeHTML(element, status) {
        if (!element) {
            return;
        }

        var spanHtml = '';
        if (status == 1) {
            spanHtml = '<span class="badge rounded-pill bg-success text-white">Available</span>';
        } else if (status == 2) {
            spanHtml = '<span class="badge rounded-pill bg-warning text-dark">Busy</span>';
        } else {
            spanHtml = '<span class="badge rounded-pill bg-danger text-white">Unavailable</span>';
        }

        if (element.tagName === 'H5') {
            element.innerHTML = spanHtml;
        } else {
            element.innerHTML = '<h5>' + spanHtml + '</h5>';
        }
    }

    // Helper function to update technician status badge HTML
    function updateTechnicianBadgeHTML(element, status) {
        if (!element) {
            return;
        }

        var spanHtml = '';
        if (status === 'active') {
            spanHtml = '<span class="badge rounded-pill status-badge bg-success text-white">Active</span>';
        } else {
            spanHtml = '<span class="badge rounded-pill status-badge bg-danger text-white">Inactive</span>';
        }

        if (element.tagName === 'H5') {
            element.innerHTML = spanHtml;
        } else {
            element.innerHTML = '<h5>' + spanHtml + '</h5>';
        }
    }

    function toggleTechnicianChat(wrapper, status) {
        if (!wrapper) {
            return;
        }

        var chatBox = wrapper.querySelector('.technician-chat-box');
        var inactiveMessage = wrapper.querySelector('.technician-inactive-message');

        if (status === 'active') {
            if (chatBox) {
                chatBox.classList.remove('d-none');
            }
            if (inactiveMessage) {
                inactiveMessage.classList.add('d-none');
            }
        } else {
            if (chatBox) {
                chatBox.classList.add('d-none');
            }
            if (inactiveMessage) {
                inactiveMessage.classList.remove('d-none');
            }
        }
    }
});
</script>


<style>
    .compare-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);  /* Two items per row */
    gap: 20px;  /* Adds space between items */
    padding: 20px;
}

.compare-block {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.compare-block:hover {
    transform: scale(1.05);  /* Slight zoom effect on hover */
}

.compare-block .image-box {
    margin-bottom: 15px;
    max-width: 100%;  /* Ensure the image doesn't overflow */
}

.compare-block .image-box img {
    width: 100%;  /* Make sure the images fill the container properly */
    height: auto;  /* Keep aspect ratio intact */
    border-radius: 5px;
}

.compare-block .service-info {
    font-size: 14px;
    color: #333;
    margin-bottom: 15px;
}

.compare-block .service-info h3 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
}

.compare-block .action {
    margin-top: 10px;
}

.compare-block .action a {
    color: #ff6347;
    font-size: 14px;
    text-decoration: none;
}

.compare-block .action a:hover {
    text-decoration: underline;
}

/* For small screens, stack items vertically */
@media (max-width: 768px) {
    .compare-container {
        grid-template-columns: 1fr;  /* Stack items on smaller screens */
    }
}
</style>

</body><!-- End of .page_wrapper -->
</html>
