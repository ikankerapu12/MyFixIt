@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('title1')
  Admin Details Service | MyFixIt  
@endsection
<div class="page-content">

<div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                                <h6 class="card-title">Service Details </h6>
                                <div class="table-responsive">
        <table class="table table-striped">
            
            <tbody>
                <tr> 
                    <td>Service Name </td>
                    <td><code>{{ $service->service_name }}</code></td> 
                </tr>
                <tr> 
                    <td>Lowest Fee </td>
                    <td><code>{{ $service->lowest_fee }}</code></td> 
                </tr>

                <tr> 
                    <td>Max Fee </td>
                    <td><code>{{ $service->max_fee }}</code></td> 
                </tr>
                <tr> 
                <td>Address </td>
                    <td><code>{{ $service->address }}</code></td> 
                </tr>
                <tr> 
                <td>Seksyen </td>
                    <td><code>{{ $service['sseksyen']['seksyen_name'] }}</code></td> 
                </tr>
                <tr> 
                    <td>City </td>
                    <td><code>{{ $service->city }}</code></td> 
                </tr>
                <tr> 
                    <td>State </td>
                    <td><code>{{ $service->state }}</code></td> 
                </tr>

                <tr> 
                    <td>Postal Code </td>
                    <td><code>{{ $service->postal_code }}</code></td> 
                </tr>
                <tr> 
                    <td>Main Image </td>
                    <td>
                    <img src="{{ asset($service->service_thumbnail) }}" style="width:100px; height:70px;">
                    </td> 
                </tr>

                <tr> 
                    <td>Status </td>
                    <td id="service-status-badge">   
                        @if($service->status == 1)
                <span class="badge rounded-pill bg-success">Available</span>
                        @elseif($service->status == 2)
                <span class="badge rounded-pill bg-warning">Busy</span>
                        @else
                <span class="badge rounded-pill bg-danger">Unavailable</span>
                        @endif
                    </td> 
                </tr>
            </tbody>
        </table>
                                </div>
              </div>
            </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
        <div class="card-body">
                        <div class="table-responsive">
        <table class="table table-striped">
            
            <tbody>
                <tr> 
                    <td>Service Code </td>
                    <td><code>{{ $service->service_code }}</code></td> 
                </tr>

                <tr> 
                    <td>Service Video</td>
                    <td><code>{{ $service->service_video }}</code></td> 
                </tr>


                <tr> 
                    <td>Latitude </td>
                    <td><code>{{ $service->latitude }}</code></td> 
                </tr>


                <tr> 
                    <td>Longitude </td>
                    <td><code>{{ $service->longitude }}</code></td> 
                </tr>


                <tr> 
                    <td>Service Type </td>
                    <td><code>{{ $service['type']['type_name'] }}</code></td> 
                </tr>



                <tr> 
                    <td>Technician </td>
                    
            @if($service->technician_id == NULL)
            <td><code> Admin </code></td>
            @else
            <td><code> {{ $service['user']['name'] }} </code></td>
            @endif
                    
                </tr>

                <tr> 
                    <td>Short Description </td>
                    <td><code>{{ $service->short_descp }}</code></td> 
                </tr>


            </tbody>
        </table>

        <br><br>
        
        {{-- Service Status Buttons --}}
        <div class="d-flex gap-2" id="status-buttons">
            <button type="button" class="btn btn-success status-btn {{ $service->status == 1 ? 'active' : '' }}" data-status="1">
                <i data-feather="check-circle"></i> Available
            </button>
            <button type="button" class="btn btn-warning status-btn {{ $service->status == 2 ? 'active' : '' }}" data-status="2">
                <i data-feather="clock"></i> Busy
            </button>
            <button type="button" class="btn btn-danger status-btn {{ $service->status == 3 ? 'active' : '' }}" data-status="3">
                <i data-feather="x-circle"></i> Unavailable
            </button>
        </div>

</div>      
        </div>
            </div>
                    </div>
                </div>


        </div>

<script type="text/javascript">
$(function() {
    // Handle status button clicks
    $('.status-btn').click(function() {
        var status = $(this).data('status');
        var service_id = {{ $service->id }};

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/change/service/status',
            data: { 'status': status, 'service_id': service_id },
            success: function(data) {
                if (data.success) {
                    // Update button active states
                    updateStatusButtons(status);
                    // Update status badge
                    updateStatusBadge(status);

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Changed Successfully!',
                        toast: true,
                        position: 'top-end',
                        timer: 3000
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error occurred!',
                    text: 'Could not change the status. Please try again.',
                    toast: true,
                    position: 'top-end',
                    timer: 3000
                });
            }
        });
    });

    function updateStatusButtons(status) {
        $('.status-btn').removeClass('active');
        $('.status-btn[data-status="' + status + '"]').addClass('active');
    }

    function updateStatusBadge(status) {
        var badgeHtml = '';
        if (status == 1) {
            badgeHtml = '<span class="badge rounded-pill bg-success">Available</span>';
        } else if (status == 2) {
            badgeHtml = '<span class="badge rounded-pill bg-warning">Busy</span>';
        } else {
            badgeHtml = '<span class="badge rounded-pill bg-danger">Unavailable</span>';
        }
        $('#service-status-badge').html(badgeHtml);
    }
});
</script>

{{-- Include Vite assets for Laravel Echo WebSocket --}}
@vite(['resources/js/app.js'])

<script type="text/javascript">
// Wait for Echo to be available, then listen for real-time updates
document.addEventListener('DOMContentLoaded', function() {
    var serviceId = {{ $service->id }};
    
    const checkEcho = setInterval(function() {
        if (typeof window.Echo !== 'undefined') {
            clearInterval(checkEcho);
            
            // Listen for service status changes from other users
            window.Echo.channel('services')
                .listen('.status.changed', (e) => {
                    // Only update if it's for this service
                    if (e.serviceId == serviceId) {
                        console.log('Received service status change:', e);
                        
                        // Update status badge
                        var badgeHtml = '';
                        if (e.status == 1) {
                            badgeHtml = '<span class="badge rounded-pill bg-success">Available</span>';
                        } else if (e.status == 2) {
                            badgeHtml = '<span class="badge rounded-pill bg-warning">Busy</span>';
                        } else {
                            badgeHtml = '<span class="badge rounded-pill bg-danger">Unavailable</span>';
                        }
                        $('#service-status-badge').html(badgeHtml);

                        // Update button active states
                        $('.status-btn').removeClass('active');
                        $('.status-btn[data-status="' + e.status + '"]').addClass('active');

                        // Show notification
                        Swal.fire({
                            icon: 'info',
                            title: 'Status Updated',
                            text: 'Service status was updated by another user.',
                            toast: true,
                            position: 'top-end',
                            timer: 3000
                        });
                    }
                });
                
            console.log('Echo connected - listening for service status changes');
        }
    }, 100);
});
</script>

<style>
.status-btn.active {
    box-shadow: 0 0 0 3px rgba(0,0,0,0.2);
    transform: scale(1.05);
}
.status-btn {
    transition: all 0.2s ease;
}
</style>

@endsection