<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_barang extends Model
{
    protected $table = 'invoice_barang';
    protected $keyType = "string";
    protected $primaryKey = "kode_invoice_barang";
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ["kode_invoice_barang", 'kode_invoice', 'kode_barang', "jumlah", "total"];

    public function invoice_ke_invoicebarang(){
        return $this->belongsTo("App\Invoice", "kode_invoice");
    }

    public function ib_ke_barang(){
        return $this->belongsTo("App\Barang", "kode_barang");
    }
}
