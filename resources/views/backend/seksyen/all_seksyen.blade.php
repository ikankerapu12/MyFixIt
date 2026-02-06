@extends('admin.admin_dashboard')
@section('admin')
@section('title1')
  Admin All Seksyen | MyFixIt  
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
	  <a href="{{ route('add.seksyen') }}" class="btn btn-inverse-info"> Add Seksyen    </a>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Seksyen All </h6>
               
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Sl </th>
                        <th>Seksyen Name </th>
                        <th>Seksyen Image </th>
                        <th>Action </th> 
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($seksyen as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->seksyen_name }}</td>
                        <td><img src="{{ asset($item->seksyen_image) }}" style="width:70px;height: 40px;"> </td>
                        <td>
       <a href="{{ route('edit.seksyen',$item->id) }}" class="btn btn-inverse-warning"> Edit </a>
       <a href="{{ route('delete.seksyen',$item->id) }}" class="btn btn-inverse-danger" id="delete"> Delete  </a>
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