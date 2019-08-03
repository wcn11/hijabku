<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $keyType = "string";
    protected $primaryKey = "kode_keranjang";
    public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = ['kode_keranjang', 'kode_barang', 'jumlah', 'id_member', 'total'];

    public function barang_ke_keranjang(){
        return $this->belongsTo("App\Barang", "kode_barang");
    }
}
