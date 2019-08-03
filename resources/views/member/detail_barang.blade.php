@extends('member.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/single_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/single_responsive.css') }}">
    <style>
        .margin-atas{
            margin-top: 0%;
        }
        .super_container{
            margin-top: -4% !important;
        }
    </style>
@endsection

@section('content')
    <div class="super-container">
        <div class="container single_product_container">
            <div class="row">
                <div class="col">

                    <!-- Breadcrumbs -->

                    <div class="breadcrumbs d-flex flex-row align-items-center">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="categories.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Men's</a></li>
                            <li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Single Product</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="single_product_pics">
                        <div class="row">
                            <div class="col-lg-3 thumbnails_col order-lg-1 order-2">
                                <div class="single_product_thumbnails">
                                    <ul>
                                        <li class="active"><img src="{{ url('images/barang/'.$barang->gambar) }}" alt="" data-image="{{ url('images/barang/'.$barang->gambar) }}"></li>
                                        {{-- <li class="active"><img src="images/single_2_thumb.jpg" alt="" data-image="images/single_2.jpg"></li>
                                        <li><img src="images/single_3_thumb.jpg" alt="" data-image="images/single_3.jpg"></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 image_col order-lg-2 order-1">
                                <div class="single_product_image">
                                    <div class="single_product_image_background" style="background-image:url('{{ url('images/barang/'.$barang->gambar) }}')"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="product_details">
                        <div class="product_details_title">
                            <h2>{{ $barang->nama_barang }}</h2>
                            <p>{{ $barang->keterangan }}</p>
                        </div>
                        <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                            <span class="ti-truck"></span><span>free delivery</span>
                        </div>
                        <div class="original_price"></div>
                        <div class="product_price"><sup>Rp</sup>{{ $barang->harga_barang }}</div>
                        {{-- <ul class="star_rating">
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                        </ul> --}}
                        <div class="product_color">
                            <span>Select Color:</span>
                            <ul>
                                <li style="background: #e54e5d"></li>
                                <li style="background: #252525"></li>
                                <li style="background: #60b3f3"></li>
                            </ul>
                        </div>
                        <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                            <span>Jumlah:</span>
                            <div class="quantity_selector">
                                <span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                <span id="quantity_value">1</span>
                                <span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                            <div class="product_favorite d-flex flex-column align-items-center justify-content-center"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/single_custom.js') }}"></script>
@endsection