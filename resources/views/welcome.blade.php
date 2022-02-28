@extends("layouts.p")
@section("content")
    <!-- ===============//banner section start here \\================= -->
    <section class="banner-section style-1" style="background-image:url(assets/images/banner/bg-3.jpg)">
        <div class="container">
            <div class="banner-wrapper">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-8">
                        <div class="banner-content text-center">
                            <h2 class="mb-5">Shop For
                                A Cause</h2>

                            <form action="{{ route('search') }}" method="get">
                                <div class="search-bar input-group mb-4">
                                    <input type="text" class="form-control" name="term" placeholder="Search Project Or Product..."
                                        aria-label="Search our help center" aria-describedby="help-search">
                                    <button class="btn btn-outline-secondary" type="submit" id="help-search">
                                        <i class="icofont-search-1"></i>
                                    </button>
                                </div>
                            </form>
                            <p>A shopping experience for those who care about changing the world</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===============>> banner section end here <<================= -->


    <!-- ===============//auction section start here \\================= -->
    <section class="auction-section padding-top padding-bottom">
        <div class="container">
            <div class="section-header">
                <h3 class="header-title">Featured Projects</h3>
                <div class="header-content">
                    <ul class="arrows d-flex flex-wrap align-items-center">
                        <li class="li arrow-left auction-prev"> <i class="icofont-rounded-left"></i> </li>
                        <li class="li arrow-right auction-next"> <i class="icofont-rounded-right"></i></li>
                    </ul>
                </div>
            </div>
            <div class="section-wrapper">
                <div class="auction-holder">
                    <div class="swiper-wrapper" id="project_content">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===============//auction section end here \\================= -->


    
    <!-- ===============//seller section start here \\================= -->
    <section class="seller-section pb-100">
        <div class="container">
            <div class="section-header">
                <h3 class="header-title">Organisations</h3>
                
            </div>
            <div class="section-wrapper">
                <div class="seller-wrapper">
                    <div class="row g-3" id="org_content">
                    </div>
                    <div class="row">
                        <!-- <div class="col-md-12">
                            <div class="text-center mt-5">
                                <a href="#" class="default-btn move-right"><span>Go To Rank</span></a>
                            </div>

                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===============//seller section end here \\================= -->

     <!-- ===============>> Artwork section start here <<================= -->
     <section class="artwork-section">
        <div class="container">
            <div class="section-header">
                <h3 class="header-title">Shop Now</h3>
                <div class="header-content">
                    <ul class="filter-group d-flex flex-wrap align-items-center">
                        <li class="li collection-filter">
                            <div class="select-wrapper arrow-blue" data-icon="&#xef29;">
                                <select class="form-select " aria-label="Collection select">
                                    <option selected>Every Product is Here For a Reason</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section-wrapper">
                <div class="row justify-content-center g-3" id="shop_content">
                </div>
            </div>
        </div>
    </section>
    <!-- ===============>> Artwork section end here <<================= -->


@endsection

@section("js")
    <script>
        $(document).ready(function() {
            $.ajax({
                type : "GET",
                url : "{{ route('d_partials.dash_project_load') }}",
                success: function (response) {
                    $("#project_content").html(response);
                }
            })
            $.ajax({
                type : "GET",
                url : "{{ route('d_partials.dash_org_load') }}",
                success: function (response) {
                    $("#org_content").html(response);
                }
            })
            $.ajax({
                type : "GET",
                url : "{{ route('d_partials.dash_product_load') }}",
                success: function (response) {
                    $("#shop_content").html(response);
                }
            })
        })
    </script>
@endsection