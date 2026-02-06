@extends('technician.technician_dashboard')
@section('technician')

<div class="page-content">
    {{-- <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('technician.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reviews & Ratings</li>
        </ol>
    </nav> --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Reviews</h6>
                    <p class="text-muted mb-3">View and manage reviews from your customers</p>
                    
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Service</th>
                                    <th>Customer</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Date</th>
                                    <th>Reply Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $key => $review)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <a href="{{ url('service/details/'.$review->service->id.'/'.$review->service->service_slug) }}" target="_blank">
                                            {{ Str::limit($review->service->service_name, 25) }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ (!empty($review->user->photo)) ? url('upload/user_images/'.$review->user->photo) : url('upload/no_image.jpg') }}" 
                                                 alt="" class="rounded-circle me-2" style="width: 35px; height: 35px; object-fit: cover;">
                                            {{ $review->user->name }}
                                        </div>
                                    </td>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 12px;"></i>
                                        @endfor
                                    </td>
                                    <td>{{ Str::limit($review->comment, 40) }}</td>
                                    <td>{{ $review->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($review->technician_reply)
                                            <span class="badge bg-success">Replied</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('technician.show.review', $review->id) }}" class="btn btn-sm btn-primary">
                                            <i data-feather="eye"></i>
                                        </a>
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

@endsection
