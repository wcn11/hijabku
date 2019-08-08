<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\Barang;
use App\Kategori;
use App\Member;

class HomeController extends Controller
{

    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $member = Member::all();

        $invoice = Invoice::where("status", "menunggu konfirmasi")->get();

        $barang = Barang::all();

        $kategori = Kategori::all();

        return view('admin.home', compact('member', 'invoice', 'barang', 'kategori'));
    }

    public function konfirmasi() {
        $invoice = Invoice::where("status", "menunggu konfirmasi")->get();

        // foreach($invoice as $i){
        //     echo $i;
        // }

        return view('admin.konfirmasi', compact('invoice'));
    }

    public function tolak_konfirmasi($kode_invoice) {
        $invoice = Invoice::find($kode_invoice);

        $invoice->status = "ditolak";

        $invoice->update();

        return redirect()->back();
    }

    public function terima_konfirmasi($kode_invoice) {
        $invoice = Invoice::find($kode_invoice);

        $invoice->status = "terkonfirmasi";

        $invoice->update();

        return redirect()->back();
    }

    public function laporan() {
        $invoice = Invoice::where("status", "terkonfirmasi")->get();

        return view('admin.laporan_penjualan', compact('invoice'));
    }

}