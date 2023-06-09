<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Ogani | Template</title>
    <link rel="icon" href="{{ asset('/img/link-logo.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('csery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <script src="https://kit.fontawesome.com/42ee89e4a1.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <?php
    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/', $link);
    $nameURL = end($link_array);
    ?>
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('/img/logo.png') }}" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                @if (Auth::guest())
                    <li><a onclick="alert('To view transaction history, please login to your account')"
                            href="{{ url('/login') }}"><i class="fa fa-history"></i>
                    </li>
                @else
                    <li><a href="{{ route('transactionHistory') }}"><i class="fa fa-history"></i></a>
                    </li>
                @endif

                <li><a href="{{ route('shoppingCart') }}"><i class="fa fa-shopping-bag"></i>
                        @if (Session::has('cart'))
                            <span>{{ Session::get('cart')->totalQty }}</span>
                        @else
                            <span>0</span>
                        @endif
                    </a>
                </li>
            </ul>
            @if (Session::has('cart'))
                <div class="header__cart__price">item:
                    <span>${{ Session::get('cart')->totalPrice }}</span>
                </div>
            @else
                <div class="header__cart__price">item: <span>$0</span></div>
            @endif
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="{{ asset('/img/language.png') }}" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block d-flex">
                        @auth
                            <a href="{{ url('/profile') }}"
                                class="login-mb text-sm text-gray-700 underline">{{ Auth::user()->name }}</a>
                            <a style="display: inline; padding-left: 5px;" href="{{ route('logout') }}">
                                Logout</i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                            @endif
                    @endif
                </div>
                @endif
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li <?php if ($nameURL == "index.php") { ?> class="active" <?php } ?>><a href="{{ url('/') }}">Home</a>
                </li>
                <li <?php if ($nameURL == "shop-grid") { ?> class="active" <?php } ?>><a href="{{ url('/shop-grid') }}">Shop</a></li>
                <li <?php if ($nameURL == "about-us") { ?> class="active" <?php } ?>><a href="{{ url('/about-us') }}">About Us</a>
                </li>
                <li <?php if ($nameURL == "contact") { ?> class="active" <?php } ?>><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> Backend2.2022@gmail.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
        </div>
        <!-- Humberger End -->

        <!-- Header Section Begin -->
        <header class="header">
            <div class="header__top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="header__top__left">
                                <ul>
                                    <li><i class="fa fa-envelope"></i> Backend2.2023@gmail.com</li>
                                    <li>Free Shipping for all Order of $99</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="header__top__right d-flex">
                                <div class="header__top__right__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                </div>
                                <div class="header__top__right__language">
                                    <img src="img/language.png" alt="">
                                    <div>English</div>
                                    <span class="arrow_carrot-down"></span>
                                    <ul>
                                        <li><a href="#">Spanis</a></li>
                                        <li><a href="#">English</a></li>
                                    </ul>
                                </div>
                                <div class="header__top__right__auth d-flex">
                                    @if (Route::has('login'))
                                        @auth
                                            <a href="{{ url('/profile') }}"
                                                class="text-sm text-gray-700 dark:text-gray-500 underline">{{ Auth::user()->name }}</a>
                                            <a style="display: inline; padding-left: 5px;" href="{{ route('logout') }}">
                                                <i class="fa fa-btn fa-sign-out"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}"
                                                class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                                                in</a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}"
                                                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                            @endif
                                        @endauth
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="header__logo">
                            <a href="{{ url('/') }}"><img src="{{ asset('/img/logo.png') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <nav class="header__menu">
                            <ul>
                                <li <?php if ($nameURL == "index.php") { ?> class="active" <?php } ?>><a
                                        href="{{ url('/') }}">Home</a></li>
                                <li <?php if ($nameURL == "shop-grid") { ?> class="active" <?php } ?>><a
                                        href="{{ url('/shop-grid') }}">Shop</a></li>
                                <li <?php if ($nameURL == "about-us") { ?> class="active" <?php } ?>><a
                                        href="{{ url('/about-us') }}">About Us</a></li>
                                <li <?php if ($nameURL == "contact") { ?> class="active" <?php } ?>><a
                                        href="{{ url('/contact') }}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3" id="change-item-cart">
                        <div class="header__cart">
                            <ul>
                                @if (Auth::guest())
                                    <li><a onclick="alert('To view transaction history, please login to your account')"
                                            href="{{ url('/login') }}"><i class="fa fa-history"></i>
                                    </li>
                                @else
                                    <li><a href="{{ route('transactionHistory') }}"><i class="fa fa-history"></i></a>
                                    </li>
                                @endif

                                <li><a href="{{ route('shoppingCart') }}"><i class="fa fa-shopping-bag"></i>
                                        @if (Session::has('cart'))
                                            <span>{{ Session::get('cart')->totalQty }}</span>
                                        @else
                                            <span>0</span>
                                        @endif
                                    </a>
                                </li>
                            </ul>
                            <!-- Start display price -->
                            @if (Session::has('cart'))
                                <div class="header__cart__price">item:
                                    <span>${{ Session::get('cart')->totalPrice }}</span>
                                </div>
                            @else
                                <div class="header__cart__price">item: <span>$0</span></div>
                            @endif
                            <!-- End display price -->
                        </div>
                        <!-- End add to cart -->
                    </div>
                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>
        <!-- Header Section End -->

        <!-- Hero Section Begin -->
        <section class="hero <?php if ($nameURL != 'index.php') {
            echo 'hero-normal';
        } ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="hero__categories">
                            <div class="hero__categories__all">
                                <i class="fa fa-bars"></i>
                                <span>All departments</span>
                            </div>
                            <ul>
                                <li><a href="{{ url('shop-grid') }}">All Categories</a></li>
                                @foreach ($getProtypes as $value)
                                    <?php $urlID = 'shop-grid/' . $value['id']; ?>
                                    <li><a href="{{ url($urlID) }}"><?php echo $value['name']; ?></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="hero__search">
                            <div class="hero__search__form">
                                <form action="{{ route('search') }}" method="get">
                                    <input type="text" placeholder="What do you need?" name="key"
                                        value="@if (isset($_GET['key'])) {{ $_GET['key'] }} @endif">
                                    <button type="submit" class="site-btn">SEARCH</button>
                                </form>
                            </div>
                            <div class="hero__search__phone">
                                <div class="hero__search__phone__icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="hero__search__phone__text">
                                    <h5>0838970023</h5>
                                    <span>support 24/7 time</span>
                                </div>
                            </div>
                        </div>
                        <?php if ($nameURL == "index.php") {
                    ?>
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="d-block w-100" alt="...">
                                        <div class="hero__item set-bg" data-setbg="{{ asset('/img/hero/banner.jpg') }}">
                                            <div class="hero__text">
                                                <span>FRUIT FRESH</span>
                                                <h2>Vegetable <br />100% Organic</h2>
                                                <p>Free Pickup and Delivery Available</p>
                                                <a href="{{ url('shop-grid') }}" class="primary-btn">SHOP NOW</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="d-block w-100" alt="...">
                                        <div class="hero__item set-bg"
                                            data-setbg="{{ asset('/img/hero/bannerMeat.jpg') }}">
                                            <div class="hero__text">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="d-block w-100" alt="...">
                                        <div class="hero__item set-bg"
                                            data-setbg="{{ asset('/img/hero/bannerdrink.jpg') }}">
                                            <div class="hero__text">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="d-block w-100" alt="...">
                                        <div class="hero__item set-bg"
                                            data-setbg="{{ asset('/img/hero/banner-traicay.jpg') }}">
                                            <div class="hero__text">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                    } ?>
                        </div>
                    </div>
                </div>
        </section>
        <!-- Hero Section End -->

        @yield('content')


        <!-- Messenger Plugin chat Code -->
        <div id="fb-root"></div>

        <!-- Your Plugin chat code -->
        <div id="fb-customer-chat" class="fb-customerchat">
        </div>

        <script>
            var chatbox = document.getElementById('fb-customer-chat');
            chatbox.setAttribute("page_id", "100411846398322");
            chatbox.setAttribute("attribution", "biz_inbox");
        </script>

        <!-- Your SDK code -->
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml: true,
                    version: 'v16.0'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <!-- Footer Section Begin -->
        <footer class="footer spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer__about">
                            <div class="footer__about__logo">
                                <a href="{{ url('/') }}"><img src="{{ asset('/img/logo.png') }}"
                                        alt=""></a>
                            </div>
                            <ul>
                                <li>Address: <a class="text-dark" href="https://goo.gl/maps/XXX7zqQCaFKL9DoQ6"
                                        target="_blank">53 Võ Văn Ngân - Phường Linh Chiểu - Quận Thủ Đức - TP.HCM</a></li>
                                <li>Phone: 0838970023</li>
                                <li>Email: Backend2.2023@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                        <div class="footer__widget">
                            <h6>Useful Links</h6>
                            <ul>
                                <li><a href="{{ url('/about-us') }}">About Us</a></li>
                                <li><a href="{{ url('/contact') }}">Contact</a></li>
                                <li><a href="">My Account</a></li>
                            </ul>
                            <ul>
                                <li><a href="{{ route('shoppingCart') }}">Shopping Cart</a></li>
                                <li><a href="{{ url('/checkout') }}">Checkout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="footer__widget">
                            <h6>Join Our Newsletter Now</h6>
                            <p>Get E-mail updates about our latest shop and special offers.</p>
                            <form action="{{ route('email.store') }}" method="POST">
                                @csrf
                                <input type="email" name="email" placeholder="Enter your mail" required>
                                <button type="submit" class="site-btn">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer__copyright">
                            <div class="footer__copyright__text">
                                <p>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved | This template is made with <i
                                        class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                        target="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </p>
                            </div>
                            <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <!-- Js Plugins -->
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0"
            nonce="Sbxcw3Mm"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('/js/jquery.slicknav.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/js/mixitup.min.js') }}"></script>
        <script src="{{ asset('/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('/js/main.js') }}"></script>
        <script src="{{ asset('js/ajax.js') }}"></script>
        <script src="{{ asset('/js/price.js ') }}"></script>
        <script src="{{ asset('/js/sort.js ') }}"></script>
        <script src="{{ asset('/js/share.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
        @if (Session::has('alert-success'))
            <script>
                swal("Payment successful !", "{!! Session('alert-success') !!}", "success", {
                    button: "Continue Shopping"
                });
            </script>
        @endif

        @if (Session::has('receiveEmailSuccess'))
            <script>
                swal("Thank you for subscribing !", "{!! Session::get('receiveEmailSuccess') !!}", "success", {
                    button: "OK",
                })
            </script>
        @endif

        @if (Session::has('receiveEmailError'))
            <script>
                swal("Your email is already exits !", "{!! Session::get('receiveEmailError') !!}", "error", {
                    button: "OK",
                })
            </script>
        @endif

    </body>

    </html>
