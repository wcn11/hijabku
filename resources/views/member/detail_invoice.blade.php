@extends('member.layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/responsive.css') }}">
@endsection

@section('content')

<div class="container">

    <div class="text-right p-2">
        <button class="btn btn-dark btn-konfirmasi"><i class="fas fa-cash-register"></i> Konfirmasi invoice</button>
    </div>
    <div class="text-center">
        <h1>Konfirmasi Invoice</h1>
    </div>
    <div class="card">
        <form class="form-invoice" action="{{ route('member.konfirmasi_invoice', $invoice->kode_invoice) }}" method="POST">
            @csrf
            <input type="hidden" name="ongkir">
            <div class="card-header">
                Invoice
                <strong>#{{ $invoice->kode_invoice }}</strong>
                <span class="float-right"> <strong>Status:</strong> <span class="text-warning">{{ $invoice->status }}</span></span>
    
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">Detail invoice:</h6>
                        <div>
                            <strong>Hijabku.com</strong>
                        </div>
                        <div>Invoice: <strong>#{{ $invoice->kode_invoice }}</strong></div>
                        <div>Tanggal: {{ now() }}</div>
                        <div>Jatuh tempo: <u>7 Hari setelah invoice ini dikonfirmasi</u></div>
                        <div>Email: contact@hijabku.com</div>
                        <div>Telepon: +6281234567890</div>
                        <div>
                            {{-- <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Bank</label>
                                </div> --}}
                                {{-- <select class="custom-select" id="inputGroupSelect01">
                                    @foreach($bank as $b)
                                        <option value="{{ $b->kode_bank }}">{{ $b->bank }}</option>
                                    @endforeach
                                </select> --}}
                                <div class="container">
                                    <div class="p-2">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="row">Nama Bank</th>
                                                    <th>A/n</th>
                                                    <th>Nomor Rekening</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($bank as $b)
                                                    <tr class="text-center">
                                                        <td>{{ $b->bank }}</td>
                                                        <td>{{ $b->atas_nama }}</td>
                                                        <td>{{ $b->nomor_rekening }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                    </div>
    
                    <div class="col-sm-6">
                        <h6 class="mb-3">Penerima:</h6>
                        <div>Email: {{ $member->email }}</div>
                        <div>
                            <strong>{{ $member->nama }}</strong>
                        </div>
                        <div>Atas Nama:
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" class="atas_nama" data-nama="{{ $member->nama }}" data-toggle="tooltip" data-placement="top" title="klik box jika penerima sama dengan nama akun anda">
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="atas_nama" placeholder="Atas nama">
                            </div>
                        </div>
                        <div>Telepon: 
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" class="telepon" data-telepon="{{ $member->telepon }}" data-toggle="tooltip" data-placement="top" title="klik box jika telepon penerima sama dengan telepon akun anda">
                                    </div>
                                </div>
                                <input class="form-control" name="telepon" placeholder="Telepon penerima">
                            </div>
                        </div>
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" class="alamat_penerima" data-alamat="{{ $member->alamat }}" data-toggle="tooltip" data-placement="top" title="klik box jika alamat penerima sama dengan alamat akun anda">
                                    </div>
                                </div>
                                <textarea class="form-control" name="alamat_penerima" placeholder="Alamat penerima"></textarea>
                            </div>
                        </div>
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Provinsi
                                    </div>
                                </div>
                                <select name="provinsi" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Kota
                                    </div>
                                </div>
                                <select name="kota" class="form-control">
                                    <option>Pilih provinsi dahulu</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Kode pos
                                    </div>
                                </div>
                                <input name="kode_pos" value="" readonly class="form-control bg-white">
                            </div>
                        </div>
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Kurir
                                    </div>
                                </div>
                                <select name="kurir" class="form-control">
                                    <option>Pilih kota dahulu</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Paket 
                                    </div>
                                </div>
                                <select name="paket" class="form-control">
                                    <option>Pilih Kurir terlebih dahulu</option>
                                </select>
                            </div>
                        </div>
                        {{-- <button type="button" class="btn btn-info btn-hitung text-right"><i class="fas fa-calculator"></i> hitung ongkir</button> --}}
                    </div>
    
    
                </div>
    
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
    
                                <th class="right">Harga</th>
                                <th class="center">Jumlah</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->invoice_ke_invoicebarang as $i_key => $i)
                                <tr>
                                    <td class="center">{{ $i_key + 1 }}</td>
                                    <td class="left strong">{{ $i->ib_ke_barang->nama_barang }}</td>
                                    <td class="left">{{ $i->ib_ke_barang->kategori_ke_barang->nama_kategori }}</td>
        
                                    <td class="right"><sup>Rp</sup>{{ $i->ib_ke_barang->harga_barang }}</td>
                                    <td class="center">{{ $i->jumlah }}</td>
                                    <td class="right"><sup>Rp</sup>{{ $i->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
    
                    </div>
    
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Ongkir</strong>
                                    </td>
                                    <td class="right ongkir">Tujuan Belum Ditentukan</td>
                                </tr> 
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong><sup></sup><span class="total-barang" data-total="{{ $invoice_sum }}">Tujuan Belum Ditentukan</span></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
    
                    </div>
    
                </div>
    
            </div>
            <input type="hidden" name="total">
            <input type="hidden" name="nama_kota">
            <input type="hidden" name="nama_provinsi">
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/moment.js') }}"></script>
    <script>
        $(function () {

            $(document).on("change", "[name='paket']", function(){
                var ongkir = parseInt($(this).val());
                var total = parseInt($(".total-barang").attr("data-total"));
                var tot = ongkir + total;
                $(".total-barang").text("");
                $(".total-barang").text("Rp" + tot);
                $(".ongkir").text("");
                $(".ongkir").text("Rp" + ongkir);
                $("[name='total']").val(tot);
                $("[name='ongkir']").val(ongkir);
            });

            $(document).on("change", "[name='kurir']", function(){
                var kota = $("[name='kota']").val();
                var kode_pos = $("[name='kode_pos']").val();
                var provinsi = $("[name='provinsi']").val();
                var kurir = $("[name='kurir']").val();
                if(kota == ""){
                    Swal.fire({
                        title: 'Belum Memilih Provinsi',
                        html: "Harap pilih dahulu Provinsi tujuan",
                        type: "warning",
                        animation: false,
                        customClass: {
                            popup: 'animated shake'
                        }
                    })
                }else if(kode_pos == ""){
                    Swal.fire({
                        title: 'Belum Memilih Kota',
                        html: "Harap pilih dahulu kota tujuan",
                        type: "warning",
                        animation: false,
                        customClass: {
                            popup: 'animated shake'
                        }
                    })
                }else if(provinsi == ""){
                    Swal.fire({
                        title: 'Belum Memilih Provinsi',
                        html: "Harap pilih dahulu Provinsi tujuan",
                        type: "warning",
                        animation: false,
                        customClass: {
                            popup: 'animated shake'
                        }
                    })

                }else{
                    $.ajax({
                    type: "get",
                    url: "{{ url('member/ongkir') }}",
                    data:{
                        "kode_kota": kota,
                        'kurir': kurir
                    },
                    success: function(hasil){
                        $("[name='paket']").html("");
                        // console.log(hasil[0]['costs']);
                            $("[name='paket']").append(
                                "<option>Pilih Paket</option>"
                            );
                        for(var i = 0; i < hasil[0]['costs'].length; i++){
                            // console.log(hasil[0]['costs'][i]['service']);
                            $("[name='paket']").append(
                                // "<option>Pilih Paket</option>" +
                                "<option value='" + hasil[0]['costs'][i]['cost'][0]['value'] + "' data-ongkir='" + hasil[0]['costs'][i]['cost'][0]['value'] + "'>" + hasil[0]['costs'][i]['description'] + " / Rp." + hasil[0]['costs'][i]['cost'][0]['value'] + " (est. " + hasil[0]['costs'][i]['cost'][0]['etd'] + " hari)</option>" 
                            );
                        }
                        // $("[name='paket']").html("");
                        // $("[name='paket']").append(
                        //     "<option value='" + hasil[0]['code'] + "'>" + hasil + "</option>" 
                        // );
                    }
                });
                }
            });


            $("[name='kota']").on("change", function(){
                
                var city_id = $(this).val();
                var province_id = "";
                var kode_pos = "";
                // console.log(kode_provinsi);

                $.ajax({
                    type: "get",
                    url: "{{ url('member/kota') }}",
                    // data:{

                    // }
                    success: function(hasil){
                        // console.log(hasil);
                        for(var i = 0; i < hasil.length; i++){
                            if(hasil[i]['city_id'] == city_id){
                                var kode_pos = hasil[i]['postal_code'];
                                var province_id = hasil[i]['province_id'];
                            }
                        }
                        $("[name='kode_pos']").val("");
                        $("[name='kode_pos']").val(kode_pos);

                        $("[name='kurir']").html("");
                        $("[name='kurir']").append(
                            "<option value='kosong'>Pilih Kurir</option>" +
                            "<option value='jne' data-city='" + city_id + "'>JNE</option>" +
                            "<option value='pos' data-city='" + city_id + "'>POS</option>"
                        );
                        // console.log(kode_pos);
                    }
                });
            });

            $("[name='provinsi']").on("change", function(){
                
                var province_id = $(this).val();

                $.ajax({
                    type: "get",
                    url: "{{ url('member/kota') }}",
                    // data:{

                    // }
                    success: function(hasil){
                        $("[name='kota']").html("");
                        for(var i = 0; i < hasil.length; i++){
                            if(hasil[i]['province_id'] == province_id){
                                // console.log(hasil[i]['city_name']);

                            $("[name='kota']").append(
                                "<option value='" + hasil[i]['city_id'] + "' data-kota='" + hasil[i]['city_name'] + "'> " + hasil[i]['type'] + "/" + hasil[i]['city_name'] + "</option>"
                            );
                            }
                        }
                    }
                });
            });

            provinsi();
            function provinsi(){
                $.ajax({
                    type: "get",
                    url: "{{ url('member/provinsi') }}",
                    success: function(hasil){
                        for(var i = 0; i < hasil.length; i++){
                            // console.log(hasil[i]);
                            $("[name='provinsi']").append(
                                "<option value='" + hasil[i]['province_id'] + "' data-provinsi='" + hasil[i]['province'] + "'>" + hasil[i]['province'] + "</option>"
                            );
                        }
                    }
                });
            }

            $(document).on("click", ".btn-konfirmasi", function(){
                var nama = $("[name='atas_nama']").val();
                var alamat = $("[name='alamat_penerima']").val();
                var telepon = $("[name='telepon']").val();
                var total = $(".total-barang").text();
                if(nama == ""){
                    Swal.fire({
                        title: 'Nama penerima kosong',
                        html: "Harap isi nama penerima",
                        type: "warning",
                        animation: false,
                        customClass: {
                            popup: 'animated shake'
                        }
                    })
                }else if(alamat == ""){
                    Swal.fire({
                        title: 'Alamat penerima kosong',
                        html: "Harap isi Alamat penerima",
                        type: "warning",
                        animation: false,
                        customClass: {
                            popup: 'animated shake'
                        }
                    })
                }else if(telepon == ""){
                    Swal.fire({
                        title: 'Telepon penerima kosong',
                        html: "Harap isi Telepon penerima",
                        type: "warning",
                        animation: false,
                        customClass: {
                            popup: 'animated shake'
                        }
                    })
                }else if(total == "Tujuan Belum Ditentukan"){
                    
                    Swal.fire({
                        title: 'Data Tujuan Belum Selesai',
                        html: "Harap isi keseluruhan data penerima",
                        type: "warning",
                        animation: false,
                        customClass: {
                            popup: 'animated shake'
                        }
                    })
                }else{
                    // console.log($("[name='kota']").attr("data-kota"));
                    // $("[name='nama_provinsi']").val($("[name='provinsi']").attr("data-provinsi"));
                    $(".form-invoice").submit();

                }
            });

            // $("[name='jatuh_tempo']").val(tanggal);

            $('[data-toggle="tooltip"]').tooltip();

            $(".atas_nama").click(function(){
                var nama = $(this).attr("data-nama");

                if($(this).is(":checked")){
                    $("[name='atas_nama']").val(nama);
                }else{
                    $("[name='atas_nama']").val("");
                }
            });

            $(".alamat_penerima").click(function(){
                var alamat = $(this).attr("data-alamat");

                if($(this).is(":checked")){
                    if(alamat == ""){
                        Swal.fire({
                            position: 'center',
                            type: 'info',
                            html: "<span class='text-danger'>Anda belum melengkapi bagian alamat pada profil anda!</span><br><br>Namun anda dapat mengisi alamat penerima disamping checkbox <strong>alamat penerima</strong>",
                            title: 'Kosong',
                            showConfirmButton: true,
                            // timer: 1500
                        });
                        $(this).prop("checked", false);
                    }else{
                        $("[name='alamat_penerima']").val(alamat);
                    }
                }else{
                    $("[name='alamat_penerima']").val("");
                }
            });

            $(".telepon").click(function(){
                var telepon = $(this).attr("data-telepon");

                if($(this).is(":checked")){
                    if(telepon == ""){
                        Swal.fire({
                            position: 'center',
                            type: 'info',
                            html: "<span class='text-danger'>Anda belum mengisi bagian telepon pada profil anda!</span><br><br>Namun anda dapat mengisi telepon penerima disamping checkbox <strong>telepon penerima</strong>",
                            title: 'Kosong',
                            showConfirmButton: true,
                            // timer: 1500
                        });
                        $(this).prop("checked", false);
                    }else{
                        $("[name='telepon']").val(telepon);
                    }
                }else{
                    $("[name='telepon']").val("");
                }
            });
        })
    </script>
@endsection