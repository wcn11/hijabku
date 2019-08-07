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
        .btn-keluarkan{
            display: none;
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
                        {{-- <div class="product_color">
                            <span>Select Color:</span>
                            <ul>
                                <li style="background: #e54e5d"></li>
                                <li style="background: #252525"></li>
                                <li style="background: #60b3f3"></li>
                            </ul>
                        </div> --}}
                        <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                            {{-- <span>Jumlah:</span>
                            
                                <div type="text" class="container-jumlah-{{ $k->kode_keranjang }}" readonly> {{ $k->jumlah }} </div>
                                <input type="range" data-kode="{{ $k->kode_keranjang }}" data-harga="{{ $k->barang_ke_keranjang->harga_barang }}" data-jumlah="{{ $k->jumlah }}" readonly min="1" max="{{ $k->barang_ke_keranjang->stok }}" step="1" value="{{ $k->jumlah }}" class="p-3 counter-keranjang counter-keranjang-{{ $k->kode_keranjang }}"> --}}
                            
                                <div class="red_button add_to_cart_button btn-tambah-keranjang btn-tambah-keranjang-{{ $barang->kode_barang }}" data-barang="{{ $barang->kode_barang }}" data-kode="{{ $barang->kode_barang }}"><a href="javascript:void(0)"><i class="fa fa-cart-plus"></i> Tambahkan</a></div>
                                <button class="btn btn-dark w-100 btn-keluarkan btn-keluarkan-{{ $barang->kode_barang }}" data-barang="{{ $barang->kode_barang }}" data-kode="{{ $barang->kode_barang }}"><i class="fa fa-cart-arrow-down"></i> keluarkan dari keranjang</button>
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
    <script>
        $(document).ready(function(){

            $(document).on("click", ".btn-keluarkan" ,function(){
                var kode = $(this).attr("data-kode");
                var barang = $(this).attr("data-barang");
                var keranjang = $(".angka-keranjang").text();
                var item_keranjang = $(".item-keranjang-" + kode);

                $.ajax({
                    type: "post",
                    url: "{{ url('member/keranjang/keluarkan') }}",
                    data:{
                        "_token" : $("[name='_token']").val(),
                        kode_barang: kode
                    },
                    success: function(hasil){
                        // console.log(hasil[0]);
                        $(".keranjang-container").html(""); // menghapus seluruh elemen yang ada pada tabel keranjang (didalam <tbody>)
                        $(".btn-tambah-keranjang-" + kode).show();
                        $(".btn-keluarkan-" + kode).hide();
                        $(".item-keranjang-" + barang).hide();
                        
                        $(".angka-keranjang").text("");
                        $(".angka-keranjang").text(hasil.length);

                        
                        if(hasil.length == 0){
                            $(".keranjang-container").append("<tr class='text-center'><td colspan='9'>Belum ada barang</td></tr>");
                        }else{
                            for(var i = 0; i < hasil.length; i++){
                                var counter = i + 1;
                                $(".keranjang-container").append(
                                    
                                    "<tr class='text-center item-keranjang-" + hasil[i]['kode_keranjang'] + " item-keranjang-" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "'>" +
                                        "<td><input type='checkbox' class='anak-checkbox' data-barang='" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "' data-kode='" + hasil[i]['kode_keranjang'] + "'></td>" +
                                        "<th scope='row' class='counter-nomor-keranjang'>" + counter + "</th>" +
                                        "<td><img src='{{ url('images/barang/') }}" + "/" + hasil[i]['barang_ke_keranjang']['gambar'] + "' class='img-fluid'></td>" +
                                        "<td>" + hasil[i]['barang_ke_keranjang']['nama_barang'] + "</td>" +
                                        "<td>" + hasil[i]['barang_ke_keranjang']['harga_barang'] + "</td>" +
                                        "<td>" +
                                            "<div type='text' class='container-jumlah-" + hasil[i]['kode_keranjang'] + "' readonly> " + hasil[i]['jumlah'] + " </div>" +
                                            "<input type='range' data-kode='" + hasil[i]['kode_keranjang'] + "' data-harga='" + hasil[i]['barang_ke_keranjang']['harga_barang'] + "' data-jumlah='" + hasil[i]['jumlah'] + "' readonly min='1' max='" + hasil[i]['barang_ke_keranjang']['stok'] + "' step='1' value='" + hasil[i]['jumlah'] + "' class='p-3 counter-keranjang counter-keranjang-" + hasil[i]['kode_keranjang'] + "'>" +
                                        "</td>" +
                                        "<td>" + hasil[i]['barang_ke_keranjang']['stok'] + "</td>" +
                                        "<td class='total-keranjang'>" + hasil[i]['total'] + "</td>" +
                                        "<td>" +
                                            "<button class='btn btn-danger btn-hapus-keranjang' data-kode='" + hasil[i]['kode_keranjang'] + "' data-barang='" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "'> hapus</button>" +
                                            "<button class='btn btn-success btn-bayar-keranjang' data-kode='" + hasil[i]['kode_keranjang'] + "'> bayar</button>" +
                                        "</td>" +
                                    "</tr>"
                                );
                            }
                        }
                    }
                });
            });

            // ambil data

            $.ajax({
                type: "post", 
                url: "{{ url('member/keranjang/ambildata') }}",
                data: {
                    "_token": $("[name='_token']").val()
                },
                success: function(hasil){
                    for(var i = 0; i < hasil.length; i++){
                        $(".btn-tambah-keranjang-" + hasil[i][0]).hide();
                        $(".btn-keluarkan-" + hasil[i][0]).show();
                    }
                }
            });

        });

    $(document).on("click", ".btn-tambah-keranjang", function(){

    var kode = $(this).attr("data-kode");
    var keranjang = $(".angka-keranjang").text();

    $.ajax({
        type: "post",
        url: "{{ url('member/tambah_keranjang') }}" + "/" + kode,
        data: {
            "_token": $("[name='_token']").val(),
            kode_barang: kode
        },
        success: function(hasil){

            if(hasil == "belum_login"){
                $("#modal-login").modal("show");
            }else{
                $(".btn-tambah-keranjang-" + kode).hide();
                $(".btn-keluarkan-" + kode).show();
                
            $(".angka-keranjang").text("");
            $(".angka-keranjang").text(hasil.length);
            $(".keranjang-container").html("");

            
            if(hasil.length == 0){
                $(".keranjang-container").append("<tr class='text-center'><td colspan='9'>Belum ada barang</td></tr>");
            }else{
                for(var i = 0; i < hasil.length; i++){
                    var counter = i + 1;
                    $(".keranjang-container").append(
                        
                        "<tr class='text-center item-keranjang-" + hasil[i]['kode_keranjang'] + " item-keranjang-" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "'>" +
                            "<td><input type='checkbox' class='anak-checkbox' data-barang='" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "' data-kode='" + hasil[i]['kode_keranjang'] + "'></td>" +
                            "<th scope='row' class='counter-nomor-keranjang'>" + counter + "</th>" +
                            "<td><img src='{{ url('images/barang/') }}" + "/" + hasil[i]['barang_ke_keranjang']['gambar'] + "' class='img-fluid'></td>" +
                            "<td>" + hasil[i]['barang_ke_keranjang']['nama_barang'] + "</td>" +
                            "<td>" + hasil[i]['barang_ke_keranjang']['harga_barang'] + "</td>" +
                            "<td>" +
                                "<div type='text' class='container-jumlah-" + hasil[i]['kode_keranjang'] + "' readonly> " + hasil[i]['jumlah'] + " </div>" +
                                "<input type='range' data-kode='" + hasil[i]['kode_keranjang'] + "' data-harga='" + hasil[i]['barang_ke_keranjang']['harga_barang'] + "' data-jumlah='" + hasil[i]['jumlah'] + "' readonly min='1' max='" + hasil[i]['barang_ke_keranjang']['stok'] + "' step='1' value='" + hasil[i]['jumlah'] + "' class='p-3 counter-keranjang counter-keranjang-" + hasil[i]['kode_keranjang'] + "'>" +
                            "</td>" +
                            "<td>" + hasil[i]['barang_ke_keranjang']['stok'] + "</td>" +
                            "<td class='total-keranjang'>" + hasil[i]['total'] + "</td>" +
                            "<td>" +
                                "<button class='btn btn-danger btn-hapus-keranjang' data-kode='" + hasil[i]['kode_keranjang'] + "' data-barang='" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "'> hapus</button>" +
                                "<button class='btn btn-success btn-bayar-keranjang' data-kode='" + hasil[i]['kode_keranjang'] + "'> bayar</button>" +
                            "</td>" +
                        "</tr>"
                    );
                }
            }
        }
        }
    });

    });
    </script>
@endsection