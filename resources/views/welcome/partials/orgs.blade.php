@foreach ($all_orgs as $org )
    
<div class="col-xl-4 col-lg-6">
    <div class="seller-item">
        <div class="seller-inner">
            <div class="seller-part">
                <p class="assets-number">{{ $loop->iteration }}</p>
                <div class="assets-owner">
                    <div class="owner-thumb verified">
                        <a href="author.html" class="">
                            @if($org->featured_image)
                                <img src="{{ asset ($org->f_image->path) }}" alt="{{ $org->name }}" class="img img-circle" style="width:70px; height:70px;">
                            @else
                                <img src="{{ asset ('guest/assets/images/seller/collector-2.gif') }}" alt="{{ $org->name }}">
                            @endif
                        </a>
                    </div>
                    <div class="owner-content">
                        <h6><a href="author.html">{{ $org->name }}</a> </h6>
                    </div>
                </div>
            </div>
            <span class="badge rounded-pill bg-blue">View Detail</span>
        </div>
    </div>
</div>
@endforeach