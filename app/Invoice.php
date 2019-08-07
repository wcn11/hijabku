<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $keyType = "string";
    protected $primaryKey = "kode_invoice";
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['kode_invoice', 'kode_barang_invoice', 'total', 'id_member', 'jatuh_tempo', 'tanggal_invoice', 'status', "atas_nama", 'alamat_penerima', 'telepon'];

    public function invoice_ke_invoicebarang(){
        return $this->hasMany("App\Invoice_barang", "kode_invoice");
    }

    public function member_ke_invoice(){
        return $this->belongsTo("App\Member", "id_member");
    }

    public function invoice_ke_bukti(){
        return $this->hasMany("App\Bukti", "kode_invoice");
    }
}
