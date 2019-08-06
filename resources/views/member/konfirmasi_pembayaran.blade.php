@extends('member.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/single_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/single_responsive.css') }}">
    <style>
        .bukti_pembayaran{
            width: 90%;
            height: auto;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <header><h2>Konfirmasi Pembayaran</h2></header>

        <section>
            <div class="row">
                <div class="col-lg-6">
                    <form action="{{ route('member.upload_bukti') }}" method="POST" class="form-konfirmasi" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nomor_invoice">Nomor Invoice</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                <div class="input-group-text">#</div>
                                </div>
                                <input type="text" class="form-control" name="kode_invoice" id="nomor_invoice" placeholder="nomor invoice">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bukti_pembayaran">Bukti</label>
                            <input type="file" class="form-control" value="" name="bukti_pembayaran" accept="image/*" id="bukti_pembayaran" placeholder="Bukti">
                        </div>
                        <button type="button" class="btn btn-info btn-upload"><i class="fas fa-upload"></i> Upload bukti</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div>
                        <p>Preview bukti pembayaran:</p>
                        <img src="https://www.blackbeltkaratestudio.com/wp-content/uploads/2017/04/default-image.jpg" class="img-fluid rounded bukti_pembayaran">
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/single_custom.js') }}"></script>
    <script>
        $(document).ready(function(){

            $(".btn-upload").click(function(){
                var kode_invoice = $("[name='kode_invoice']").val();
                var bukti_pembayaran = $("[name='bukti_pembayaran']").val();

                if(kode_invoice == ""){
                    Swal.fire({
                        title: 'Kode invoice kosong',
                        html: "Harap isi kode invoice",
                        type: "warning",
                        animation: false,
                        customClass: {
                            popup: 'animated shake'
                        }
                    })
                }else if(bukti_pembayaran == ""){
                    Swal.fire({
                        title: 'Bukti belum diupload',
                        html: "Harap sertakan bukti pembayaran!",
                        type: "warning",
                        animation: false,
                        customClass: {
                            popup: 'animated shake'
                        }
                    })
                }else{
                    $(".form-konfirmasi").submit();
                }
            });

        });

        $("[name='bukti_pembayaran']").on("change", function(){
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('.bukti_pembayaran').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    
    @if (Session::has('invoice_tidak_ada'))
        <script>
            Swal.fire({
                title: 'Invoice Tidak ditemukan',
                html: "Kode invoice tidak terdaftar dalam sistem!",
                type: "error",
                animation: false,
                customClass: {
                    popup: 'animated shake'
                }
            })
        </script>
    @endif
    
    @if (Session::has('invoice_berhasil'))
        <script>
            Swal.fire({
                title: 'Butki Berhasil Diupload',
                html: "Harap menunggu konfirmasi 1x24 jam!<br>Tim kami akan mengkonfirmasikan bukti pembayaran anda",
                type: "info",
                animation: false,
                customClass: {
                    popup: 'animated tada'
                }
            })
        </script>
    @endif
    
    @if (Session::has('invoice_sudah_ada'))
        <script>
            Swal.fire({
                title: 'Butki telah Diupload Sebelumnya',
                html: "Bukti yang anda upload, sudah di upload sebelumnya!",
                type: "error",
                animation: false,
                customClass: {
                    popup: 'animated shake'
                }
            })
        </script>
    @endif
@endsection