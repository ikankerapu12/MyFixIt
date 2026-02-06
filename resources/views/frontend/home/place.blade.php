 @php
    $skip_seksyen_0 = App\Models\Seksyen::skip(0)->first();
    $service_0 = App\Models\Service::where('seksyen',$skip_seksyen_0->id)->get();

    $skip_seksyen_1 = App\Models\Seksyen::skip(1)->first();
    $service_1 = App\Models\Service::where('seksyen',$skip_seksyen_1->id)->get();

    $skip_seksyen_2 = App\Models\Seksyen::skip(2)->first();
    $service_2 = App\Models\Service::where('seksyen',$skip_seksyen_2->id)->get();

    $skip_seksyen_3 = App\Models\Seksyen::skip(3)->first();
    $service_3 = App\Models\Service::where('seksyen',$skip_seksyen_3->id)->get();

 @endphp

<section class="feature-section sec-pad bg-color-1">
            <div class="auto-container">
                <div class="sec-title centred">
                    <h5>Top Services in Seksyen</h5>
                    <h2>Explore Seksyen in Shah Alam's Top Services</h2>
                    <p>Discover the most popular services available in various Seksyens of Shah Alam. Whether it's plumbing, electrical, or cleaning, find trusted technicians and services near you.</p>
                </div>
                <div class="sortable-masonry">
                    <div class="items-container row clearfix">


                            <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration brand marketing software">
        <div class="place-block-one">
            <div class="inner-box">
                <figure class="image-box"><img src="{{ asset($skip_seksyen_0->seksyen_image) }}" alt="" style="width:370px; height:580px;"></figure>
                <div class="text">
                    <h4><a href="{{ route('seksyen.details',$skip_seksyen_0->id) }}">{{ $skip_seksyen_0->seksyen_name }}</a></h4>
                    <p>{{ count($service_0) }} Services</p>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all brand illustration print software logo">
        <div class="place-block-one">
            <div class="inner-box">
                <figure class="image-box"><img src="{{ asset($skip_seksyen_1->seksyen_image) }}" alt="" style="width:370px; height:275px;"></figure>
                <div class="text">
                    <h4><a href="{{ route('seksyen.details',$skip_seksyen_1->id) }}">{{ $skip_seksyen_1->seksyen_name }}</a></h4>
                    <p>{{ count($service_1) }} Services</p>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration marketing logo">
        <div class="place-block-one">
            <div class="inner-box">
       <figure class="image-box"><img src="{{ asset($skip_seksyen_2->seksyen_image) }}" alt="" style="width:370px; height:275px;"></figure>
                <div class="text">
                    <h4><a href="{{ route('seksyen.details',$skip_seksyen_2->id) }}">{{ $skip_seksyen_2->seksyen_name }}</a></h4>
                    <p>{{ count($service_2) }} Services</p>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-8 col-md-6 col-sm-12 masonry-item small-column all brand marketing print software">
        <div class="place-block-one">
            <div class="inner-box">
                <figure class="image-box"><img src="{{ asset($skip_seksyen_3->seksyen_image) }}" alt="" style="width:770px; height:275px;"></figure>
                <div class="text">
                    <h4><a href="{{ route('seksyen.details',$skip_seksyen_3->id) }}">{{ $skip_seksyen_3->seksyen_name }}</a></h4>
                    <p>{{ count($service_3) }} Services</p>
                </div>
            </div>
        </div>
    </div>


                    </div>
                    <div class="more-btn centred" style="margin-top: 40px;">
    <a href="{{ route('all.seksyen.view') }}" class="theme-btn btn-one">
        View All Seksyen
    </a>
</div>
                </div>
            </div>
        </section>