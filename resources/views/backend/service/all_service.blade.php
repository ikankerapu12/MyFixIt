@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@section('title1')
  Admin All Service | MyFixIt  
@endsection
<div class="page-content">

                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
    <a href="{{ route('add.service') }}" class="btn btn-inverse-info"> Add Service    </a>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h6 class="card-title">All Service </h6>
            
                <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>Sl </th>
                        <th>Image </th> 
                        <th>Name </th> 
                        <th>S Type </th> 
                        <th>Seksyen </th> 
                        <th>Code </th> 
                        <th>Status </th>  
                        <th>Action </th> 
                    </tr>
                    </thead>
                    <tbody>
                @foreach($service as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img src="{{ asset($item->service_thumbnail) }}" style="width:70px; height:40px;"> </td> 
                        <td>{{ $item->service_name }}</td> 
                        <td>{{ $item['type']['type_name'] }}</td> 
                        <td>{{ $item['sseksyen']['seksyen_name'] }}</td> 
                        <td>{{ $item->service_code }}</td> 
                        <td> 
                        @if($item->status == 1)
                <span class="badge rounded-pill bg-success">Available</span>
                        @elseif($item->status == 2)
                <span class="badge rounded-pill bg-warning">Busy</span>
                        @else
                <span class="badge rounded-pill bg-danger">Unavailable</span>
                        @endif

                        </td> 
                        <td>
    <a href="{{ route('details.service',$item->id) }}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>

    <a href="{{ route('edit.service',$item->id) }}" class="btn btn-inverse-warning" title="Edit"> <i data-feather="edit"></i> </a>

    <a href="{{ route('delete.service',$item->id) }}" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i>  </a>
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