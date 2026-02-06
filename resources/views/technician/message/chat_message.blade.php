@extends('technician.technician_dashboard')
@section('technician')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@section('title2')
  Technician Chat Message | MyFixIt  
@endsection
<div class="page-content">

       
        <div class="row profile-body">
        
          <!-- middle wrapper start -->
          <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
             <div class="card">
              <div class="card-body">

			<h6 class="card-title">Technician Chat Message </h6>

 <div id="app">
 <chat-message></chat-message>
 </div>



			 

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