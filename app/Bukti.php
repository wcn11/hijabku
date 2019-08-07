<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bukti extends Model
{
    protected $table = 'bukti';
    protected $keyType = "string";
    protected $primaryKey = "kode_bukti";
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ["kode_bukti", 'id_member', 'kode_invoice','bukti', 'tanggal_upload', 'status'];

    public function invoice_ke_bukti(){
        return $this->belongsTo("App\Invoice", "kode_invoice");
    }
}
