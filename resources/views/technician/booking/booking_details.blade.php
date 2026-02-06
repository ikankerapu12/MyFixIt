@extends('technician.technician_dashboard')
@section('technician')
@section('title2')
  Technician Booking Details | MyFixIt  
@endsection
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <h6 class="card-title">Booking Request Details </h6>
                <form method="post" action="{{ route('technician.update.booking') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $booking->id }}">
                    <input type="hidden" name="email" value="{{ $booking->user->email }}">

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <tbody>
                                <!-- Booking details -->
                                <tr>
                                    <td>User Name </td>
                                    <td>{{ $booking->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>User Phone </td>
                                    <td>{{ $booking->user->phone }}</td>
                                </tr>
                                <tr>
                                    <td>User Address </td>
                                    <td>{{ $booking->user->address }}</td>
                                </tr>
                                <tr>
                                    <td>Service Name </td>
                                    <td>{{ $booking->service->service_name }}</td>
                                </tr>
                                <tr>
                                    <td>Service Seksyen </td>
                                    <td>{{ $booking->service->sseksyen->seksyen_name }}</td>
                                </tr>
                                <tr>
                                    <td>Booking Date </td>
                                    <td>{{ $booking->booking_date }}</td>
                                </tr>
                                <tr>
                                    <td>Booking Time </td>
                                    <td>{{ $booking->booking_time }}</td>
                                </tr>
                                <tr>
                                    <td>Message </td>
                                    <td>{{ $booking->message }}</td>
                                </tr>
                                <tr>
                                    <td>Status </td>
                                    <td>
                                      @if($booking->status == 1)
                <span class="badge rounded-pill bg-success text-dark">Confirm</span>
                      @elseif($booking->status == 0)
               <span class="badge rounded-pill bg-warning text-dark">Pending</span>
                      @elseif($booking->status == 2)
                <span class="badge rounded-pill bg-danger text-dark">Rejected</span>
                      @elseif($booking->status == 3)
                <span class="badge rounded-pill bg-secondary text-dark">Cancelled</span>
                      @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br><br>

                    <!-- Confirm Button -->
                    @if($booking->status == 0)
                    <label class="form-label">Confirm Fee </label>
                <input type="text" name="confirm_fee" class="form-control" placeholder="Enter Confirm Fee" required>
                    <button type="submit" class="btn btn-success">Confirm Request</button>
                    @endif
                    <br><br>
                </form>
                    <!-- Reject Button -->
                    @if($booking->status == 0)
                        <form action="{{ route('technician.reject.booking') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $booking->id }}">
                            <input type="hidden" name="email" value="{{ $booking->user->email }}">
                            <div class="form-group">
                                <label for="rejection_message">Rejection Message</label>
                                <textarea name="rejection_message" class="form-control" required>{{ $booking->rejection_message }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-danger">Reject Request</button>
                        </form>
                    @endif

                    <!-- Cancel Button -->
                    @if($booking->status == 1)
                        <form action="{{ route('technician.cancel.booking') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $booking->id }}">
                            <input type="hidden" name="email" value="{{ $booking->user->email }}">
                            <div class="form-group">
                                <label for="cancellation_message">Cancellation Message</label>
                                <textarea name="cancellation_message" class="form-control" required>{{ $booking->cancellation_message }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-warning">Cancel Request</button>
                        </form>
                    @endif


            </div>
        </div>
    </div>
</div>

@endsection