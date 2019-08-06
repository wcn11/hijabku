<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';
    protected $keyType = "string";
    protected $primaryKey = "kode_bank";
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['kode_bank', 'nomor_rekening', "nama_bank", 'atas_nama'];
}
