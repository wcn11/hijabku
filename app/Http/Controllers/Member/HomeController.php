<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Kategori;
use App\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Barang;
use Illuminate\Http\Request;
use App\Invoice;
use App\Invoice_barang;
use App\Member;
use App\Bank;

class HomeController extends Controller
{

    protected $redirectTo = '/member/login';

    /**
     * Create a new controller instance.
     *git 
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if(Auth::guard("member")->check()){
            $kategori = Kategori::all();
    
            $barang = Barang::all();
    
            Session::put("keranjang", Keranjang::where("id_member", Auth::guard("member")->user()->id_member)->get());
    
            $keranjang = Keranjang::where("id_member", Auth::guard("member")->user()->id_member)->get();

            return view('member.home', compact("kategori", "barang", "keranjang"));
        }
    }

    public function update_keranjang(Request $request){
        $kode_keranjang = $request->kode_keranjang;

        $jumlah = $request->jumlah;

        $total = $request->total;

        $keranjang = Keranjang::find($kode_keranjang);

        $keranjang->jumlah = $jumlah;

        $keranjang->total = $total;

        $keranjang->update();
    }

    public function ambildata(){
        $keranjang = Keranjang::where("id_member", Auth::guard("member")->user()->id_member)->get();

        $kode_barang = [];

        foreach($keranjang as $k){
            $kode_barang[] = array( $k->barang_ke_keranjang->kode_barang);
        }
        return response()->json($kode_barang);
    }

    public function keluarkan(Request $request){
        $kode_barang = $request->kode_barang;

        if(empty($request->kode_keranjang)){
            $keranjang1 = Keranjang::where("kode_barang", $kode_barang)->where("id_member", Auth::guard("member")->user()->id_member)->delete();
            
        }else{
            $keranjang1 = Keranjang::find($request->kode_keranjang);
            $keranjang1->delete();
        }
        
        $keranjang = Keranjang::where("id_member", Auth::guard("member")->user()->id_member)->get();

        $kode_barang = []; //hanya untuk mengeluarkan relasi    
        
        foreach($keranjang as $k){  
            $kode_barang[] = array($k->barang_ke_keranjang);
        }

        return response()->json($keranjang);

    }

    public function detail_barang($kode_barang){
        $barang = Barang::find($kode_barang);

        return view("member/detail_barang", compact("barang"));
    }

    public function tambah_keranjang($kode_barang){

        if(Auth::guard("member")->check()){
            $keranjang = new Keranjang;

            $barang = Barang::find($kode_barang);

            $kode_kategori_substr = substr($barang->kategori_ke_barang->kode_kategori, strrpos($barang->kategori_ke_barang->kode_kategori, "-") + 1);
    
            $kode_barang_substr = substr($kode_barang, strrpos($kode_barang, "-") + 1 );

            $kode_keranjang_substr = substr(Keranjang::max("kode_keranjang"), strrpos(Keranjang::max("kode_keranjang"), "-") + 1) + 1;

            $keranjang->kode_keranjang = "KRJG-".$kode_kategori_substr."-".$kode_barang_substr."-".$kode_keranjang_substr;

            $keranjang->kode_barang = $kode_barang;

            $keranjang->id_member = Auth::guard("member")->user()->id_member;

            $keranjang->total = $barang->harga_barang;

            $keranjang->save();

            // return data 
            
            $keranjang2 = Keranjang::where("id_member", Auth::guard("member")->user()->id_member)->get();

            $kode_barang = [];

            foreach($keranjang2 as $k){
                $kode_barang[] = array( $k->barang_ke_keranjang);
            }

            return response()->json($keranjang2);

        }else{
            return response()->json("belum_login");
        }
    }

    public function invoice(Request $request){
        
        $id_member = Member::max("id_member");

        $id_member_slash = strrpos($id_member, "-");

        $id_member_substr = substr($id_member, $id_member_slash + 1) +1;

        $invoice_max = Invoice::max("kode_invoice");

        $invoice_substr = substr($invoice_max, strrpos($invoice_max, "-") + 1) + 1;

        $invoice = new Invoice;

        $invoice->kode_invoice = "INV-".$id_member_substr."-".$invoice_substr;

        $invoice->id_member = Auth::guard("member")->user()->id_member;

        $invoice->status = "pending";

        $invoice->save();

        return response()->json($invoice->kode_invoice);
    }

    public function tambah_barang(Request $request){

        // max kode invoice barang
        $ib_max = Invoice_barang::max("kode_invoice_barang");

        $ib_substr = substr($ib_max, strrpos($ib_max, "-") + 1) + 1;

        // substr kode invoice

        $invoice = $request->kode_invoice;

        $invoice_substr = substr($invoice, strrpos($invoice, "-") + 1 ) + 1;

        $kode_keranjang = Keranjang::find($request->kode_keranjang);

        $ib = new Invoice_barang;

        $ib->kode_invoice_barang = "IB-".$invoice_substr."-".$ib_substr;

        $ib->kode_invoice = $invoice;

        $ib->kode_barang = $kode_keranjang->kode_barang;

        $ib->jumlah = $kode_keranjang->jumlah;

        $ib->total = $kode_keranjang->total;

        $ib->save();

        $kode_keranjang->delete();

        return response()->json($request->kode_keranjang);

    }

    public function bayar($kode_invoice){

        $invoice = Invoice::find($kode_invoice);

        $invoice_sum = Invoice_barang::where("kode_invoice", $kode_invoice)->sum("total");

        $member = Member::find(Auth::guard("member")->user()->id_member);

        $bank = Bank::all();

        return view("member.detail_invoice", compact('invoice', "invoice_sum", "member", "bank"));

    }

    public function konfirmasi($kode_invoice, Request $request){

        $invoice = Invoice::find($kode_invoice);

        $invoice->atas_nama = $request->atas_nama;

        $invoice->alamat_penerima = $request->alamat_penerima;

        $invoice->telepon = $request->telepon;

        $invoice->status = "menunggu";

        $invoice->update();

        Session::flash("invoice", "berhasil");
    }
}