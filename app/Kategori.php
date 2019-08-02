<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{

    protected $table = 'kategori';
    protected $keyType = "string";
    protected $primaryKey = "kode_kategori";
    public $incrementing = false;
    
    public $timestamps = false;

    // const CREATED_AT = "dibuat";
    // const UPDATED_AT = "diupdate";

    protected $fillable = ['kode_kategori', 'nama_kategori'];
}
