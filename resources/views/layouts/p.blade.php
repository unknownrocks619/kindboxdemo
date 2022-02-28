<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Kindbox">
    <meta name="description" content="Kindbox croundfunding website">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ====== All css file ========= -->
    <link rel="stylesheet" href="{{ asset('guest/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('guest/assets/css//icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('guest/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset ('guest/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('guest/assets/css/style.css') }}">

    @yield("css")
    <!-- site title -->
    <title>Kindbox</title>
</head>

<body class="home-5">
    <!-- preloader start here -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- preloader ending here -->



    <!-- ===============// header section start here \\================= -->
    <header class="header">
        <div class="container-fluid">
            <div class="header__content">
                <div class="header__logo">
                    <a href="/">
                        <img src="https://kindbox.com/wp-content/uploads/kindbox-logo-black.png.webp" alt="logo">
                    </a>
                </div>

                <form action="#" class="header__search">
                    <input type="text" placeholder="Search project or product">
                    <button type="button"><i class="icofont-search-2"></i></button>
                    <button type="button" class="close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M13.41,12l6.3-6.29a1,1,0,1,0-1.42-1.42L12,10.59,5.71,4.29A1,1,0,0,0,4.29,5.71L10.59,12l-6.3,6.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l6.29,6.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z" />
                        </svg></button>
                </form>
                <div class="header__menu ms-auto">
                    <ul class="header__nav mb-0">
                        <li class="header__nav-item">
                            <a class="header__nav-link active" href="{{ route('shop.shop_index') }}">Shop</a>

                        </li>
                        <li class="header__nav-item">
                            <a class="header__nav-link" href="{{ route('projects.public_project_list') }}" >Projects</a>
                        </li>
                        <li class="header__nav-item">
                            <a class="header__nav-link" href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" data-bs-offset="0,10">About</a>

                            <ul class="dropdown-menu header__nav-menu">
                                <li><a class="drop-down-item" href="{{ route('static.why_kindbox') }}">Our Why</a></li>
                                <li><a class="drop-down-item" href="{{ route('static.giving_back') }}">Giving Back</a></li>
                                <li><a class="drop-down-item" href="{{ route('static.team') }}">Team</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="header__actions">
                    <div class="header__action header__action--search">
                        <button class="header__action-btn" type="button"><i class="icofont-search-1"></i></button>
                    </div>

                    <div class="wallet-btn">
                        <a href="{{ route('shop.cart') }}">
                            <span><i class="icofont-cart-alt" data-blast="color"></i></span>
                            <span class="d-none d-md-inline">
                                @if(session()->has("cart") )
                                        {{ count(session()->get("cart")) }}
                                    @else
                                        Empty
                                @endif
                            </span> 
                        </a>
                    </div>

                </div>

                <button class="menu-trigger header__btn" id="menu05">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>
    <!-- ===============//header section end here \\================= -->

    @yield("content")


    <!-- ===============//footer section start here \\================= -->
    <footer class="footer-section">
        <div class="footer-top" style="background-image: url(assets/images/footer/bg.jpg);">
            <div class="footer-newsletter">
                <div class="container">
                    <div class="row g-4 align-items-center justify-content-center">
                        <div class="col-lg-6">
                            <div class="newsletter-part">
                                <div class="ft-header">
                                    <h4>Get The Latest Anftiz Updates</h4>
                                </div>
                                <form action="#">
                                    <input type="email" placeholder="Your Mail Address">
                                    <button type="submit"> Subscribe now</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="social-part ps-lg-5">
                                <div class="ft-header">
                                    <h4>Join the Community</h4>
                                </div>
                                <ul class="social-list d-flex flex-wrap align-items-center mb-0">
                                    <li class="social-link"><a href="#"><i class="icofont-twitter"></i></a></li>
                                    <li class="social-link"><a href="#"><i class="icofont-twitch"></i></a></li>
                                    <li class="social-link"><a href="#"><i class="icofont-reddit"></i></a></li>
                                    <li class="social-link"><a href="#"><i class="icofont-instagram"></i></a></li>
                                    <li class="social-link"><a href="#"><i class="icofont-dribble"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="footer-links padding-top padding-bottom">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-link-item">
                                <h5>About</h5>
                                <ul class="footer-link-list">
                                    <li><a href="#" class="footer-link">Explore</a></li>
                                    <li><a href="#" class="footer-link">How it works</a></li>
                                    <li><a href="#" class="footer-link">Support</a></li>
                                    <li><a href="#" class="footer-link">Become a partner</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-link-item">
                                <h5>Company</h5>
                                <ul class="footer-link-list">
                                    <li><a href="#" class="footer-link">About</a></li>
                                    <li><a href="#" class="footer-link">Mission & Team</a></li>
                                    <li><a href="#" class="footer-link">Our Blog</a></li>
                                    <li><a href="#" class="footer-link">Services</a></li>
                                    <li><a href="#" class="footer-link">We're Hiring</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-link-item">
                                <h5>NFT Marketplace</h5>
                                <ul class="footer-link-list">
                                    <li><a href="#" class="footer-link">Sell your assets</a></li>
                                    <li><a href="#" class="footer-link">FAQ</a></li>
                                    <li><a href="#" class="footer-link">Support</a></li>
                                    <li><a href="#" class="footer-link">Privacy/Policy</a></li>
                                    <li><a href="#" class="footer-link">Your purchases</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-link-item">
                                <h5>Comunity</h5>
                                <ul class="footer-link-list">
                                    <li><a href="#" class="footer-link">NFT Token</a></li>
                                    <li><a href="#" class="footer-link">Discusion</a></li>
                                    <li><a href="#" class="footer-link">Voting</a></li>
                                    <li><a href="#" class="footer-link">Suggest Feature</a></li>
                                    <li><a href="#" class="footer-link">Language</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="text-center py-4 mb-0">All rights reserved &copy; Anftiz || Design By: <a
                        href="https://themeforest.net/user/labartisan/portfolio">Labartisan</a>
                </p>
            </div>
        </div>
    </footer>
    <!-- ===============//footer section end here \\================= -->



    <!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="icofont-swoosh-up"></i></a>
    <!-- scrollToTop ending here -->




    <!-- All Scripts -->
    <script src="{{ asset ('guest/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset ('guest/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset ('guest/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset ('guest/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset ('guest/assets/js/countdown.min.js') }}"></script>
    <script src="{{ asset ('guest/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset ('guest/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset ('guest/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset ('guest/assets/js/functions.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("form#add_cart_form").submit(function(event){
            event.preventDefault();

            $.ajax({
                type : "POST",
                data: $(this).serializeArray(),
                url : $(this).attr("action"),
                success : function (response) {
                    if (response.success == true) {

                        // location.reload();
                        Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Cool'
                        })
                    }
                }
            })
        })
    </script>
    @yield("js")
</body>

</html>