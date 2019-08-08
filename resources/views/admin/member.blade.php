@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
            <h1 class="text-center">Daftar Member</h1>
            <hr>
        <div class="row p-2">

            <div class="table-responsive">

                <table class="table nowrap table-borderless table-hover tabel-member">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>ID Member</th>
                            <th>Profil</th>
                            <th>Nama Member</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($member as $m_key => $m)
                            <tr class="text-center">
                                <td>{{ $m_key + 1 }}</td>
                                <td>{{ $m->id_member }}</td>
                                <td class="w-25">
                                    <div class="gambar">
                                        <img src="{{ url('images/member/'.$m->profil)}}" class="img-fluid rounded w-50"></td>
                                    </div>
                                <td>{{ $m->nama }}</td>
                                <td>{{ $m->email }}</td>
                                <td>
                                    <button data-id="{{ $m->id_member }}" class="btn btn-danger btn-hapus"><i class="fa fa-trash"></i> hapus</button>
                                    <form action="{{ route('admin.hapus_member', $m->id_member) }}" method="POST" class="form-hapus-{{ $m->id_member }}">
                                        @csrf
                                    </form>
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

            $(".btn-hapus").click(function(){
                var id = $(this).attr("data-id");

                Swal.fire({
                    title: 'Apakah anda yakin ?',
                    text: "Seluruh data member ini akan sepenuhnya di hapus!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus!'
                    }).then((result) => {
                        if (result.value) {
                            $(".form-hapus-" + id).submit();
                        }
                    })
            });

        });
    </script>

    

@if(Session::has("hapus_member"))
<script>
    Swal.fire(
        'Berhasil',
        'Berhasil Menghapus Member',
        'success'
    );
</script>
@endif
@endsection