@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

@section('title1')
  Admin All Technician | MyFixIt  
@endsection
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.technician') }}" class="btn btn-inverse-info"> Add Technician </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Technician All </h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Change</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alltechnician as $key => $item)
                                <tr id="technician-row-{{ $item->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ !empty($item->photo) ? url('upload/technician_images/'.$item->photo) : url('upload/no_image.jpg') }}" style="width:70px; height:40px;"></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>
                                        <span class="badge rounded-pill status-label {{ $item->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <input data-id="{{ $item->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $item->status == 'active' ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <a href="{{ route('details.technician', $item->id) }}" class="btn btn-inverse-info" title="View"><i data-feather="eye"></i></a>
                                        <a href="{{ route('edit.technician', $item->id) }}" class="btn btn-inverse-warning" title="Edit"><i data-feather="edit"></i></a>
                                        <a href="{{ route('delete.technician', $item->id) }}" class="btn btn-inverse-danger" id="delete" title="Delete"><i data-feather="trash-2"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 'active' : 'inactive';
        var user_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: { 'status': status, 'user_id': user_id },
            success: function(data) {
                if (data.success) {
                    // Update the badge and checkbox in real time without refresh
                    const statusLabel = $('#technician-row-' + user_id).find('.status-label');
                    if (status == 'active') {
                        statusLabel.removeClass('bg-danger').addClass('bg-success').text('Active');
                    } else {
                        statusLabel.removeClass('bg-success').addClass('bg-danger').text('Inactive');
                    }

                    // Update the checkbox (sync with the backend)
                    $('.toggle-class[data-id="'+ user_id +'"]').prop('checked', status === 'active');

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
});
</script>

{{-- Include Vite assets for Laravel Echo WebSocket --}}
@vite(['resources/js/app.js'])

<script type="text/javascript">
// Wait for Echo to be available, then listen for real-time updates
document.addEventListener('DOMContentLoaded', function() {
    // Check if Echo is available (slight delay for Vite to load)
    const checkEcho = setInterval(function() {
        if (typeof window.Echo !== 'undefined') {
            clearInterval(checkEcho);
            
            // Listen for technician status changes from other users
            window.Echo.channel('technicians')
                .listen('.status.changed', (e) => {
                    console.log('Received status change:', e);
                    
                    // Update the status badge
                    const statusLabel = $('#technician-row-' + e.userId).find('.status-label');
                    if (e.status === 'active') {
                        statusLabel.removeClass('bg-danger').addClass('bg-success').text('Active');
                    } else {
                        statusLabel.removeClass('bg-success').addClass('bg-danger').text('Inactive');
                    }

                    // Update the toggle checkbox
                    const toggle = $('.toggle-class[data-id="'+ e.userId +'"]');
                    toggle.prop('checked', e.status === 'active');
                    
                    // Reinitialize bootstrap-toggle to reflect the change visually
                    if (toggle.data('bs.toggle')) {
                        toggle.bootstrapToggle(e.status === 'active' ? 'on' : 'off');
                    }

                    // Show notification that another user made a change
                    Swal.fire({
                        icon: 'info',
                        title: 'Status Updated',
                        text: 'A technician status was updated by another user.',
                        toast: true,
                        position: 'top-end',
                        timer: 3000
                    });
                });
                
            console.log('Echo connected - listening for technician status changes');
        }
    }, 100);
});
</script>

@endsection

