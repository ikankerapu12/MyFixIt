@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('title1')
  Admin Edit Service | MyFixIt  
@endsection
<div class="page-content">

    
        <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
    
    <div class="card">
    <div class="card-body">
        <h6 class="card-title">Edit Service </h6>
            <form method="post" action="{{ route('update.service') }}" id="myForm" enctype="multipart/form-data">
                @csrf

<input type="hidden" name="id" value="{{ $service->id }}">

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <label class="form-label">Service Name </label>
                <input type="text" name="service_name" class="form-control" value="{{ $service->service_name }}">
            </div>
        </div><!-- Col -->


    <div class="col-sm-6">
            <div class="form-group mb-3">
                <label class="form-label">Lowest Fee </label>
                <input type="text" name="lowest_fee" class="form-control" value="{{ $service->lowest_fee }}">
            </div>
        </div><!-- Col -->


            <div class="col-sm-6">
            <div class="form-group mb-3">
                <label class="form-label">Max Fee </label>
                <input type="text" name="max_fee" class="form-control" value="{{ $service->max_fee }}">
            </div>
        </div><!-- Col -->






    </div><!-- Row -->

<div class="row">
        <div class="col-sm-12">
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{ $service->address }}">
            </div>
        </div><!-- Col -->
</div><!-- Row -->
    <div class="row">
        <div class="col-sm-3">
            <div class="mb-3">
                   <label class="form-label">Seksyen</label>
                <select name="seksyen" class="form-select" id="exampleFormControlSelect1">
                <option selected="" disabled="">Select Seksyen</option>
               @foreach($sseksyen as $seksyen)
                <option value="{{ $seksyen->id }}" {{ $seksyen->id == $service->seksyen ? 'selected' : '' }}>{{ $seksyen->seksyen_name }}</option>
               @endforeach
            </select>
</div>

        </div><!-- Col -->
        <div class="col-sm-3">
            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control" value="{{ $service->city }}">
            </div>
        </div><!-- Col -->
        <div class="col-sm-3">
            <div class="mb-3">
                <label class="form-label">State</label>
                <input type="text" name="state" class="form-control" value="{{ $service->state }}">
            </div>
        </div><!-- Col -->
        <div class="col-sm-3">
            <div class="mb-3">
                <label class="form-label">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" value="{{ $service->postal_code }}">
            </div>
        </div><!-- Col -->
    </div><!-- Row -->

<div class="row">
        <div class="col-sm-12">
            <div class="mb-3">
                <label class="form-label">Service Video</label>
                <input type="text" name="service_video" class="form-control" value="{{ $service->service_video }}">
            </div>
        </div><!-- Col -->
</div>

    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label">Latitude</label>
                <input type="text" name="latitude" class="form-control" value="{{ $service->latitude }}">
                <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Click here to get Latitude from address</a>
            </div>
        </div><!-- Col -->
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label">Longitude</label>
                <input type="text" name="longitude" class="form-control" value="{{ $service->longitude }}">
                <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Click here to get Longitude from address</a>
            </div>
        </div><!-- Col -->
    </div><!-- Row -->

<div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label">Service Type</label>
                <select name="stype_id" class="form-select" id="exampleFormControlSelect1" required>
                <option selected="" disabled="">Select Type</option>
                @foreach($servicetype as $stype)
                    <option value="{{ $stype->id }}" {{ $stype->id == $service->stype_id ? 'selected' : '' }}>{{ $stype->type_name }}</option>
                @endforeach
            </select>
            </div>
        </div><!-- Col -->
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label">Technician</label>
                <select name="technician_id" class="form-select" id="exampleFormControlSelect1">
                <option selected="" disabled="">Select Technician</option>
                @foreach($activeTechnician as $technician)
                    <option value="{{ $technician->id }}" {{ $technician->id == $service->technician_id ? 'selected' : '' }}>{{ $technician->name }}</option>
                @endforeach
            </select>
            </div>
        </div><!-- Col -->
    </div><!-- Row -->



<div class="col-sm-12">
            <div class="mb-3">
                <label class="form-label">Short Description</label>
        <textarea name="short_descp" class="form-control" id="exampleFormControlTextarea1" rows="3"> {{ $service->short_descp }} </textarea>
                
            </div>
        </div><!-- Col -->



    <div class="col-sm-12">
            <div class="mb-3">
                <label class="form-label">Long Description</label>

                <textarea name="long_descp" class="form-control" name="tinymce" id="tinymceExample" rows="10"> {!! $service->long_descp !!} </textarea>
                
            </div>
        </div><!-- Col -->


<hr>

<div class="mb-3">
            <div class="form-check form-check-inline">
<input type="checkbox" name="featured" value="1" class="form-check-input" id="checkInline1" {{ $service->featured == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="checkInline1">
                Features Service 
                </label>
            </div>
        

        <div class="form-check form-check-inline">
<input type="checkbox" name="hot" value="1" class="form-check-input" id="checkInline" {{ $service->hot == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="checkInline">
                    Hot Service  
                </label>
            </div>
        
        
        </div>


        <button type="submit" class="btn btn-primary">Update Service </button>
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



            <!--  /// Service Main Thumbnail Image Update //// -->

    <div class="page-content" style="margin-top: -35px;" > 
        
            <div class="row profile-body"> 
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
        
        <div class="card">
        <div class="card-body">
            <h6 class="card-title">Edit Main Thumbnail Image </h6>
                

                <form method="post" action="{{ route('update.service.thumbnail') }}" id="myForm" enctype="multipart/form-data">
                    @csrf

            <input type="hidden" name="id" value="{{ $service->id }}">
            <input type="hidden" name="old_img" value="{{ $service->service_thumbnail }}" >

            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label class="form-label">Main Thumbnail </label>
                    <input type="file" name="service_thumbnail" class="form-control" onChange="mainThumUrl(this)"  >

                    <img src="" id="mainThmb">

                </div>


                <div class="form-group col-md-6">
                    <label class="form-label">  </label> 
                    <img src="{{ asset($service->service_thumbnail) }}" style="width:100px; height:100px;">
                </div>
            </div><!-- Col -->

    <button type="submit" class="btn btn-primary">Update Thumbnail </button>


                </form> 
            </div>
            </div>

            </div>
        </div>
    </div>
    </div> 
    <!--    /// End  Service Main Thumbnail Image Update //// -->


      <!--  /// Service Multi Image Update //// -->


<div class="page-content" style="margin-top: -35px;" > 
    
        <div class="row profile-body"> 
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
    
    <div class="card">
    <div class="card-body">
        <h6 class="card-title">Edit Multi Image  </h6>
            

    <form method="post" action="{{ route('update.service.multiimage') }}" id="myForm" enctype="multipart/form-data">
                @csrf

{{-- ERROR MESSAGE --}}
    @if ($errors->has('multi_img'))
        <div class="alert alert-danger mb-3">
            {{ $errors->first('multi_img') }}
        </div>
    @endif
<div class="table-responsive">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Sl</th>
            <th>Image</th>
            <th>Change Image </th>
            <th>Delete </th> 
        </tr>
    </thead>
    <tbody>
        
        @foreach($multiImage as $key => $img)
        <tr>

            <td>{{ $key+1 }}</td>

            <td class="py-1">
                <img src="{{ asset($img->photo_name) }}" alt="image"  style="width:50px; height:50px;">
            </td> 
        
            <td> 
            <input type="file" class="form-control" name="multi_img[{{ $img->id }}]">
            </td>
            <td>
    <input type="submit" class="btn btn-primary px-4" value="Update Image" >

    <a href="{{ route('service.multiimg.delete',$img->id) }}" class="btn btn-danger" id="delete">Delete </a>
            </td>
        </tr>
        @endforeach
        
    </tbody>
</table>
</div>

            </form> 

            <form method="post" action="{{ route('store.new.multiimage') }}" id="myForm" enctype="multipart/form-data">
                @csrf

        <input type="hidden" name="imageid" value="{{ $service->id }}">

<table class="table table-striped">
<tbody>
    <tr>
        <td>
            <input type="file" class="form-control" name="multi_img">
        </td>

        <td>
            <input type="submit" class="btn btn-info px-4" value="Add Image" >
        </td>
    </tr>
</tbody>
</table>

</form> 

        </div>
        </div>

        </div>
    </div>
</div>
</div> 


 <!--  /// End Property Multi Image Update //// -->



<script type="text/javascript">
    function mainThumUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
            $('#mainThmb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    } 
</script>


<script> 

$(document).ready(function(){
$('#multiImg').on('change', function(){ //on file input change
    if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
    {
        var data = $(this)[0].files; //this file data
        
        $.each(data, function(index, file){ //loop though each file
            if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                var fRead = new FileReader(); //new filereader
                fRead.onload = (function(file){ //trigger function on successful read
                return function(e) {
                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                .height(80); //create image element 
                    $('#preview_img').append(img); //append image to output element
                };
                })(file);
                fRead.readAsDataURL(file); //URL representing the file's data.
            }
        });
        
    }else{
        alert("Your browser doesn't support File API!"); //if File API is absent
    }
});
});

</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                service_name: {
                    required : true,
                },
                lowest_fee: {
                    required : true,
                },
                max_fee: {
                    required : true,
                },
                seksyen: {
                    required : true,
                },
                stype_id: {
                    required : true,
                },

                
            },
            messages :{
                service_name: {
                    required : 'Please Enter Service Name',
                }, 
                lowest_fee: {
                    required : 'Please Enter Lowest Fee',
                }, 
                max_fee: {
                    required : 'Please Enter Max Fee',
                }, 
                seksyen: {
                    required : 'Please Select Seksyen',
                }, 
                stype_id: {
                    required : 'Please Select Service Type',
                }, 
                

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>


@endsection