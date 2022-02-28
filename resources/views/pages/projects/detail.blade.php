@extends("layouts.p")

@section("content")
 <!-- ==========Page Header Section Start Here========== -->
 <section class="page-header-section style-1" style="background-image: url('{{ asset ($project->uploaded_image->path) }}');">
        <div class="container">
            <div class="page-header-content">
                <div class="page-header-inner">
                    <div class="page-title">
                        <h2 class="text-white">{{ $project->project_title }} </h2>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li>
                            <a href="{{ route('projects.public_project_list') }}">
                                Projects
                            </a>    
                        </li>
                        <li class="active">
                            {{ $project->project_title }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Page Header Section Ends Here========== -->

       <!-- ==========Blog Section start Here========== -->
       <section class="blog-section padding-top padding-bottom">
        <div class="container">
            <div class="main-blog">
                <div class="row g-5 flex-xl-row-reverse">
                    <div class="col-xl-12 col-12">
                        <div class="blog-wrapper">
                            <div class="post-item">
                                <div class="post-item-inner">
                                    <div class="post-thumb">
                                        @if($project->featured_image)
                                            <!-- <img src="{{-- asset($project->uploaded_image->path) --}}" alt="blog"> -->
                                        @else
                                            <!-- <img src="{{-- asset('guest/assets/images/blog/01.gif') --}}" alt="blog"> -->
                                        @endif
                                    </div>
                                    <div class="post-content">
                                        <div class="tags-section">
                                            <ul class="tags" style="width:100%">
                                                <li style="width:50%" class="text-white bg-warning text-lg">
                                                    <a style="width:100%;font-size:21px;" href="#" class='text-lg text-white text-center'>Collected: AUD {{ number_format($project->total_collected,2) }}</a>
                                                </li>
                                                <li style="width:50%" class="text-white bg-danger text-lg">
                                                    <a style="width:100%;font-size:21px;" href="#" class='text-lg text-white text-center'>Total Budget: AUD {{ number_format($project->total_budget,2) }}</a>
                                                </li>
                                            </ul>

                                        </div>
                                        <h3>{{$project->project_title}}</h3>
                                        {!! $project->description !!}
                                        @if( $project->map_link)
                                            <img src='https://kindbox.com/wp-content/uploads/map-pakistan-1024x205.jpg' width="100%" />
                                        @elseif($project->map_embed)
                                           {!! $project->map_embed !!}
                                        @endif

                                        @if($project->images)
                                            <div class="row mt-3">
                                                @foreach ($project->images as $image)
                                                    @php
                                                        $file = json_decode($image->file);
                                                    @endphp
                                                    <div class="col-md-6 border border-success">
                                                        <img src="{{ asset ($file->path) }}" class="img img-responsive" alt="">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tags-section">
                                        <ul class="tags" style="width:100%">
                                            <li style="width:100%">
                                                <a href="#" style="width:100%">
                                                @php
                                                    if ($project->total_collected ) {

                                                        $percentage = ($project->total_collected * 100) / $project->total_budget;
                                                    } else {
                                                        $percentage = 0;
                                                    }
                                                @endphp
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $percentage }}%</div>
                                                </div>
                                                <strong class='text-center mt-3'>{{ $project->total_collected }} collected of {{ $project->total_budget }}</strong>

                                            </li>
                                        </ul>
                                       
                                    </div>
                                    <div class="tags-section">
                                        <ul class="social-link-list d-flex flex-wrap">
                                                <li><a href="#" class="facebook"><i class="icofont-facebook"></i></a></li>
                                                <li><a href="#" class="dribble"><i class="icofont-dribble"></i></a></li>
                                                <li><a href="#" class="twitter"><i class="icofont-twitter"></i></a></li>
                                                <li><a href="#" class="linkedin"><i class="icofont-linkedin"></i></a></li>
                                            </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Blog Section ends Here========== -->
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
@endsection
@section("js")
<script>
    $(document).ready(function() {
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