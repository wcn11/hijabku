@extends('member.layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/responsive.css') }}">
@endsection

@section('content')

<div class="container">

    <div class="text-right p-2">
        <a class="btn btn-outline-info btn-konfirmasi" href="{{ route('member.print_invoice', $invoice->kode_invoice) }}"><i class="fas fa-print"></i> Print invoice</a>
        <a class="btn btn-outline-success" href="{{ route('member.konfirmasi_pembayaran') }}"><i class="fas fa-cash-register"></i> Konfirmasi Pembayaran</a>
    </div>
    <div class="text-center">
        <h1>Rincian Invoice</h1>
    </div>
    <div class="card">
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
                        <div>Tanggal: <span class="text-danger"><u>{{ $invoice->jatuh_tempo }}</u></span></div>
                        <div>Jatuh tempo: {{ $invoice->tanggal_invoice }}</div>
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
                        <div>Atas Nama: {{ $invoice->atas_nama }}</div>
                        <div>Telepon: {{ $invoice->telepon }}</div>
                        <div>Alamat: {{ $invoice->alamat_penerima }}</div>
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
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/moment.js') }}"></script>
    <script>
        $(function () {

        })
    </script>
@endsection