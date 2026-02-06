@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('title1')
  Admin Update Terms of Service | MyFixIt  
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

			<h6 class="card-title">Update Terms of Service</h6>

  <form id="myForm" method="POST" action="{{ route('update.terms.setting') }}" class="forms-sample">
				@csrf
  <input type="hidden" name="id" value="{{ $terms->id }}">

				<div class="form-group mb-3">
 <label for="termsTitle" class="form-label">Page Title</label>
	  <input type="text" id="termsTitle" name="title" class="form-control" value="{{ $terms->title }}" >
				</div>

                <div class="form-group mb-3">
 <label for="termsLastUpdated" class="form-label">Last Updated</label>
      <input type="date" id="termsLastUpdated" name="last_updated" class="form-control" value="{{ $terms->last_updated }}" >
                </div>

                    <div class="mb-3">
    <label for="termsIntro" class="form-label">Intro</label>
                        <textarea id="termsIntro" name="intro" class="form-control" rows="4">{{ $terms->intro }}</textarea>
                    </div>

                <h6 class="card-title mt-4">Section 1</h6>
                <div class="form-group mb-3">
 <label for="termsSection1Title" class="form-label">Title</label>
      <input type="text" id="termsSection1Title" name="section1_title" class="form-control" value="{{ $terms->section1_title }}" >
                </div>
                <div class="mb-3">
 <label for="termsSection1Body" class="form-label">Content</label>
      <textarea id="termsSection1Body" name="section1_body" class="form-control" rows="4">{{ $terms->section1_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 2</h6>
                <div class="form-group mb-3">
 <label for="termsSection2Title" class="form-label">Title</label>
      <input type="text" id="termsSection2Title" name="section2_title" class="form-control" value="{{ $terms->section2_title }}" >
                </div>
                <div class="mb-3">
 <label for="termsSection2Body" class="form-label">Content</label>
      <textarea id="termsSection2Body" name="section2_body" class="form-control" rows="4">{{ $terms->section2_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 3</h6>
                <div class="form-group mb-3">
 <label for="termsSection3Title" class="form-label">Title</label>
      <input type="text" id="termsSection3Title" name="section3_title" class="form-control" value="{{ $terms->section3_title }}" >
                </div>
                <div class="mb-3">
 <label for="termsSection3Body" class="form-label">Content</label>
      <textarea id="termsSection3Body" name="section3_body" class="form-control" rows="4">{{ $terms->section3_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 4</h6>
                <div class="form-group mb-3">
 <label for="termsSection4Title" class="form-label">Title</label>
      <input type="text" id="termsSection4Title" name="section4_title" class="form-control" value="{{ $terms->section4_title }}" >
                </div>
                <div class="mb-3">
 <label for="termsSection4Body" class="form-label">Content</label>
      <textarea id="termsSection4Body" name="section4_body" class="form-control" rows="4">{{ $terms->section4_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 5</h6>
                <div class="form-group mb-3">
 <label for="termsSection5Title" class="form-label">Title</label>
      <input type="text" id="termsSection5Title" name="section5_title" class="form-control" value="{{ $terms->section5_title }}" >
                </div>
                <div class="mb-3">
 <label for="termsSection5Body" class="form-label">Content</label>
      <textarea id="termsSection5Body" name="section5_body" class="form-control" rows="4">{{ $terms->section5_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 6</h6>
                <div class="form-group mb-3">
 <label for="termsSection6Title" class="form-label">Title</label>
      <input type="text" id="termsSection6Title" name="section6_title" class="form-control" value="{{ $terms->section6_title }}" >
                </div>
                <div class="mb-3">
 <label for="termsSection6Body" class="form-label">Content</label>
      <textarea id="termsSection6Body" name="section6_body" class="form-control" rows="4">{{ $terms->section6_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 7</h6>
                <div class="form-group mb-3">
 <label for="termsSection7Title" class="form-label">Title</label>
      <input type="text" id="termsSection7Title" name="section7_title" class="form-control" value="{{ $terms->section7_title }}" >
                </div>
                <div class="mb-3">
 <label for="termsSection7Body" class="form-label">Content</label>
      <textarea id="termsSection7Body" name="section7_body" class="form-control" rows="4">{{ $terms->section7_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 8</h6>
                <div class="form-group mb-3">
 <label for="termsSection8Title" class="form-label">Title</label>
      <input type="text" id="termsSection8Title" name="section8_title" class="form-control" value="{{ $terms->section8_title }}" >
                </div>
                <div class="mb-3">
 <label for="termsSection8Body" class="form-label">Content</label>
      <textarea id="termsSection8Body" name="section8_body" class="form-control" rows="4">{{ $terms->section8_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 9</h6>
                <div class="form-group mb-3">
 <label for="termsSection9Title" class="form-label">Title</label>
      <input type="text" id="termsSection9Title" name="section9_title" class="form-control" value="{{ $terms->section9_title }}" >
                </div>
                <div class="mb-3">
 <label for="termsSection9Body" class="form-label">Content</label>
      <textarea id="termsSection9Body" name="section9_body" class="form-control" rows="4">{{ $terms->section9_body }}</textarea>
                </div>

                <h6 class="card-title mt-4">Section 10</h6>
                <div class="form-group mb-3">
 <label for="termsSection10Title" class="form-label">Title</label>
      <input type="text" id="termsSection10Title" name="section10_title" class="form-control" value="{{ $terms->section10_title }}" >
                </div>
                <div class="mb-3">
 <label for="termsSection10Body" class="form-label">Content</label>
      <textarea id="termsSection10Body" name="section10_body" class="form-control" rows="4">{{ $terms->section10_body }}</textarea>
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
