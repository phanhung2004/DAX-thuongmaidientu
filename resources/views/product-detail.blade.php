@extends('layout')
@section('title')
    {{ $product->name }} | Techchain
@endsection
@section('content')
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ route('home') }}">Home</a>
                            <a
                                href="{{ route('page.category.list', $product->category) }}">{{ $product->category->name }}</a>
                            <span>{{ $product->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg"
                                        data-setbg="{{ asset('storage/' . $product->image) }}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-2.png">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-3.png">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-4.png">
                                        <i class="fa fa-play"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="img/shop-details/product-big-3.png" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="img/shop-details/product-big.png" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-4" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="img/shop-details/product-big-4.png" alt="">
                                    <a href="https://www.youtube.com/watch?v=8PJ3_p7VqHw&list=RD8PJ3_p7VqHw&start_radio=1"
                                        class="video-popup"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product->name }}</h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <h3>
                                @if ($product->sale_price)
                                    {{ number_format($product->sale_price) }} <u>đ</u>
                                    <span>{{ number_format($product->price) }}</span> <u>đ</u>
                                @else
                                    {{ number_format($product->price) }} <u>đ</u>
                                @endif

                            </h3>
                            <p>
                                {{ $product->material }}
                            </p>
                            <form action="" method="post">
                                @csrf
                                <div class="product__details__option">
                                    <div class="product__details__option__size">
                                        <span>Size:</span>
                                        @foreach ($sizes as $index => $size)
                                            <label for="size{{ $index }}">{{ $size }}
                                                <input type="radio" id="size{{ $index }}" name="size"
                                                    value="{{ $index }}">
                                            </label>
                                        @endforeach
                                    </div>
                                    <div class="product__details__option__size">
                                        <span>Color:</span>
                                        @foreach ($colors as $index => $color)
                                            <label for="color{{ $index }}">{{ $color }}
                                                <input type="radio" id="color{{ $index }}" name="color"
                                                    value="{{ $index }}">
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="product__details__cart__option">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" name="quantity">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add to cart</button>
                                </div>
                            </form>

                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                                <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="img/shop-details/details-payment.png" alt="">
                                <ul>
                                    <li><span>SKU:</span> {{ $product->code }}</li>
                                    <li><span>Categories:</span> {{ $product->category->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                        role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews(5)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                        information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    {{ $product->description }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">
                            <a href="{{ route('page.product.detail', $relatedProduct->slug) }}">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $relatedProduct->image) }}">
                                    <span class="label">New</span>
                                </div>
                            </a>
                            <div class="product__item__text">
                                <h6>{{ $relatedProduct->name }}</h6>
                                <a href="{{ route('page.product.detail', $relatedProduct->slug) }}" class="add-cart">+ Add To Cart</a>
                                <h5>{{ $relatedProduct->price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Section End -->
@endsection
