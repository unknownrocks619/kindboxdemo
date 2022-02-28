@extends("layouts.p")

@section("content")
    <!-- ==========explore Section start Here========== -->
    <section class="explore-section padding-top padding-bottom">
        <div class="container">
            <div class="section-header">
                <div class="nft-search">
                    <div class="form-floating nft-search-input">
                        <form action="{{ route('search') }}" method="get">
                            <input name="term" type="text" class="form-control" id="nftSearch" placeholder="Search Author">
                            <label for="nftSearch">Search Author</label>
                            <button type="submit"> <i class="icofont-search-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="section-wrapper">
                <div class="explore-wrapper">
                    <div class="row justify-content-center g-4">
                        @foreach ($project_search as $project)
                            <div class="col-xl-6 col-lg-6 col-sm-12">
                                <div class="nft-item style-2">
                                    <div class="nft-inner">
                                        <div class="nft-thumb">
                                            @if ($project->featured_image) 
                                            <img loading="lazy" src="{{ asset ($project->uploaded_image->path) }}" alt="nft-img">
                                            @else
                                            <img loading="lazy" src="{{ asset ('guest/assets/images/nft-item/style-2/01.jpg') }}" alt="nft-img">
                                            @endif
                                        </div>
                                        <div class="nft-content mt-4">
                                            <div class="author-details">
                                                <h5><a href="{{ route('projects.public_project_detail',[$project->id,$project->slug]) }}">{{ $project->project_title }}</a> </h5>
                                                <p>

                                                @php
                                                    $short_description = strip_tags(htmlspecialchars_decode($project->description));
                                                    echo substr($short_description,0,150);
                                                @endphp
                                                </p>
                                                <p class="nft-price yellow-color border border-top bg-info text-white">
                                                    AUD {{ number_format($project->total_collected,2) }} of AUD {{ number_format($project->total_budget,2) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row gy-5 flex-row-reverse">

                    <div class="col-lg-12">
                        <div class="explore-wrapper">
                            <div class="row g-3">
                                @foreach ($product_search as $product)
                                    <div class="col-xl-6 col-md-6">
                                        <div class="nft-item">
                                            <div class="nft-inner">
                                                
                                                <!-- nft-bottom part -->
                                                <div class="nft-item-bottom">
                                                    <div class="nft-thumb">
                                                        @if($product->featured_image)
                                                            <img src="{{ asset ($product->featured->path) }}" alt="nft-img">
                                                        @else
                                                            <img src="{{ asset ('guest/assets/images/nft-item/03.gif') }}" alt="nft-img">
                                                        @endif
                                                    </div>
                                                    <div class="nft-content">
                                                        <div class="content-title">
                                                            <h5><a href="{{ route('shop.product_detail',[$product->id,$product->slug]) }}">{{ $product->product_name }}</a>
                                                            </h5>
                                                        </div>

                                                        <div
                                                            class="nft-status d-flex flex-wrap justify-content-between align-items-center ">
                                                            <span class="nft-view"><a href="{{ route('shop.product_detail',[$product->id,$product->slug]) }}">
                                                                    @php
                                                                        $description = strip_tags(htmlspecialchars_decode($product->product_full_description));
                                                                        $short_description = substr($description,0,250);
                                                                    @endphp
                                                                    {{ $short_description }}
                                                                    
                                                                    </a> </span>
                                                            <div class="nft-stock text-right">

                                                                @if($product->available_quantity)
                                                                    <span class="text-success text-right">
                                                                    {{ $product->available_quantity }} In Stock

                                                                    </span>
                                                                @else
                                                                    <span class="text-danger">Out of Stock</span>
                                                                @endif

                                                            </div>
                                                        </div>
                                                        <div
                                                            class="price-like d-flex justify-content-between align-items-center">
                                                            <div class="nft-price d-flex align-items-center">
                                                                
                                                                <p>Price: AUD {{number_format($product->item_price,0)}}
                                                                </p>
                                                            </div>

                                                            <a href="{{ route('shop.product_detail',[$product->id,$product->slug]) }}" class="nft-bid">View Product</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
             
                </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ==========explore Section ends Here========== -->


@endsection