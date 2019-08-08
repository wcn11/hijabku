@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center">Daftar Invoice</h1>
        <hr>
        <div class="row p-2">


            <div class="table-responsive">

                <table class="table nowrap table-borderless  table-hover tabel-member">
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
                            <th>Aksi</th>
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
                                <td>{{ $i->status }}</td>
                                <td><img src="{{ url('images/bukti/'. $i->invoice_ke_bukti[0]['bukti']) }}" class="img-fluid rounded"> </td>
                                <td>
                                    <a class="btn btn-danger" href="{{ route('admin.tolak_konfirmasi', $i->kode_invoice) }}"><i class="fas fa-trash-alt"></i> tolak</a>
                                    <a class="btn btn-success" href="{{ route('admin.terima_konfirmasi', $i->kode_invoice) }}"><i class="fas fa-vote-yea"></i> terima</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function(){

            $(".tabel-member").DataTable();

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