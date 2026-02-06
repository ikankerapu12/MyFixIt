@extends('technician.technician_dashboard')
@section('technician')


@section('title2')
  Technician All Booking Request | MyFixIt  
@endsection
<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
	  
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">All Booking Request </h6>
               
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Sl </th>
                        <th>User </th> 
                        <th>Service </th> 
                        <th>Date </th> 
                        <th>Time </th> 
                        <th>Status </th> 
                        <th>Action </th> 
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($usermsg as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td> 
                        <td>{{ $item['user']['name'] }}</td> 
                        <td>{{ $item['service']['service_name'] }}</td> 
                        <td>{{ $item->booking_date }}</td> 
                        <td>{{ $item->booking_time }}</td> 
                        <td> 
                      @if($item->status == 1)
                <span class="badge rounded-pill bg-success text-dark">Confirm</span>
                      @elseif($item->status == 0)
               <span class="badge rounded-pill bg-warning text-dark">Pending</span>
                      @elseif($item->status == 2)
                <span class="badge rounded-pill bg-danger text-dark">Rejected</span>
                      @elseif($item->status == 3)
                <span class="badge rounded-pill bg-secondary text-dark">Cancelled</span>
                      @endif

                        </td> 
                        <td>

        <a href="{{ route('technician.details.booking',$item->id) }}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>
  
       <a href="{{ route('technician.delete.booking',$item->id) }}" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i>  </a>
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