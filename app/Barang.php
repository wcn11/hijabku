<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{

    protected $table = 'barang';
    protected $keyType = "string";
    protected $primaryKey = "kode_barang";
    public $incrementing = false;
    
    const CREATED_AT = "dibuat";
    const UPDATED_AT = "diupdate";

    protected $fillable = ['kode_barang', 'kode_kategori', 'nama_barang', 'stok', 'keterangan', 'gambar', 'harga_barang'];
}
