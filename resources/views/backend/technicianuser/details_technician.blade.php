@extends('admin.admin_dashboard')
@section('admin')

@section('title1')
  Admin Details Technician | MyFixIt  
@endsection
<div class="page-content">

    <div class="row">

        {{-- LEFT SIDE --}}
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Technician Details</h6>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>

                                <tr>
                                    <td>Name</td>
                                    <td><code>{{ $technician->name }}</code></td>
                                </tr>

                                <tr>
                                    <td>Email</td>
                                    <td><code>{{ $technician->email }}</code></td>
                                </tr>

                                <tr>
                                    <td>Phone</td>
                                    <td><code>{{ $technician->phone }}</code></td>
                                </tr>

                                <tr>
                                    <td>Address</td>
                                    <td><code>{{ $technician->address }}</code></td>
                                </tr>

                                <tr>
                                    <td>Photo</td>
                                    <td>
                                        <img src="{{ !empty($technician->photo)
                                            ? url('upload/technician_images/'.$technician->photo)
                                            : url('upload/no_image.jpg') }}"
                                            style="width:100px; height:70px;">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Status</td>
                                    <td>
                                        @if($technician->status == 'active')
                                            <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                    <tr>
    <td>PDF Document Technician Verification</td>
    <td>
        @if($technician->document)
            <a href="{{ asset($technician->document) }}" class="btn btn-info" target="_blank">View PDF</a>
        @else
            <span>No PDF uploaded</span>
        @endif
    </td>
</tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Account Information</h6>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>

                                <tr>
                                    <td>Role</td>
                                    <td><code>Technician</code></td>
                                </tr>

                                <tr>
                                    <td>Created At</td>
                                    <td><code>{{ $technician->created_at }}</code></td>
                                </tr>

                                <tr>
                                    <td>Last Updated</td>
                                    <td><code>{{ $technician->updated_at }}</code></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection