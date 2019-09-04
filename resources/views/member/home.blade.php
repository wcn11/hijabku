@extends('member.layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/responsive.css') }}">
    <style>
    
        /* .margin-atas{
            margin-top: 0 !important;
        } */
        /* .margin-awal{
            margin-top: 0% !important;
        } */
        .carousel-awal{
            margin-top: 0%;
        }
        .btn-keluarkan{
            display: none;
        }

    </style>
@endsection

@section('content')

        <!-- Slider -->
    
        <div class="main_slider carousel-awal img-fluid" style="background-image:url('https://cdn.cnn.com/cnnnext/dam/assets/160108114312-dolce-gabbana-hijab-collection-super-tease.jpg')">
            <div class="container fill_height">
                <div class="row align-items-center fill_height">
                    <div class="col">
                        <div class="main_slider_content">
                            <h6>Koleksi Terbaru 2019</h6>
                            <h1 class="text-white">Bahan Berkualitas & Terbaik</h1>
                            <div class="red_button shop_now_button "><a href="javascript:void(0)" class="belanja">belanja sekarang</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Banner -->
    
        {{-- <div class="banner">
            <div class="container">
                <div class="row">
                    @foreach($kategori as $k)
                        <div class="col-md-4">
                            <div class="banner_item align-items-center" style="background-image:url({{ $k->gambar }})">
                                <div class="banner_category">
                                    <a href="categories.html">{{ $k->nama_kategori }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div> --}}
    
        <!-- New Arrivals -->
    
        <div class="new_arrivals">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="section_title new_arrivals_title">
                            <h2>New Arrivals</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col text-center">
                        <div class="new_arrivals_sorting">
                            <ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                                <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
                                @foreach($kategori as $k)
                                <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".{{ $k->kode_kategori }}">{{ $k->nama_kategori }}</li>

                                @endforeach
                            {{--<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".accessories">accessories</li>
                                <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".men">men's</li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
    
                            <!-- Product 1 -->
    
                            @foreach($barang as $b)
                                <div class="product-item {{ $b->kategori_ke_barang->kode_kategori }} m-2">
                                    <div class="product discount product_filter">
                                        <div class="product_image">
                                            <img src="{{ url('images/barang/'.$b->gambar) }}" alt="">
                                        </div>
                                        <div class="favorite favorite_left"></div>
                                        {{-- <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><sup>Free</sup> <span class="text-white">ongkir</span></div> --}}
                                        <div class="product_info">
                                            <h6 class="product_name"><a href="{{ route('detail_barang', $b->kode_barang) }}">{{ $b->nama_barang }}</a></h6>
                                            <div class="product_price"><sup>Rp</sup>{{ $b->harga_barang }}</div>
                                        </div>
                                    </div>
                                    <div class="red_button add_to_cart_button btn-tambah-keranjang btn-tambah-keranjang-{{ $b->kode_barang }}" data-barang="{{ $b->kode_barang }}" data-kode="{{ $b->kode_barang }}"><a href="javascript:void(0)"><i class="fa fa-cart-plus"></i> masukkan keranjang</a></div>
                                    <button class="btn btn-dark w-100 btn-keluarkan btn-keluarkan-{{ $b->kode_barang }}" data-barang="{{ $b->kode_barang }}" data-kode="{{ $b->kode_barang }}"><i class="fa fa-cart-arrow-down"></i> keluarkan dari keranjang</button>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Deal of the week -->
    
        {{-- <div class="deal_ofthe_week">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="deal_ofthe_week_img">
                            <img src="images/deal_ofthe_week.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 text-right deal_ofthe_week_col">
                        <div class="deal_ofthe_week_content d-flex flex-column align-items-center float-right">
                            <div class="section_title">
                                <h2>barang minggu ini</h2>
                            </div>
                            <ul class="timer">
                                <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                    <div id="day" class="timer_num">03</div>
                                    <div class="timer_unit">Day</div>
                                </li>
                                <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                    <div id="hour" class="timer_num">15</div>
                                    <div class="timer_unit">Hours</div>
                                </li>
                                <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                    <div id="minute" class="timer_num">45</div>
                                    <div class="timer_unit">Mins</div>
                                </li>
                                <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                    <div id="second" class="timer_num">23</div>
                                    <div class="timer_unit">Sec</div>
                                </li>
                            </ul>
                            <div class="red_button deal_ofthe_week_button"><a href="#">shop now</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    
        <!-- Best Sellers -->
    
        {{-- <div class="best_sellers">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="section_title new_arrivals_title">
                            <h2>Best Sellers</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="product_slider_container">
                            <div class="owl-carousel owl-theme product_slider">
    
                                <!-- Slide 1 -->
    
                                <div class="owl-item product_slider_item">
                                    <div class="product-item">
                                        <div class="product discount">
                                            <div class="product_image">
                                                <img src="images/product_1.png" alt="">
                                            </div>
                                            <div class="favorite favorite_left"></div>
                                            <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-$20</span></div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="single.html">Fujifilm X100T 16 MP Digital Camera (Silver)</a></h6>
                                                <div class="product_price">$520.00<span>$590.00</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Slide 2 -->
    
                                <div class="owl-item product_slider_item">
                                    <div class="product-item women">
                                        <div class="product">
                                            <div class="product_image">
                                                <img src="images/product_2.png" alt="">
                                            </div>
                                            <div class="favorite"></div>
                                            <div class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center"><span>new</span></div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="single.html">Samsung CF591 Series Curved 27-Inch FHD Monitor</a></h6>
                                                <div class="product_price">$610.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Slide 3 -->
    
                                <div class="owl-item product_slider_item">
                                    <div class="product-item women">
                                        <div class="product">
                                            <div class="product_image">
                                                <img src="images/product_3.png" alt="">
                                            </div>
                                            <div class="favorite"></div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="single.html">Blue Yeti USB Microphone Blackout Edition</a></h6>
                                                <div class="product_price">$120.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Slide 4 -->
    
                                <div class="owl-item product_slider_item">
                                    <div class="product-item accessories">
                                        <div class="product">
                                            <div class="product_image">
                                                <img src="images/product_4.png" alt="">
                                            </div>
                                            <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>sale</span></div>
                                            <div class="favorite favorite_left"></div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="single.html">DYMO LabelWriter 450 Turbo Thermal Label Printer</a></h6>
                                                <div class="product_price">$410.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Slide 5 -->
    
                                <div class="owl-item product_slider_item">
                                    <div class="product-item women men">
                                        <div class="product">
                                            <div class="product_image">
                                                <img src="images/product_5.png" alt="">
                                            </div>
                                            <div class="favorite"></div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="single.html">Pryma Headphones, Rose Gold & Grey</a></h6>
                                                <div class="product_price">$180.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Slide 6 -->
    
                                <div class="owl-item product_slider_item">
                                    <div class="product-item accessories">
                                        <div class="product discount">
                                            <div class="product_image">
                                                <img src="images/product_6.png" alt="">
                                            </div>
                                            <div class="favorite favorite_left"></div>
                                            <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-$20</span></div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="single.html">Fujifilm X100T 16 MP Digital Camera (Silver)</a></h6>
                                                <div class="product_price">$520.00<span>$590.00</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Slide 7 -->
    
                                <div class="owl-item product_slider_item">
                                    <div class="product-item women">
                                        <div class="product">
                                            <div class="product_image">
                                                <img src="images/product_7.png" alt="">
                                            </div>
                                            <div class="favorite"></div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="single.html">Samsung CF591 Series Curved 27-Inch FHD Monitor</a></h6>
                                                <div class="product_price">$610.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Slide 8 -->
    
                                <div class="owl-item product_slider_item">
                                    <div class="product-item accessories">
                                        <div class="product">
                                            <div class="product_image">
                                                <img src="images/product_8.png" alt="">
                                            </div>
                                            <div class="favorite"></div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="single.html">Blue Yeti USB Microphone Blackout Edition</a></h6>
                                                <div class="product_price">$120.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Slide 9 -->
    
                                <div class="owl-item product_slider_item">
                                    <div class="product-item men">
                                        <div class="product">
                                            <div class="product_image">
                                                <img src="images/product_9.png" alt="">
                                            </div>
                                            <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>sale</span></div>
                                            <div class="favorite favorite_left"></div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="single.html">DYMO LabelWriter 450 Turbo Thermal Label Printer</a></h6>
                                                <div class="product_price">$410.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Slide 10 -->
    
                                <div class="owl-item product_slider_item">
                                    <div class="product-item men">
                                        <div class="product">
                                            <div class="product_image">
                                                <img src="images/product_10.png" alt="">
                                            </div>
                                            <div class="favorite"></div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="single.html">Pryma Headphones, Rose Gold & Grey</a></h6>
                                                <div class="product_price">$180.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Slider Navigation -->
    
                            <div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
                                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                            </div>
                            <div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    
        <!-- Benefit -->
    
        <div class="benefit">
            <div class="container">
                <div class="row benefit_row">
                    <div class="col-lg-3 benefit_col">
                        <div class="benefit_item d-flex flex-row align-items-center">
                            <div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                            <div class="benefit_content">
                                <h6>free shipping</h6>
                                <p>Suffered Alteration in Some Form</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 benefit_col">
                        <div class="benefit_item d-flex flex-row align-items-center">
                            <div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                            <div class="benefit_content">
                                <h6>cach on delivery</h6>
                                <p>The Internet Tend To Repeat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 benefit_col">
                        <div class="benefit_item d-flex flex-row align-items-center">
                            <div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
                            <div class="benefit_content">
                                <h6>45 days return</h6>
                                <p>Making it Look Like Readable</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 benefit_col">
                        <div class="benefit_item d-flex flex-row align-items-center">
                            <div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                            <div class="benefit_content">
                                <h6>opening all week</h6>
                                <p>8AM - 09PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Blogs -->
    
        {{-- <div class="blogs">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="section_title">
                            <h2>Latest Blogs</h2>
                        </div>
                    </div>
                </div>
                <div class="row blogs_container">
                    <div class="col-lg-4 blog_item_col">
                        <div class="blog_item">
                            <div class="blog_background" style="background-image:url(images/blog_1.jpg)"></div>
                            <div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
                                <h4 class="blog_title">Here are the trends I see coming this fall</h4>
                                <span class="blog_meta">by admin | dec 01, 2017</span>
                                <a class="blog_more" href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 blog_item_col">
                        <div class="blog_item">
                            <div class="blog_background" style="background-image:url(images/blog_2.jpg)"></div>
                            <div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
                                <h4 class="blog_title">Here are the trends I see coming this fall</h4>
                                <span class="blog_meta">by admin | dec 01, 2017</span>
                                <a class="blog_more" href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 blog_item_col">
                        <div class="blog_item">
                            <div class="blog_background" style="background-image:url(images/blog_3.jpg)"></div>
                            <div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
                                <h4 class="blog_title">Here are the trends I see coming this fall</h4>
                                <span class="blog_meta">by admin | dec 01, 2017</span>
                                <a class="blog_more" href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <p data-haha="qwe">hahahahahah</p> --}}
        {{-- <input type="" --}}
@endsection

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".belanja").click(function() {
                $('html, body').animate({
                    scrollTop: $(".new_arrivals").offset().top
                }, 1500);
            });
            });

    </script>
    @if(Auth::guard("member")->check())
    <script>
        $(document).ready(function(){

            // // ambil data
            // $.ajax({
            //     type: "post", 
            //     url: "{{ url('member/keranjang/ambildata') }}",
            //     data: {
            //         "_token": $("[name='_token']").val()
            //     },
            //     success: function(hasil){
            //         $(".angka-keranjang").text("");
            //         $(".angka-keranjang").text(hasil.length);
            //         for(var i = 0; i < hasil.length; i++){
            //             $(".btn-tambah-keranjang-" + hasil[i][0]).hide();
            //             $(".btn-keluarkan-" + hasil[i][0]).show();
            //         }
            //     }
            // });

            // $(document).on("click", ".btn-keluarkan" ,function(){
            //     var kode = $(this).attr("data-kode");
            //     var barang = $(this).attr("data-barang");
            //     var keranjang = $(".angka-keranjang").text();
            //     var item_keranjang = $(".item-keranjang-" + kode);

            //     $.ajax({
            //         type: "post",
            //         url: "{{ url('member/keranjang/keluarkan') }}",
            //         data:{
            //             "_token" : $("[name='_token']").val(),
            //             kode_barang: kode
            //         },
            //         success: function(hasil){
            //             // console.log(hasil[0]);
            //             $(".keranjang-container").html(""); // menghapus seluruh elemen yang ada pada tabel keranjang (didalam <tbody>)
            //             $(".btn-tambah-keranjang-" + kode).show();
            //             $(".btn-keluarkan-" + kode).hide();
            //             $(".item-keranjang-" + barang).hide();
                        
            //             $(".angka-keranjang").text("");
            //             $(".angka-keranjang").text(hasil.length);

                        
            //             if(hasil.length == 0){
            //                 $(".keranjang-container").append("<tr class='text-center'><td colspan='9'>Belum ada barang</td></tr>");
            //             }else{
            //                 for(var i = 0; i < hasil.length; i++){
            //                     var counter = i + 1;
            //                     $(".keranjang-container").append(
                                    
            //                         "<tr class='text-center item-keranjang-" + hasil[i]['kode_keranjang'] + " item-keranjang-" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "'>" +
            //                             "<td><input type='checkbox' class='anak-checkbox' data-barang='" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "' data-kode='" + hasil[i]['kode_keranjang'] + "'></td>" +
            //                             "<th scope='row' class='counter-nomor-keranjang'>" + counter + "</th>" +
            //                             "<td><img src='{{ url('images/barang/') }}" + "/" + hasil[i]['barang_ke_keranjang']['gambar'] + "' class='img-fluid'></td>" +
            //                             "<td>" + hasil[i]['barang_ke_keranjang']['nama_barang'] + "</td>" +
            //                             "<td>" + hasil[i]['barang_ke_keranjang']['harga_barang'] + "</td>" +
            //                             "<td>" +
            //                                 "<div type='text' class='container-jumlah-" + hasil[i]['kode_keranjang'] + "' readonly> " + hasil[i]['jumlah'] + " </div>" +
            //                                 "<input type='range' data-kode='" + hasil[i]['kode_keranjang'] + "' data-harga='" + hasil[i]['barang_ke_keranjang']['harga_barang'] + "' data-jumlah='" + hasil[i]['jumlah'] + "' readonly min='1' max='" + hasil[i]['barang_ke_keranjang']['stok'] + "' step='1' value='" + hasil[i]['jumlah'] + "' class='p-3 counter-keranjang counter-keranjang-" + hasil[i]['kode_keranjang'] + "'>" +
            //                             "</td>" +
            //                             "<td>" + hasil[i]['barang_ke_keranjang']['stok'] + "</td>" +
            //                             "<td class='total-keranjang'>" + hasil[i]['total'] + "</td>" +
            //                             "<td>" +
            //                                 "<button class='btn btn-danger btn-hapus-keranjang' data-kode='" + hasil[i]['kode_keranjang'] + "' data-barang='" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "'> hapus</button>" +
            //                                 "<button class='btn btn-success btn-bayar-keranjang' data-kode='" + hasil[i]['kode_keranjang'] + "'> bayar</button>" +
            //                             "</td>" +
            //                         "</tr>"
            //                     );
            //                 }
            //             }
            //         }
            //     });
            // });

            // $(document).on("click", ".btn-tambah-keranjang", function(){

            //     var kode = $(this).attr("data-kode");
            //     var keranjang = $(".angka-keranjang").text();

            //     $.ajax({
            //         type: "post",
            //         url: "{{ url('member/tambah_keranjang') }}" + "/" + kode,
            //         data: {
            //             "_token": $("[name='_token']").val(),
            //             kode_barang: kode
            //         },
            //         success: function(hasil){

            //             if(hasil == "belum_login"){
            //                 $("#modal-login").modal("show");
            //             }else{
            //                 $(".btn-tambah-keranjang-" + kode).hide();
            //                 $(".btn-keluarkan-" + kode).show();
                            
            //             $(".angka-keranjang").text("");
            //             $(".angka-keranjang").text(hasil.length);
            //             $(".keranjang-container").html("");

                        
            //             if(hasil.length == 0){
            //                 $(".keranjang-container").append("<tr class='text-center'><td colspan='9'>Belum ada barang</td></tr>");
            //             }else{
            //                 for(var i = 0; i < hasil.length; i++){
            //                     var counter = i + 1;
            //                     $(".keranjang-container").append(
                                    
            //                         "<tr class='text-center item-keranjang-" + hasil[i]['kode_keranjang'] + " item-keranjang-" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "'>" +
            //                             "<td><input type='checkbox' class='anak-checkbox' data-barang='" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "' data-kode='" + hasil[i]['kode_keranjang'] + "'></td>" +
            //                             "<th scope='row' class='counter-nomor-keranjang'>" + counter + "</th>" +
            //                             "<td><img src='{{ url('images/barang/') }}" + "/" + hasil[i]['barang_ke_keranjang']['gambar'] + "' class='img-fluid'></td>" +
            //                             "<td>" + hasil[i]['barang_ke_keranjang']['nama_barang'] + "</td>" +
            //                             "<td>" + hasil[i]['barang_ke_keranjang']['harga_barang'] + "</td>" +
            //                             "<td>" +
            //                                 "<div type='text' class='container-jumlah-" + hasil[i]['kode_keranjang'] + "' readonly> " + hasil[i]['jumlah'] + " </div>" +
            //                                 "<input type='range' data-kode='" + hasil[i]['kode_keranjang'] + "' data-harga='" + hasil[i]['barang_ke_keranjang']['harga_barang'] + "' data-jumlah='" + hasil[i]['jumlah'] + "' readonly min='1' max='" + hasil[i]['barang_ke_keranjang']['stok'] + "' step='1' value='" + hasil[i]['jumlah'] + "' class='p-3 counter-keranjang counter-keranjang-" + hasil[i]['kode_keranjang'] + "'>" +
            //                             "</td>" +
            //                             "<td>" + hasil[i]['barang_ke_keranjang']['stok'] + "</td>" +
            //                             "<td class='total-keranjang'>" + hasil[i]['total'] + "</td>" +
            //                             "<td>" +
            //                                 "<button class='btn btn-danger btn-hapus-keranjang' data-kode='" + hasil[i]['kode_keranjang'] + "' data-barang='" + hasil[i]['barang_ke_keranjang']['kode_barang'] + "'> hapus</button>" +
            //                                 "<button class='btn btn-success btn-bayar-keranjang' data-kode='" + hasil[i]['kode_keranjang'] + "'> bayar</button>" +
            //                             "</td>" +
            //                         "</tr>"
            //                     );
            //                 }
            //             }
            //         }
            //         }
            //     });

            // });

        });
    </script>
    @endif
@endsection