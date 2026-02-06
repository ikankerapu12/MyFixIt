 @php
$technicians = App\Models\User::where('status','active')->where('role','technician')->orderBy('id','DESC')->limit(5)->get();
 @endphp
 <section class="team-section sec-pad centred bg-color-44">
            <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-1.png') }});"></div>
            <div class="auto-container">
                <div class="sec-title">
                    <h5>Our Technicians</h5>
                    <h2>Meet Our Excellent Technicians</h2>
                </div>
                <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">


  @foreach($technicians as $item)
    <div class="team-block-one">
        <div class="inner-box">
            <figure class="image-box"><img src="{{ (!empty($item->photo)) ? url('upload/technician_images/'.$item->photo) : url('upload/no_image.jpg') }}" alt="" style="width:370px; height:370px;" ></figure>
            <div class="lower-content">
                <div class="inner">
                     <h4><a href="{{ route('technician.details',$item->id) }}">{{ $item->name }}</a></h4>
                    <span class="designation">{{ $item->email }}</span>
                </div>
            </div>
        </div>
    </div>
     @endforeach    


                </div>
            </div>
        </section>