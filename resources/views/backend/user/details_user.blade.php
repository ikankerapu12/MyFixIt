@extends('admin.admin_dashboard')
@section('admin')

@section('title1')
  Admin Details User | MyFixIt  
@endsection
<div class="page-content">

    <div class="row">

        {{-- LEFT SIDE --}}
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">User Details</h6>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>

                                <tr>
                                    <td>Name</td>
                                    <td><code>{{ $user->name }}</code></td>
                                </tr>

                                <tr>
                                    <td>Email</td>
                                    <td><code>{{ $user->email }}</code></td>
                                </tr>

                                <tr>
                                    <td>Phone</td>
                                    <td><code>{{ $user->phone }}</code></td>
                                </tr>

                                <tr>
                                    <td>Address</td>
                                    <td><code>{{ $user->address }}</code></td>
                                </tr>

                                <tr>
                                    <td>Photo</td>
                                    <td>
                                        <img src="{{ !empty($user->photo)
                                            ? url('upload/user_images/'.$user->photo)
                                            : url('upload/no_image.jpg') }}"
                                            style="width:100px; height:70px;">
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
                                    <td><code>User</code></td>
                                </tr>

                                <tr>
                                    <td>Created At</td>
                                    <td><code>{{ $user->created_at }}</code></td>
                                </tr>

                                <tr>
                                    <td>Last Updated</td>
                                    <td><code>{{ $user->updated_at }}</code></td>
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