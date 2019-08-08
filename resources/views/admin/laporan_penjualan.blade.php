@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="text-center">Daftar Laporan Penjualan</h1>
        <hr>
        <div class="row p-2">


            <div class="table-responsive">

                <table class="table nowrap table-borderless nowrap  table-hover tabel-member">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode Invoice</th>
                            <th>Id Member</th>
                            <th>Atas Nama</th>
                            <th>Alamat Penerima</th>
                            <th>Tanggal Invoice</th>
                            <th>Jatuh Tempo</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th>Bukti</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice as $key => $i)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $i->kode_invoice }}</td>
                                <td>{{ $i->id_member }}</td>
                                <td>{{ $i->atas_nama }}</td>
                                <td>{{ $i->alamat_penerima }}</td>
                                <td>{{ $i->tanggal_invoice }}</td>
                                <td>{{ $i->jatuh_tempo }}</td>
                                <td>{{ $i->telepon }}</td>
                                <td><span class="badge badge-success">{{ $i->status }}</span></td>
                                <td><img src="{{ url('images/bukti/'. $i->invoice_ke_bukti[0]['bukti']) }}" class="img-fluid rounded"> </td>
                                {{-- <td>
                                    <a class="btn btn-danger" href="{{ route('admin.tolak_konfirmasi', $i->kode_invoice) }}"><i class="fas fa-trash-alt"></i> tolak</a>
                                    <a class="btn btn-success" href="{{ route('admin.terima_konfirmasi', $i->kode_invoice) }}"><i class="fas fa-vote-yea"></i> terima</a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function(){

            $(".tabel-member").DataTable({
                "dom": '<"dt-buttons"Bf><"clear">lirtp',
                "paging": true,
                "autoWidth": true,
                dom: 'Bfrtip',
                "buttons": [
				{
					text: 'Export PDF',
					extend: 'pdfHtml5',
					filename: 'Laporan  penjualan [invoice]',
					orientation: 'landscape', //portrait
					pageSize: 'A4', //A3 , A5 , A6 , legal , letter
					exportOptions: {
						columns: ':visible',
						search: 'applied',
						order: 'applied'
					}
                }
                ]
            });

            // $(".btn-hapus").click(function(){
            //     var id = $(this).attr("data-id");

            //     Swal.fire({
            //         title: 'Apakah anda yakin ?',
            //         text: "Seluruh data member ini akan sepenuhnya di hapus!",
            //         type: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Hapus!'
            //         }).then((result) => {
            //             if (result.value) {
            //                 $(".form-hapus-" + id).submit();
            //             }
            //         })
            // });

        });
    </script>

    

@if(Session::has("tola_konfirmasi"))
<script>
    Swal.fire(
        'Berhasil',
        'Menolak invoice',
        'success'
    );
</script>
@endif
@endsection