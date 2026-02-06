   
   @php
$stype = App\Models\ServiceType::latest()->limit(5)->get();

@endphp

   <section class="category-section centred">
            <div class="auto-container">
                <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <ul class="category-list clearfix">
                        @foreach ($stype as $item)
                        @php
                            $service = App\Models\Service::where('stype_id',$item->id)->get();
                        @endphp
                        <li>
                            <div class="category-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="{{ $item->type_icon }}"></i></div>
                                    <h5><a href="{{ route('service.type',$item->id) }}">{{ $item->type_name }}</a></h5>
                                    <span>{{ count($service) }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach                        
                    </ul>
                    <div class="more-btn"><a href="{{ route('all.service.type') }}" class="theme-btn btn-one">All Categories</a></div>
                </div>
            </div>
        </section>

        <style>
            .category-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.category-block-one {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1 1 200px;  /* Equal flex sizing, but also set to a fixed height */
    height: 200px;  /* Set the fixed height */
    margin: 10px;  /* Add spacing between the items */
    background: #f7f7f7; /* Set background color */
    border-radius: 10px; /* Optional, for rounded corners */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional, for shadow effect */
}

.category-block-one .inner-box {
    text-align: center;
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;  /* Ensures content is centered */
    height: 100%; /* Ensure content fills the height */
}

.category-block-one .icon-box {
    font-size: 30px;
    margin-bottom: 10px;
}

.category-block-one h5 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 5px;
}

.category-block-one span {
    font-size: 18px;
    font-weight: bold;
    color: #666;
    margin-top: 10px;
}

.category-block-one .inner-box a {
    color: #333;
    text-decoration: none;
}

        </style>