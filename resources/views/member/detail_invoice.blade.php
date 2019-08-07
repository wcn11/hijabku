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
                                {{-- <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">$8.497,00</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Discount (20%)</strong>
                                    </td>
                                    <td class="right">$1,699,40</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>VAT (10%)</strong>
                                    </td>
                                    <td class="right">$679,76</td>
                                </tr> --}}
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong><sup>Rp</sup>{{ $invoice_sum }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
    
                    </div>
    
                </div>
    
            </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/moment.js') }}"></script>
    <script>
        $(function () {

            $(".btn-konfirmasi").click(function(){
                var nama = $("[name='atas_nama']").val();
                var alamat = $("[name='alamat_penerima']").val();
                var telepon = $("[name='telepon']").val();

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
                }else{
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