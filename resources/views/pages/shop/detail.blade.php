@extends("layouts.p")

@section("content")
 <!-- ==========Item Details Section start Here========== -->
 <div class="item-details-section padding-top padding-bottom">
        <div class="container">
            <div class="item-details-wrapper">
                <div class="row g-5">
                    <div class="col-lg-6">
                        <div class="item-desc-part">
                            <div class="item-desc-inner">
                                <div class="item-desc-thumb">
                                    <img src="{{ asset ($product->featured->path) }}" alt="item-img">
                                </div>
                                <div class="item-desc-content">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-details" type="button" role="tab"
                                                aria-controls="nav-details" aria-selected="true">Details</button>
                                            <button class="nav-link" id="nav-bids-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-bids" type="button" role="tab"
                                                aria-controls="nav-bids" aria-selected="false">Product Information</button>
                                            <button class="nav-link" id="nav-history-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-history" type="button" role="tab"
                                                aria-controls="nav-history" aria-selected="false">Remarks</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="details-tab tab-pane fade show active" id="nav-details"
                                            role="tabpanel" aria-labelledby="nav-details-tab">

                                            {!! $product->product_full_description !!}
                                        </div>
                                        <div class="bids-tab tab-pane fade" id="nav-bids" role="tabpanel"
                                            aria-labelledby="nav-bids-tab">
                                            <span><i class="icofont-law-order"></i></span>
                                            <div class="text-left" style="text-align: left;">
                                                <p><strong>How It Works</strong></p>
                                                <p>STEP ONE:&nbsp;Grab a bottle with a foaming pump and add 300ml of warm water to it.</p>
                                                <p>STEP TWO:&nbsp;Tip in the contents of one sachet, close and shake for 30 seconds.</p>
                                                <p>STEP THREE:&nbsp;Your hand wash is ready to use!</p>
                                            </div>
                                        </div>
                                        <div class="history-tab tab-pane fade" id="nav-history" role="tabpanel"
                                            aria-labelledby="nav-history-tab">
                                            <table class="woocommerce-product-attributes shop_attributes">
			<tbody><tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--weight">
			<th class="woocommerce-product-attributes-item__label">Weight</th>
			<td class="woocommerce-product-attributes-item__value">300 g</td>
		</tr>
			<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--dimensions">
			<th class="woocommerce-product-attributes-item__label">Dimensions</th>
			<td class="woocommerce-product-attributes-item__value">5 × 2 × 10 cm</td>
		</tr>
	</tbody></table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="item-buy-part">
                            <div class="nft-item-title">
                                <h3>#{{ strtoupper($product->product_code) }} {{ $product->product_name }}</h3>
                                <div class="share-btn">
                                    <div class=" dropstart">
                                        <a class=" dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false" data-bs-offset="25,0">
                                            <i class="icofont-share-alt"></i>
                                        </a>

                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><span>
                                                        <i class="icofont-twitter"></i>
                                                    </span> Twitter </a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"><span><i
                                                            class="icofont-telegram"></i></span> Telegram</a></li>
                                            <li><a class="dropdown-item" href="#"><span><i
                                                            class="icofont-envelope"></i></span> Email</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item-price">
                                <h4>Our Giving Model</h4>
                                <p>
                                Every product on our platform is here for a reason. And every purchase you make at Kindbox.com is supporting a project aligned with one or more of the United Nations Sustainable Development Goals for the world (SDG's).
A minimum of 50% of the profits from every item you buy from us is reinvested back into these projects. On checkout, tell us where you want us to send the money and help get us one step closer to a fairer world for all people and a healthier planet. Learn more about our giving model - click below.
<br />
<a id="link_text-647-89" class="" href="/faq" target="_self" style="text-decoration: underline;">Giving Model</a>
                                </p>
                            </div>
                            <div class="item-price">
                                <h4>Price</h4>
                                <p><span><i class="icofont-coins"></i> AUD {{ number_format($product->item_price,2) }}
                                    </span></p>
                            </div>
                            <div class="buying-btns d-flex flex-wrap">
                                <form id="add_cart_form" action="{{ route('shop.add_to_cart',[$product->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class='btn default-btn move-right'>
                                        <span>
                                            Add To Card
                                        </span>
                                    </button>
                                </form>
                                <!-- <a href="wallet.html" class="default-btn move-right"><span>Add To Card</span> </a> -->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========Item Details Section ends Here========== -->
@endsection