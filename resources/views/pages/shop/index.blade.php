@extends("layouts.p")

@section("content")
    <!-- ==========Page Header Section Start Here========== -->
    <section class="page-header-section style-1" style="background-image: url('https://kindbox.com/wp-content/uploads/happy-children-shopping-with-kindness-1920.jpeg.webp');">
        <div class="container">
            <div class="page-header-content">
                <div class="page-header-inner">
                    <div class="page-title">
                        <h2>Explore All NFT's </h2>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Explore</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Page Header Section Ends Here========== -->

    <!-- ==========explore Section start Here========== -->
    <section class="explore-section padding-top padding-bottom">
        <div class="container">
            <div class="section-wrapper">
                <div class="row gy-5 flex-row-reverse">

                    <div class="col-lg-12">
                        <div class="explore-wrapper">
                            <div class="row g-3">
                                @foreach ($products as $product)
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
                            <div class="text-center mt-5">
                                <a href="javascript:void(0);" class="default-btn move-bottom"><span>Load More</span>
                                </a>
                            </div>
                        </div>
                    </div>
             
                </div>
            </div>
        </div>
    </section>
    <!-- ==========explore Section ends Here========== -->

@endsection