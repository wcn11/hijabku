@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
            <h1 class="text-center">Daftar Kategori</h1>
            <hr>
        <div class="row p-2">

            <button class="btn btn-dark" data-target=".modal-tambah" data-toggle="modal"><i class="fa fa-plus"></i> Tambah</button>

            <div class="table-responsive p-2">
                <table class="table nowrap table-border table-hover tabel-kategori">
                    <thead>
                        <tr class="text-center">
                            <th>Kode Kategori</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(empty($kategori))
                            <tr>
                                <td colspan="3">Belum ada kategori</td>
                            </tr>
                        @else
                            @foreach ($kategori as $k)
                                
                                <tr class="text-center">
                                    <td>{{ $k->kode_kategori }}</td>
                                    <td>{{ $k->nama_kategori }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-edit" data-id="{{ $k->kode_kategori }}" data-nama="{{ $k->nama_kategori }}"><i class="fa fa-edit"></i> edit</button>
                                        <button class="btn btn-danger btn-hapus" data-id="{{ $k->kode_kategori }}" data-nama="{{ $k->nama_kategori }}"><i class="fa fa-trash"></i> hapus</button>

                                        <form action="{{ route('admin.hapus_kategori', $k->kode_kategori) }}" method="POST" class="form-hapus-{{ $k->kode_kategori }}">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    

    <div class="modal fade modal-edit">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4><i class="fa fa-hat-wizard"></i> Edit kategori <span class="kategori"></span></h4>
                    </div>
                    <div class="modal-body">
    
                        <form action="{{ route('admin.update_kategori') }}" method="POST" class="form form-update">
                            @csrf
                            <div class="form-group">
                                <label for="kategori">Nama kategori</label>
                                <input type="hidden" name="kode_kategori">
                                <input type="text" class="form-control kategori-update" name="nama_kategori">
                            </div>
                        </form>
    
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info btn-update"><i class="fa fa-plus"></i> Update</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-tambah">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center">
                            <h4><i class="fa fa-hat-wizard"></i> Tambah kategori</h4>
                        </div>
                        <div class="modal-body">
        
                            <form action="{{ route('admin.tambah_kategori') }}" method="POST" class="form form-tambah">
                                @csrf
                                <div class="form-group">
                                    <label for="kategori">Nama kategori</label>
                                    <input type="text" class="form-control input-tambah-kategori" name="nama_kategori">
                                </div>
                            </form>
        
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-info btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('js')

    <script>
        $(document).ready(function(){
            $(".tabel-kategori").DataTable();
        });

        $(".btn-update").click(function(){
            var nama = $("[name='nama_kategori']").val();

            if(nama == ''){
                Swal.fire(
                    'Gagal',
                    'Nama kategori tidak boleh kosong!',
                    'error'
                );
            }else{
                $(".form-update").submit();
            }
        });

        $(".btn-edit").click(function(){
            var id = $(this).attr("data-id");
            var nama = $(this).attr("data-nama");

            $(".kategori").text(nama);
            $("[name='nama_kategori']").val(nama);
            $("[name='kode_kategori']").val(id);
            $(".modal-edit").modal('show');
        });

        $(".btn-tambah").click(function(){
            var nama = $(".input-tambah-kategori").val();

            if(nama == ""){
                Swal.fire(
                    'Gagal',
                    'Nama kategori tidak boleh kosong!',
                    'error'
                );
            }else{
                $(".form-tambah").submit();
            }
        });

        $(".btn-hapus").click(function(){

            var id = $(this).attr("data-id");
            var nama = $(this).attr("data-nama");

            Swal.fire({
                title: "Hapus Kategori",
                type: "warning",
                html: "Apakah anda yakin ingin menghapus <strong class='text-danger'>" + nama + "</strong> ?",
                confirmButtonText: "hapus",
                showCancelButton: true,
                cancelButtonText: "batal",
                
            }).then((result) => {
                if(result.value) {
                    $(".form-hapus-" + id).submit();
                }
            });

        });
    </script>

@if(Session::has('tambah_kategori'))
    <script>
        Swal.fire(
            'Berhasil',
            'Berhasil menambah kategori baru!',
            'success'
        );
    </script>
@endif

@if(Session::has('hapus_kategori'))
    <script>
        Swal.fire(
            'Berhasil',
            'Berhasil menghapus kategori!',
            'success'
        );
    </script>
@endif

@if(Session::has('update_kategori'))
    <script>
        Swal.fire(
            'Berhasil',
            'Berhasil update kategori!',
            'success'
        );
    </script>
@endif
@endsection