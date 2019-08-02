@extends('admin.layouts.app')

@section('content')
    
    <div class="container-fluid">
        <div class="row">

            <div class="wrapper">
                <button class="btn btn-dark " data-target=".modal-tambah" data-toggle="modal"><i class="fa fa-plus"></i> Tambah barang</button>
            </div>

            <table class="table table-responsive table-hover table-borderless">
                <thead>
                    <tr class="text-center">
                        <th>Kode Barang</th>
                        <th>Kategori</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Keterangan</th>
                        <th>Gambar</th>
                        <th>Harga Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $b)
                        <tr class="text-center">
                            <td>{{ $b->kode_barang }}</td>
                            <td>engga ada</td>
                            <td>{{ $b->nama_barang }}</td>
                            <td>{{ $b->stok }}</td>
                            <td>{{ $b->keterangan }}</td>
                            <td>{{ $b->gambar }}</td>
                            <td>{{ $b->harga_barang }}</td>
                            <td>
                                    <button class="btn btn-danger btn-hapus" data-nama={{ $b->nama_barang }} data-id="{{ $b->kode_barang }}"><i class="fa fa-trash"></i> hapus</button>
                                    <button class="btn btn-warning btn-edit"
                                        data-kode="{{ $b->kode_barang }}"
                                        data-nama="{{ $b->nama_barang }}"
                                        data-stok="{{ $b->stok }}"
                                        data-harga="{{ $b->harga_barang }}"
                                        data-keterangan="{{ $b->keterangan }}"
                                        data-gambar="{{ $b->gambar }}">
                                            <i class="fa fa-edit"></i> edit
                                    </button>

                                <form class="form-hapus-{{ $b->kode_barang }}" action="{{ route('admin.hapus_barang', $b->kode_barang) }}" method="POST">
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="modal fade modal-tambah">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h4><i class="fa fa-hat-wizard"></i> Tambah barang</h4>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.tambah_barang') }}" method="POST" class="form form-tambah-barang">
                        @csrf

                        <div class="form-group">
                            <label for="gambar_barang">Gambar barang</label>
                            <input type="text" class="form-control" name="gambar_barang">
                        </div>

                        <div class="form-group">
                            <label for="nama_barang">Nama barang</label>
                            <input type="text" class="form-control" name="nama_barang">
                        </div>

                        <div class="form-group">
                            <label for="stok_barang">Stok barang</label>
                            <input type="number" class="form-control" name="stok_barang">
                        </div>

                        <div class="form-group">
                            <label for="keterangan_barang">Keterangan barang</label>
                            <input type="text" class="form-control" name="keterangan_barang">
                        </div>

                        <div class="form-group">
                            <label for="harga_barang">Harga barang</label>
                            <input type="number" class="form-control" name="harga_barang">
                        </div>

                        <div class="form-group">
                            <label for="barang">Kategori</label>
                            <select name="kategori_barang" class="form-control">
                                @foreach($kategori as $k)
                                    <option value="{{ $k->kode_kategori }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h4><i class="fa fa-hat-wizard"></i> Edit <span class="title-modal-edit"></span></h4>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.update_barang') }}" method="POST" class="form form-update">
                        @csrf

                        <input type="hidden" name="kode_barang">

                        <div class="form-group">
                            <label for="gambar_barang">Gambar barang</label>
                            <input type="text" class="form-control update_gambar_barang" name="gambar_barang">
                        </div>

                        <div class="form-group">
                            <label for="nama_barang">Nama barang</label>
                            <input type="text" class="form-control update_nama_barang" name="nama_barang">
                        </div>

                        <div class="form-group">
                            <label for="stok_barang">Stok barang</label>
                            <input type="number" class="form-control update_stok_barang" name="stok_barang">
                        </div>

                        <div class="form-group">
                            <label for="keterangan_barang">Keterangan barang</label>
                            <input type="text" class="form-control update_keterangan_barang" name="keterangan_barang">
                        </div>

                        <div class="form-group">
                            <label for="harga_barang">Harga barang</label>
                            <input type="number" class="form-control update_harga_barang" name="harga_barang">
                        </div>

                        <div class="form-group">
                            <label for="barang">Kategori</label>
                            <select name="kategori_barang" class="form-control update_kategori_barang">
                                @foreach($kategori as $k)
                                    <option value="{{ $k->kode_kategori }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-update"><i class="fa fa-plus"></i> Update</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function(){

            $(".btn-tambah").click(function(){
                var gambar_barang = $("[name='gambar_barang']").val();
                var nama_barang = $("[name='nama_barang']").val();
                var stok_barang = $("[name='stok_barang']").val();
                var keterangan_barang = $("[name='keterangan_barang']").val();
                var harga_barang = $("[name='harga_barang']").val();

                if(gambar_barang == ""){
                    Swal.fire(
                        'Gagal',
                        'Harap pilih gambar barang!',
                        'error'
                    );
                }else if(nama_barang == ""){
                    Swal.fire(
                        'Gagal',
                        'Nama barang tidak boleh kosong!',
                        'error'
                    );
                }else if(stok_barang == ""){
                    Swal.fire(
                        'Gagal',
                        'Stok barang tidak boleh kosong!',
                        'error'
                    );
                }else if( keterangan_barang == ""){
                    Swal.fire(
                        'Gagal',
                        'Keterangan barang tidak boleh kosong!',
                        'error'
                    );
                }else if(harga_barang == ""){
                    Swal.fire(
                        'Gagal',
                        'Harga barang tidak boleh kosong!',
                        'error'
                    );
                }else{
                    $(".form-tambah-barang").submit();
                }
            });

            $(".btn-update").click(function(){

                var gambar_barang = $(".update_gambar_barang").val();
                var nama_barang = $(".update_nama_barang").val();
                var stok_barang = $(".update_stok_barang").val();
                var keterangan_barang = $(".update_harga_barang").val();
                var harga_barang = $(".update_keterangan_barang").val();

                if(gambar_barang == ''){
                    Swal.fire(
                        'Gagal',
                        'Harap upload gambar!',
                        'error'
                    );
                }else if( nama_barang == ""){
                    Swal.fire(
                        'Gagal',
                        'Nama barang tidak boleh kosong!',
                        'error'
                    );
                }else if( stok_barang == ""){
                    Swal.fire(
                        'Gagal',
                        'Stok barang tidak boleh kosong!',
                        'error'
                    );
                }else if( keterangan_barang == ""){
                    Swal.fire(
                        'Gagal',
                        'Keterangan barang tidak boleh kosong!',
                        'error'
                    );
                }else if( harga_barang == ""){
                    Swal.fire(
                        'Gagal',
                        'Harga barang tidak boleh kosong!',
                        'error'
                    );
                }else{
                    $(".form-update").submit();
                }
            });

        $(".btn-edit").click(function(){

            var kode = $(this).attr("data-kode");
            var nama = $(this).attr("data-nama");
            var gambar = $(this).attr("data-gambar");
            var stok = $(this).attr("data-stok");
            var harga = $(this).attr("data-harga");
            var keterangan = $(this).attr("data-keterangan");

            $(".title-modal-edit").text(nama);
            $("[name='kode_barang']").val(kode);

            $(".update_nama_barang").val(nama);
            $(".update_gambar_barang").val(gambar);
            $(".update_stok_barang").val(stok);
            $(".update_harga_barang").val(harga);
            $(".update_keterangan_barang").val(keterangan);

            $(".modal-edit").modal("show");

        });

        $(".btn-hapus").click(function(){

            var id = $(this).attr("data-id");
            var nama = $(this).attr("data-nama");

            Swal.fire({
                title: "Hapus Barang",
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

        });
    </script>

    @if(Session::has("update_barang"))
        <script>
            Swal.fire(
                'Berhasil',
                'Berhasil Update Barang',
                'success'
            );
        </script>
    @endif

    @if(Session::has("hapus_barang"))
        <script>
            Swal.fire(
                'Berhasil',
                'Berhasil Hapus Barang',
                'success'
            );
        </script>
    @endif
@endsection