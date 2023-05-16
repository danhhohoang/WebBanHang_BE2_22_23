@extends('user.master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $getType[0]['name'] }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <?php $type_id = '/shop-grid/' . $getType[0]['id']; ?>
                            <a href="{{ url($type_id) }}">{{ $getType[0]['name'] }}</a>
                            <span><?php if (strlen($productDetail->name) > 40) {
                                echo substr($productDetail->name, 0, 40) . '...';
                            } else {
                                echo $productDetail->name;
                            } ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ URL::asset('/img/product/' . $productDetail->image1) }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{ URL::asset('/img/product/' . $productDetail->image1) }}"
                                src="{{ URL::asset('/img/product/' . $productDetail->image1) }}" alt="">
                            <img data-imgbigurl="{{ URL::asset('/img/product/' . $productDetail->image2) }}"
                                src="{{ URL::asset('/img/product/' . $productDetail->image2) }}" alt="">
                            <img data-imgbigurl="{{ URL::asset('/img/product/' . $productDetail->image3) }}"
                                src="{{ URL::asset('/img/product/' . $productDetail->image3) }}" alt="">
                            <img data-imgbigurl="{{ URL::asset('/img/product/' . $productDetail->image4) }}"
                                src="{{ URL::asset('/img/product/' . $productDetail->image4) }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ substr($productDetail->name, 0, 20) }}...</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">${{ $productDetail->price }}</div>
                        <p>{{ substr($productDetail->description, 0, 300) }}...</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input id="quantity-item-{{ $productDetail->id }}" type="number" min="1"
                                        oninput="validity.valid||(value='1');" onfocusout="myFunction(this)" value="1">
                                </div>
                            </div>
                        </div>
                        <script>
                            function myFunction(outHover) {
                                if (outHover.value == "") {
                                    outHover.value = "1";
                                }
                            }
                        </script>
                        <a onclick="AddCartMul({{ $productDetail->id }})" id="add-cart-item-{{ $productDetail->id }}"
                            href="javascript:" class="primary-btn">ADD TO CARD</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Description</h6>
                                    <p>{{ $productDetail->description }}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>{{ $productDetail->infomation }}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product__discount__slider owl-carousel">
                    @foreach ($getRelatedProduct as $value)
                        <?php
                        $img = '/img/product/' . $value->image1;
                        $id = '/shop-details/' . $value->product_id;
                        ?>
                        <div class="col-lg-4">
                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg" data-setbg="{{ asset($img) }}">
                                    <?php if ($value->sales > 0) :?>
                                    <div class="product__discount__percent">-{{ $value->sales }}%</div>
                                    <?php endif ?>
                                    <ul class="product__item__pic__hover">
                                        <li><a onclick="AddCart({{ $value->product_id }})" href="javascript:"><i
                                                    class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__discount__item__text">
                                    <span>{{ $value->name }}</span>
                                    <h5><a href="{{ URL($id) }}"><?php if (strlen($value->product_name) > 25) {
                                        echo substr($value->product_name, 0, 25) . '...';
                                    } else {
                                        echo $value->product_name;
                                    } ?></a>
                                    </h5>
                                    <div class="product__item__price">
                                        <?php if ($value->sales > 0) :
                                        $moneySales = $value['price'] * $value['sales'] / 100;
                                        $moneySales = $value['price'] - $moneySales;
                                    ?>
                                        $<?php echo number_format($moneySales, 2, '.', ''); ?><span>$<?php echo number_format($value['price'], 2, '.', ''); ?></span>
                                        <?php else : ?>
                                        $<?php echo number_format($value['price'], 2, '.', ''); ?>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    @if (Session::has('failed'))
        <script>
            swal("You have already rated this product !", "{!! session('alert-success') !!}", "warning", {
                button: "OK"
            });
        </script>
    @endif

    @if (Session::has('successful'))
        <script>
            swal("Rating successful !", "{!! session('alert-success') !!}", "success", {
                button: "OK"
            });
        </script>
    @endif
@endsection
