<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
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
    </nav>
