@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('title1')
  Admin Update Privacy Policy | MyFixIt  
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

			<h6 class="card-title">Update Privacy Policy</h6>

  <form id="myForm" method="POST" action="{{ route('update.privacy.setting') }}" class="forms-sample">
				@csrf
  <input type="hidden" name="id" value="{{ $privacy->id }}">

				<div class="form-group mb-3">
 <label for="privacyTitle" class="form-label">Page Title</label>
	  <input type="text" id="privacyTitle" name="title" class="form-control" value="{{ $privacy->title }}" >
				</div>

                <div class="form-group mb-3">
 <label for="privacyLastUpdated" class="form-label">Last Updated</label>
      <input type="date" id="privacyLastUpdated" name="last_updated" class="form-control" value="{{ $privacy->last_updated }}" >
                </div>

                    <div class="mb-3">
    <label for="privacyIntro" class="form-label">Intro</label>
                        <textarea id="privacyIntro" name="intro" class="form-control" rows="4">{{ $privacy->intro }}</textarea>
                    </div>

                <h6 class="card-title mt-4">Section 1</h6>
                <div class="form-group mb-3">
 <label for="privacySection1Title" class="form-label">Title</label>
      <input type="text" id="privacySection1Title" name="section1_title" class="form-control" value="{{ $privacy->section1_title }}" >
                </div>
                <div class="mb-3">
 <label for="privacySection1Body" class="form-label">Content</label>
      <textarea id="privacySection1Body" name="section1_body" class="form-control" rows="4">{{ $privacy->section1_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 2</h6>
                <div class="form-group mb-3">
 <label for="privacySection2Title" class="form-label">Title</label>
      <input type="text" id="privacySection2Title" name="section2_title" class="form-control" value="{{ $privacy->section2_title }}" >
                </div>
                <div class="mb-3">
 <label for="privacySection2Body" class="form-label">Content</label>
      <textarea id="privacySection2Body" name="section2_body" class="form-control" rows="4">{{ $privacy->section2_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 3</h6>
                <div class="form-group mb-3">
 <label for="privacySection3Title" class="form-label">Title</label>
      <input type="text" id="privacySection3Title" name="section3_title" class="form-control" value="{{ $privacy->section3_title }}" >
                </div>
                <div class="mb-3">
 <label for="privacySection3Body" class="form-label">Content</label>
      <textarea id="privacySection3Body" name="section3_body" class="form-control" rows="4">{{ $privacy->section3_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 4</h6>
                <div class="form-group mb-3">
 <label for="privacySection4Title" class="form-label">Title</label>
      <input type="text" id="privacySection4Title" name="section4_title" class="form-control" value="{{ $privacy->section4_title }}" >
                </div>
                <div class="mb-3">
 <label for="privacySection4Body" class="form-label">Content</label>
      <textarea id="privacySection4Body" name="section4_body" class="form-control" rows="4">{{ $privacy->section4_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 5</h6>
                <div class="form-group mb-3">
 <label for="privacySection5Title" class="form-label">Title</label>
      <input type="text" id="privacySection5Title" name="section5_title" class="form-control" value="{{ $privacy->section5_title }}" >
                </div>
                <div class="mb-3">
 <label for="privacySection5Body" class="form-label">Content</label>
      <textarea id="privacySection5Body" name="section5_body" class="form-control" rows="4">{{ $privacy->section5_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 6</h6>
                <div class="form-group mb-3">
 <label for="privacySection6Title" class="form-label">Title</label>
      <input type="text" id="privacySection6Title" name="section6_title" class="form-control" value="{{ $privacy->section6_title }}" >
                </div>
                <div class="mb-3">
 <label for="privacySection6Body" class="form-label">Content</label>
      <textarea id="privacySection6Body" name="section6_body" class="form-control" rows="4">{{ $privacy->section6_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 7</h6>
                <div class="form-group mb-3">
 <label for="privacySection7Title" class="form-label">Title</label>
      <input type="text" id="privacySection7Title" name="section7_title" class="form-control" value="{{ $privacy->section7_title }}" >
                </div>
                <div class="mb-3">
 <label for="privacySection7Body" class="form-label">Content</label>
      <textarea id="privacySection7Body" name="section7_body" class="form-control" rows="4">{{ $privacy->section7_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 8</h6>
                <div class="form-group mb-3">
 <label for="privacySection8Title" class="form-label">Title</label>
      <input type="text" id="privacySection8Title" name="section8_title" class="form-control" value="{{ $privacy->section8_title }}" >
                </div>
                <div class="mb-3">
 <label for="privacySection8Body" class="form-label">Content</label>
      <textarea id="privacySection8Body" name="section8_body" class="form-control" rows="4">{{ $privacy->section8_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 9</h6>
                <div class="form-group mb-3">
 <label for="privacySection9Title" class="form-label">Title</label>
      <input type="text" id="privacySection9Title" name="section9_title" class="form-control" value="{{ $privacy->section9_title }}" >
                </div>
                <div class="mb-3">
 <label for="privacySection9Body" class="form-label">Content</label>
      <textarea id="privacySection9Body" name="section9_body" class="form-control" rows="4">{{ $privacy->section9_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 10</h6>
                <div class="form-group mb-3">
 <label for="privacySection10Title" class="form-label">Title</label>
      <input type="text" id="privacySection10Title" name="section10_title" class="form-control" value="{{ $privacy->section10_title }}" >
                </div>
                <div class="mb-3">
 <label for="privacySection10Body" class="form-label">Content</label>
      <textarea id="privacySection10Body" name="section10_body" class="form-control" rows="4">{{ $privacy->section10_body }}</textarea>
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
 
@endsection
