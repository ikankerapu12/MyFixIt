@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('title1')
  Admin Update About Us | MyFixIt  
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

			<h6 class="card-title">Update About Us</h6>

  <form id="myForm" method="POST" action="{{ route('update.about.setting') }}" class="forms-sample" enctype="multipart/form-data">
				@csrf
  <input type="hidden" name="id" value="{{ $about->id }}">
  <input type="hidden" name="old_logo" value="{{ $about->logo }}">

				<div class="form-group mb-3">
 <label for="aboutTitle" class="form-label">Page Title</label>
	  <input type="text" id="aboutTitle" name="title" class="form-control" value="{{ $about->title }}" >
				</div>

                <div class="form-group mb-3">
 <label for="aboutSubtitle" class="form-label">Subtitle</label>
      <input type="text" id="aboutSubtitle" name="subtitle" class="form-control" value="{{ $about->subtitle }}" >
                </div>

                    <div class="mb-3">
    <label for="aboutIntro" class="form-label">Intro</label>
                        <textarea id="aboutIntro" name="intro" class="form-control" rows="4">{{ $about->intro }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="aboutLogo" class="form-label">Logo - <strong>Must be (1117 x 286) size</strong></label>
                        <input type="file" id="aboutLogo" name="logo" class="form-control">
                        <div class="mt-2">
                            <img id="showLogo" src="{{ $about->logo ? asset($about->logo) : asset('frontend/assets/images/myfixit_logo1.png') }}" alt="About Logo" style="max-height: 70px;">
                        </div>
                    </div>

                <h6 class="card-title mt-4">Section 1</h6>
                <div class="form-group mb-3">
 <label for="aboutSection1Title" class="form-label">Title</label>
      <input type="text" id="aboutSection1Title" name="section1_title" class="form-control" value="{{ $about->section1_title }}" >
                </div>
                <div class="mb-3">
 <label for="aboutSection1Body" class="form-label">Content</label>
      <textarea id="aboutSection1Body" name="section1_body" class="form-control" rows="4">{{ $about->section1_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 2</h6>
                <div class="form-group mb-3">
 <label for="aboutSection2Title" class="form-label">Title</label>
      <input type="text" id="aboutSection2Title" name="section2_title" class="form-control" value="{{ $about->section2_title }}" >
                </div>
                <div class="mb-3">
 <label for="aboutSection2Body" class="form-label">Content</label>
      <textarea id="aboutSection2Body" name="section2_body" class="form-control" rows="4">{{ $about->section2_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 3</h6>
                <div class="form-group mb-3">
 <label for="aboutSection3Title" class="form-label">Title</label>
      <input type="text" id="aboutSection3Title" name="section3_title" class="form-control" value="{{ $about->section3_title }}" >
                </div>
                <div class="mb-3">
 <label for="aboutSection3Body" class="form-label">Content</label>
      <textarea id="aboutSection3Body" name="section3_body" class="form-control" rows="4">{{ $about->section3_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 4</h6>
                <div class="form-group mb-3">
 <label for="aboutSection4Title" class="form-label">Title</label>
      <input type="text" id="aboutSection4Title" name="section4_title" class="form-control" value="{{ $about->section4_title }}" >
                </div>
                <div class="mb-3">
 <label for="aboutSection4Body" class="form-label">Content (one item per line for list)</label>
      <textarea id="aboutSection4Body" name="section4_body" class="form-control" rows="4">{{ $about->section4_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 5</h6>
                <div class="form-group mb-3">
 <label for="aboutSection5Title" class="form-label">Title</label>
      <input type="text" id="aboutSection5Title" name="section5_title" class="form-control" value="{{ $about->section5_title }}" >
                </div>
                <div class="mb-3">
 <label for="aboutSection5Body" class="form-label">Content</label>
      <textarea id="aboutSection5Body" name="section5_body" class="form-control" rows="4">{{ $about->section5_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 6</h6>
                <div class="form-group mb-3">
 <label for="aboutSection6Title" class="form-label">Title</label>
      <input type="text" id="aboutSection6Title" name="section6_title" class="form-control" value="{{ $about->section6_title }}" >
                </div>
                <div class="mb-3">
 <label for="aboutSection6Body" class="form-label">Content</label>
      <textarea id="aboutSection6Body" name="section6_body" class="form-control" rows="4">{{ $about->section6_body }}</textarea>
                </div>

	 <button type="submit" class="btn btn-primary me-2">Save Changes</button>
			 
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
        $('#aboutLogo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showLogo').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
 
@endsection
