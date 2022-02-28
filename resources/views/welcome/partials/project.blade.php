@foreach ($projects as $project)
    <div class="swiper-slide">
        <div class="nft-item">
            <div class="nft-inner">
                <!-- nft top part -->
                <div class="nft-item-top d-flex justify-content-between align-items-center">
                    <div class="author-part">
                        <ul class="author-list d-flex">
                            <li class="single-author d-flex align-items-center">
                                <h6><a href="author.html">{{ $project->project_org->name }}</a></h6>
                            </li>
                        </ul>
                    </div>
                    <div class="more-part">
                        <div class=" dropstart">
                            <a class=" dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                data-bs-offset="25,0">
                                <i class="icofont-flikr"></i>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><span>
                                            <i class="icofont-warning"></i>
                                        </span> View Detail </a>
                                </li>
                                <li><a class="dropdown-item" href="#"><span><i
                                                class="icofont-reply"></i></span> Fund Project</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- nft-bottom part -->
                <div class="nft-item-bottom">
                    <div class="nft-thumb">
                        @if($project->featured_image)
                            <img src="{{ asset ($project->uploaded_image->path) }}" alt="{{$project->project_title}}" />
                        @else
                            <img src="{{ asset ('guest/assets/images/nft-item/01.jpg') }}" alt="nft-img">
                        @endif

                        <!-- <span class="badge rounded-pill position-absolute"><i
                                class="icofont-heart"></i>
                            1.3k</span> -->
                    </div>
                    <div class="nft-content">
                        <div class="content-title">
                            <h5><a href="{{ route('projects.public_project_detail',[$project->id,$project->slug]) }}">{{ $project->project_title}}</a> </h5>
                        </div>

                        <div
                            class="nft-status d-flex flex-wrap justify-content-between align-items-center ">
                            <span class="nft-view">
                            <div class="progress">
                                @php
                                    if ($project->total_collected ) {

                                        $percentage = ($project->total_collected * 100) / $project->total_budget;
                                    } else {
                                        $percentage = 0;
                                    }
                                @endphp
                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $percentage }}%</div>
                            </div>
                                <a href="#"> AUD {{ number_format($project->total_collected,2) }}
                                    Raised
                                </a> 
                            </span>
                        </div>
                        <div class="price-like d-flex justify-content-between align-items-center">
                            <div class="nft-price d-flex align-items-center">
                                
                                <p>Required: AUD {{ number_format($project->total_budget,2) }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('shop.shop_index') }}" class="btn btn-block btn-sm btn-primary" style="width:100% !important">Fund Project</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
