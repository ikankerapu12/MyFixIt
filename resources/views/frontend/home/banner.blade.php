@php
$seksyens = App\Models\Seksyen::latest()->get();
$stypes = App\Models\ServiceType::latest()->get();

 @endphp
        
        
        <section class="banner-section" style="background-image: url({{ asset('frontend/assets/images/banner/banner-myfixit.jpg') }});">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="content-box centred">
                        <h2>Home Maintenance Services in Shah Alam</h2>
                        <p>Find reliable technicians for all your home repair needs, anytime.</p>
                    </div>
                    <div class="search-field">
                        <div class="tabs-box">
                            <div class="tabs-content info-group">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="inner-box">
                                        <div class="top-search">
                                            <form action="{{ route('service.search') }}" method="POST" class="search-form">
    @csrf
    <div class="row clearfix">
        <div class="col-lg-4 col-md-12 col-sm-12 column">
            <div class="form-group">
                <label>Search Service</label>
                <div class="field-input">
                    <i class="fas fa-search"></i>
                    <input type="search" name="search" placeholder="Search by Service Name" value="{{ old('search') }}">
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 column">
            <div class="form-group">
                <label>Seksyen</label>
                <div class="select-box">
                    <i class="far fa-compass"></i>
                    <select class="wide" name="seksyen">
                        <option data-display="Input Seksyen" value="">Select Seksyen</option>
                        @foreach($seksyens as $seksyen)
                            <option value="{{ $seksyen->seksyen_name }}" {{ old('seksyen') == $seksyen->seksyen_name ? 'selected' : '' }}>{{ $seksyen->seksyen_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 column">
            <div class="form-group">
                <label>Service Type</label>
                <div class="select-box">
                    <select name="stype_id" class="wide">
                        <option data-display="All Type" value="">Select Service Type</option>
                        @foreach($stypes as $type)
                            <option value="{{ $type->type_name }}" {{ old('stype_id') == $type->type_name ? 'selected' : '' }}>{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="search-btn">
        <button type="submit"><i class="fas fa-search"></i>Search</button>
    </div>
</form>

                                        </div>





                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>

                /* Make Nice Select dropdown scrollable */
.wide .list {
    max-height: 260px;      /* adjust if you want taller/shorter */
    overflow-y: auto;
}

/* Optional: smoother scrollbar (Chrome/Edge) */
.wide .list::-webkit-scrollbar {
    width: 6px;
}

.wide .list::-webkit-scrollbar-thumb {
    background-color: #c1c1c1;
    border-radius: 4px;
}

.wide .list::-webkit-scrollbar-track {
    background: transparent;
}

            </style>
        </section>