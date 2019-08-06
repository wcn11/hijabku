
<html lang="en">
    <head>
    <title>Hijabku</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}">
    
    <link href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('animate.css') }}">
    </head>
    
    <style>
        .margin-atas{
            margin-top: 7%;
        }
        .quantity {
  position: relative;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button
{
  -webkit-appearance: none;
  margin: 0;
}

input[type=number]
{
  -moz-appearance: textfield;
}

.quantity input {
  width: 45px;
  height: 42px;
  line-height: 1.65;
  float: left;
  display: block;
  padding: 0;
  margin: 0;
  padding-left: 20px;
  border: 1px solid #eee;
}

.quantity input:focus {
  outline: 0;
}

.quantity-nav {
  float: left;
  position: relative;
  height: 42px;
}

.quantity-button {
  position: relative;
  cursor: pointer;
  border-left: 1px solid #eee;
  width: 20px;
  text-align: center;
  color: #333;
  font-size: 13px;
  font-family: "Trebuchet MS", Helvetica, sans-serif !important;
  line-height: 1.7;
  -webkit-transform: translateX(-100%);
  transform: translateX(-100%);
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
}

.quantity-button.quantity-up {
  position: absolute;
  height: 50%;
  top: 0;
  border-bottom: 1px solid #eee;
}

.quantity-button.quantity-down {
  position: absolute;
  bottom: -1px;
  height: 50%;
}
    </style>
    
    @yield('css')
    <body>
    
    <div class="super_container">
    
        <!-- Header -->
    
        <header class="header trans_300">
    
            <!-- Top Navigation -->
    
            {{-- <div class="top_nav">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="top_nav_left">free shipping on all u.s orders over $50</div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="top_nav_right">
                                <ul class="top_nav_menu">
    
                                    <!-- Currency / Language / My Account -->
    
                                    <li class="currency">
                                        <a href="#">
                                            usd
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="currency_selection">
                                            <li><a href="#">cad</a></li>
                                            <li><a href="#">aud</a></li>
                                            <li><a href="#">eur</a></li>
                                            <li><a href="#">gbp</a></li>
                                        </ul>
                                    </li>
                                    <li class="language">
                                        <a href="#">
                                            English
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="language_selection">
                                            <li><a href="#">French</a></li>
                                            <li><a href="#">Italian</a></li>
                                            <li><a href="#">German</a></li>
                                            <li><a href="#">Spanish</a></li>
                                        </ul>
                                    </li>
                                    <li class="account">
                                        <a href="#">
                                            My Account
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="account_selection">
                                            <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
                                            <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
    
            <!-- Main Navigation -->
    
            <div class="main_nav_container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <div class="logo_container">
                                <a href="/">HIJAB<span>ku</span></a>
                            </div>
                            <nav class="navbar">
                                <ul class="navbar_menu">
                                    <li><a href="#">home</a></li>
                                    <li><a href="#">shop</a></li>
                                    <li><a href="#">promotion</a></li>
                                    <li><a href="#">pages</a></li>
                                    <li><a href="#">blog</a></li>
                                    <li><a href="contact.html">contact</a></li>
                                </ul>
                                <ul class="navbar_user">


                                @if(Auth::guard("member")->check())    
                                    <li class="checkout">
                                        <a href="javascript:void(0)" data-target=".modal-keranjang" class="trigger-keranjang" data-toggle="modal">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            <span id="checkout_items" data-angka-keranjang="{{ Session::get("keranjang")->count() }}" class="checkout_items angka-keranjang">{{ Session::get("keranjang")->count() }}</span>
                                        </a>
                                    </li>
                                @endif

                                    <li>
                                        @if (Auth::guard('member')->guest())
                                            <a href="#modal-login" data-toggle="modal"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                                        @else
                                            {{-- <a href="#modal-login" data-toggle="modal"><i class="fa fa-sign-in" aria-hidden="true"></i> {{ Auth::guard('member')->user()->nama }}</a> --}}
                                            <div class="btn-group dropleft">
                                                <a href="javascript:void(0)" type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-user"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <form action="{{ route('member.logout') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-block"><i class="fa fa-sign-out-alt"></i> logout</button>
                                                    </form>
                                                </div>
                                                </div>
                                        @endif
                                    </li>
                                </ul>
                                <div class="hamburger_container">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
    
        </header>
    
        <div class="modal fade" id="modal-login">
            <div class=" modal-dialog modal-dialog-center modal-dialog-lg">
                <div class="modal-content">
                    <div class="modal-header justify-content-center" style="background-color:#fe4c50;">
                        <h2 class=" modal-title-login text-white">Login</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        {{-- form login --}}
                        <div class="form form-login">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email-login" placeholder="email anda">

                                    @if($errors->has('email-login'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email-login') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password-login" placeholder="password anda">
                                
                                    @if($errors->has('password-login'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password-login') }}</strong>
                                        </span>
                                    @endif

                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-dark btn-login"><i class="fas fa-sign-in"></i> Login</button>
                            </div>
                            <hr>
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-dark btn-daftar-slide"><i class="fas fa-sign-up"></i> Daftar</button>
                            </div>
                        </div>

                        {{-- form daftar --}}
                            <form class="form form-daftar" action="{{ route('member.register') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="nama-register">Nama</label>
                                    <input type="text" class="form-control" name="nama-register" placeholder="nama anda">
                                
                                    @if($errors->has('nama-register'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama-register') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="email-register">Email</label>
                                    <input type="email" class="form-control" name="email-register" placeholder="email anda">
                                    <div class="invalid-feedback">
                                            Email telah terdaftar.
                                          </div>
                                    @if($errors->has('email-register'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email-register') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="password-register">Password</label>
                                    <input type="password" class="form-control" name="password-register" placeholder="password anda">
                                
                                    @if($errors->has('password-register'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password-register') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password-confirmation">Konfirmasi Password</label>

                                    <div class="form-group">
                                        <input id="password-confirm" type="password" class="form-control" placeholder="ketik ulang password" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-dark btn-daftar"><i class="fas fa-sign-up"></i> Daftar</button>
                                </div>
                                <hr>
                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-dark btn-login-slide"><i class="fas fa-sign-up"></i> Login</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="fs_menu_overlay"></div>
        <div class="hamburger_menu">
            <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
            <div class="hamburger_menu_content text-right">
                <ul class="menu_top_nav">
                    <li class="menu_item has-children">
                        <a href="#">
                            usd
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="menu_selection">
                            <li><a href="#">cad</a></li>
                            <li><a href="#">aud</a></li>
                            <li><a href="#">eur</a></li>
                            <li><a href="#">gbp</a></li>
                        </ul>
                    </li>
                    <li class="menu_item has-children">
                        <a href="#">
                            English
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="menu_selection">
                            <li><a href="#">French</a></li>
                            <li><a href="#">Italian</a></li>
                            <li><a href="#">German</a></li>
                            <li><a href="#">Spanish</a></li>
                        </ul>
                    </li>
                    <li class="menu_item has-children">
                        <a href="#">
                            My Account
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="menu_selection">
                            <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
                            <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                        </ul>
                    </li>
                    <li class="menu_item"><a href="#">home</a></li>
                    <li class="menu_item"><a href="#">shop</a></li>
                    <li class="menu_item"><a href="#">promotion</a></li>
                    <li class="menu_item"><a href="#">pages</a></li>
                    <li class="menu_item"><a href="#">blog</a></li>
                    <li class="menu_item"><a href="#">contact</a></li>
                </ul>
            </div>
        </div>

        <div class="margin-atas">
            <br>
        </div>
    
        @yield('content')
    
        <!-- Newsletter -->
    
        <div class="newsletter">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
                            <h4>Newsletter</h4>
                            <p>Subscribe to our newsletter and get 20% off your first purchase</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action="post">
                            <div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
                                <input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
                                <button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Footer -->
    
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
                            <ul class="footer_nav">
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">FAQs</a></li>
                                <li><a href="contact.html">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer_nav_container">
                            <div class="cr">©2018 All Rights Reserverd. This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#">Colorlib</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    
    </div>

        
    <div class="modal fade modal-keranjang" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="">
                    <i class="fa fa-cart-plus"></i> Keranjang anda
                    {{-- <button type="button" data-dismiss="modal" class="close">&times;</button> --}}
                </div>
            </div>
            <div class="modal-body">
                <table class="table table-border">
                    <thead>
                        <tr class="text-center">
                            <th><input type="checkbox" class="kepala-checkbox"></th>
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="keranjang-container">
                        @if(Session::has("keranjang"))
                            @if(Session::get("keranjang")->isEmpty())
                                <tr class="text-center">
                                    <td colspan="8">Belum ada barang</td>
                                </tr>
                            @else
                                @foreach(Session::get('keranjang') as $k_key => $k)
                                    <tr class="text-center item-keranjang-{{ $k->kode_keranjang }} item-keranjang-{{ $k->barang_ke_keranjang->kode_barang }}">
                                        <td><input type="checkbox" class="anak-checkbox" data-barang="{{ $k->barang_ke_keranjang->kode_barang }}" data-kode="{{ $k->kode_keranjang }}"></td>
                                        <th scope="row" class="counter-nomor-keranjang">{{ $k_key + 1 }}</th>
                                        <td><img src="{{ 'images/barang/'.$k->barang_ke_keranjang->gambar }}" class="img-fluid"></td>
                                        <td>{{ $k->barang_ke_keranjang->nama_barang }}</td>
                                        <td>{{ $k->barang_ke_keranjang->harga_barang }}</td>
                                        <td>
                                            <div type="text" class="container-jumlah-{{ $k->kode_keranjang }}" readonly> {{ $k->jumlah }} </div>
                                            <input type="range" data-kode="{{ $k->kode_keranjang }}" data-harga="{{ $k->barang_ke_keranjang->harga_barang }}" data-jumlah="{{ $k->jumlah }}" readonly min="1" max="{{ $k->barang_ke_keranjang->stok }}" step="1" value="{{ $k->jumlah }}" class="p-3 counter-keranjang counter-keranjang-{{ $k->kode_keranjang }}">
                                        </td>
                                        <td>{{ $k->barang_ke_keranjang->stok }}</td>
                                        <td class="total-keranjang">{{ $k->total }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-hapus-keranjang" data-kode="{{ $k->kode_keranjang }}" data-barang="{{ $k->barang_ke_keranjang->kode_barang }}"> hapus</button>
                                            <button class="btn btn-success btn-bayar-keranjang" data-kode="{{ $k->kode_keranjang }}"> bayar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                    </tbody>
                  </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark btn-bayar-semua"> Bayar Terpilih</button>
            </div>
          </div>
        </div>
      </div>
    
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/Isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ asset('plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
    @yield("js")
    <script>
        $(document).ready(function(){

            $(".kepala-checkbox").click(function(){
                $(".anak-checkbox").each(function(){
                    $(this).trigger("click");
                });
            });

        $(".btn-bayar-semua").click(function(){

            // $(".anak-checkbox").each(function(){
            //     $(this).trigger("click");
            // });

            var kode_invoice = "";
            
            $.ajax({  //masukkan kode invoice d dahulu
                    type: "post",
                    url: "{{ url('member/invoice') }}",
                    data:{
                        "_token": $("[name='_token']").val(),
                    },
                    success: function(hasil){
                        
                        $(".anak-checkbox:checked").each(function(){

                            $.ajax({  //lalu masukkan kode barang ke tabel invoice_barang
                                type: "post",
                                url: "{{ url('member/invoice/tambah_barang') }}",
                                data:{
                                    "_token": $("[name='_token']").val(),
                                    "kode_keranjang": $(this).attr("data-kode"),
                                    "kode_invoice": hasil
                                },
                                success: function(hasil2){
                                },
                            });

                        });


                        Swal.fire({
                            title: 'Invoice Berhasil Dibuat!',
                            type: "success",
                            confirmButtonText: "invoice",
                            animation: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            allowOutsideClick: false,
                            customClass: {
                                popup: 'animated tada'
                            }
                        }).then((result) => {
                            if(result.value){
                                window.location.href = "{{ url('member/invoice/bayar/') }}" + "/" + hasil;
                            }
                        });

                    }

                });

        });

        function masukkan_data(hasil){

            $(".anak-checkbox:checked").each(function(){

                $.ajax({  //lalu masukkan kode barang ke tabel invoice_barang
                    type: "post",
                    url: "{{ url('member/invoice/tambah_barang') }}",
                    data:{
                        "_token": $("[name='_token']").val(),
                        "kode_keranjang": $(this).attr("data-kode"),
                        "kode_invoice": hasil
                    },
                    success: function(hasil2){
                    },
                });

            });

        }

        $(document).on("change", ".counter-keranjang" ,function(e) {
            var jumlah = $(this).attr("data-jumlah");
            var max = $(this).attr("max");
            var kode_keranjang = $(this).attr("data-kode");
            var value = $(this).val();
            var harga = $(this).attr("data-harga");


            $.ajax({
                type: "post",
                url: "{{ url('member/keranjang/update') }}",
                data:{
                    "_token": $("[name='_token']").val(),
                    "kode_keranjang": kode_keranjang,
                    "jumlah": value,
                    "total": value * harga
                },
                success: function(hasil){
                    $(".total-keranjang").text(value * harga);
                    $(".container-jumlah-" + kode_keranjang).text($(".counter-keranjang-" + kode_keranjang).val());
                }
            });

            // $(this).val(jumlah);
            //if the letter is not digit then display error and don't type anything
            // if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //     //display error message
            //     Swal.fire(
            //             'Hanya Angka!',
            //             'Hanya boleh dimasukkan angka!',
            //             'warning'
            //         )
            //     $(this).val(jumlah);
            //     return false;
            // }

        });

            $(".form-daftar").hide();

            $(".btn-daftar-slide").click(function(){
                $(".form-login").hide("slow");
                $(".form-daftar").show("slow");
                $(".modal-title-login").text("Daftar");
            });

            $(".btn-login-slide").click(function(){
                $(".form-daftar").hide("slow");
                $(".form-login").show("slow");
                $(".modal-title-login").text("Login");
            });

            // $(".btn-daftar").click(function(){

            // });

            $(".btn-login").click(function(){
                var email = $("[name='email-login']").val();
                var password = $("[name='password-login']").val();

                if(email == ""){
                    Swal.fire(
                        'GAGAL',
                        'Kolom email harus diisi!',
                        'error'
                    )
                }else if(password == ""){
                    Swal.fire(
                        'GAGAL',
                        'Kolom password harus diisi!',
                        'error'
                    )
                }else{
                    $.ajax({
                        type:"post",
                        url: "{{ url('member/login') }}",
                        data: {
                            "_token": $("[name='_token']").val(),
                            email: email,
                            password: password
                        },
                        error: function(error){
                            if(error.responseJSON.errors.email[0] === "These credentials do not match our records."){
                                Swal.fire({
                                    title: 'Data tidak ditemukan atau salah',
                                    html: "Email atu password salah.",
                                    type: "error",
                                    animation: false,
                                    customClass: {
                                        popup: 'animated shake'
                                    }
                                })
                            }
                        },
                        success: function(hasil){
                            location.reload();
                        }
                    });
                }
            });

            $(".btn-daftar").click(function(){
                var nama = $("[name='nama-register']").val();
                var email = $("[name='email-register']").val();
                var password = $("[name='password-register']").val();
                var password_confirm = $("[name='password_confirmation']").val();

                if(nama == ''){
                    Swal.fire(
                        'GAGAL',
                        'Kolom nama harus diisi!',
                        'error'
                    )
                }else if(nama.length < 6){
                    Swal.fire(
                        'GAGAL',
                        'Kolom nama minimal 6 huruf',
                        'error'
                    )
                }else if(email == ""){
                    Swal.fire(
                        'GAGAL',
                        'Kolom email harus diisi!',
                        'error'
                    )
                }else if(password == ""){
                    Swal.fire(
                        'GAGAL',
                        'Kolom password harus diisi!',
                        'error'
                    )
                }else if(password.length < 6){
                    Swal.fire(
                        'GAGAL',
                        'Password minimal 6 karakter',
                        'error'
                    )
                }else if(password_confirm == ""){
                    Swal.fire(
                        'GAGAL',
                        'Harap isi konfirmasi password!',
                        'error'
                    )
                }else if(password != password_confirm){
                    Swal.fire(
                        'GAGAL',
                        'Password tidak sama!',
                        'error'
                    )
                }else{
                    $.ajax({
                        type:"post",
                        url: "{{ url('member/register') }}",
                        data: {
                            "_token": $("[name='_token']").val(),
                            nama: nama,
                            email: email,
                            password: password,
                            password_confirmation: password_confirm
                        },
                        error: function(error){
                            if(error.responseJSON.errors.email[0] === "The email has already been taken."){
                                Swal.fire({
                                    title: 'Email telah terdaftar',
                                    html: "Email <span class='text-danger font-weight-bold'>" + email + "</span> telah terdaftar, silahkan pilih login.",
                                    type: "error",
                                    animation: false,
                                    customClass: {
                                        popup: 'animated shake'
                                    }
                                })

                                $("[name='email-register']").addClass("is-invalid");
                            }
                        },
                        success: function(hasil){
                            
                            location.reload();
                        }
                    });
                }

            });

        });
    </script>
    </body>
    
    </html>
    
    
                    {{-- <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        You are logged in!
                    </div> --}}
                {{-- </div>
            </div>
        </div>
    </div>
     --}}