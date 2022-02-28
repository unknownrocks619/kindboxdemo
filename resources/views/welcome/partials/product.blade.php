@foreach ($products as $product)
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-9">
        <div class="nft-item">
            <div class="nft-inner">
                <!-- nft-bottom part -->
                <div class="nft-item-bottom">
                    <div class="nft-thumb">
                        @if($product->featured_image)
                            <img src="{{ asset ($product->featured->path) }}" alt="nft-img">

                        @else
                            <img src="{{ asset ('guest/assets/images/nft-item/01.jpg') }}" alt="nft-img">
                        @endif
                    </div>
                    <div class="nft-content">
                        <div class="content-title">
                            <h5><a href="{{ route('shop.product_detail',[$product->id,$product->slug]) }}">{{$product->product_name}}</a> </h5>
                        </div>

                        <div
                            class="nft-status d-flex flex-wrap justify-content-between align-items-center ">
                            <div class="nft-stock"> {{ $product->available_quantity }} in Stock</div>
                        </div>
                        <div class="price-like d-flex justify-content-between align-items-center">
                            <div class="nft-price d-flex align-items-center">
                               
                                <p>Price: AUD {{ number_format($product->item_price) }}
                                </p>
                            </div>

                            <a href="{{ route('shop.product_detail',[$product->id,$product->slug]) }}" class="nft-bid">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach