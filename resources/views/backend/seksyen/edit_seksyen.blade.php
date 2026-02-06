@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('title1')
  Admin Edit Seksyen | MyFixIt  
@endsection
<div class="page-content">

       
        <div class="row profile-body">
          <!-- left wrapper start -->
          
          <!-- left wrapper end -->
          <!-- middle wrapper start -->
          <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
             <div class="card">
              <div class="card-body">

			<h6 class="card-title">Edit Seksyen   </h6>

			<form method="POST" action="{{ route('update.seksyen') }}" class="forms-sample" enctype="multipart/form-data">
				@csrf
 <input type="hidden" name="old_img" value="{{ $seksyen->seksyen_image }}">

  <input type="hidden" name="id" value="{{ $seksyen->id }}">

				<div class="mb-3">
 <label for="exampleInputEmail1" class="form-label">Seksyen Name   </label>
					 <input type="text" name="seksyen_name" class="form-control " value="{{ $seksyen->seksyen_name }}" > 
				</div>

			 	<div class="mb-3">
 <label for="exampleInputEmail1" class="form-label">Seksyen Photo   </label>
 
   <input class="form-control"  name="seksyen_image" type="file" id="image">
        </div>

  <div class="mb-3">
 <label for="exampleInputEmail1" class="form-label">    </label>
  <img id="showImage" class="wd-80 rounded-circle" src="{{ asset($seksyen->seksyen_image) }}" alt="profile">
        </div>
				 
	 <button type="submit" class="btn btn-primary me-2">Update Seksyen </button>
			 
			</form>

              </div>
            </div>




            </div>
          </div>
          <!-- middle wrapper end -->
          <!-- right wrapper start -->
         
          <!-- right wrapper end -->
        </div>

			</div>
 
<script type="text/javascript">
  $(document).ready(function(){
    $('#image').change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src',e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
  });


</script>

@endsection