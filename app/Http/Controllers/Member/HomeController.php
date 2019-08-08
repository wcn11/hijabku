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
use DOMPDF;
use App\Bukti;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class HomeController extends Controller
{

    protected $redirectTo = '/member/login';

    /**
     * Create a new controller instance.
     *git 
     *
     * @return \Illuminate\Http\Response
     */
    public function provinsi(){
        $client = new Client();

        try{
            $response = $client->get('https://api.rajaongkir.com/starter/province', array(
                'headers' => array(
                    'key' => '11b95e155f2f1d73259d2cf17d424d1b',
                )
            ));
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();

        $array_result = json_decode($json, true);

        // print_r($array_result);

        return $array_result['rajaongkir']['results'];
    }

    public function kota(){
        $client = new Client();

        try{
            $response = $client->get('https://api.rajaongkir.com/starter/city', array(
                'headers' => array(
                    'key' => '11b95e155f2f1d73259d2cf17d424d1b',
                )
            ));
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();

        $array_result = json_decode($json, true);

        // print_r($array_result);

        return $array_result['rajaongkir']['results'];
    }

    public function ongkir(Request $request){
        $bogor = 79;
        $kurir = $request->kurir;
        $tujuan = $request->kode_kota;

        $client = new Client();

        try{
            $response = $client->request("POST", 'https://api.rajaongkir.com/starter/cost', array(
                'body' => "origin=79&destination=".$tujuan."&weight=1000&courier=". $kurir."",
                'headers' => [
                    'key' => '11b95e155f2f1d73259d2cf17d424d1b',
                    'content-type' => 'application/x-www-form-urlencoded',
                ]
            ));
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();

        $array_result = json_decode($json, true);

        // print_r($array_result);

        return $array_result['rajaongkir']['results'];
    }


    public function index() {

        if(Auth::guard("member")->check()){
            $kategori = Kategori::all();
    
            $barang = Barang::all();
    
            // Session::put("keranjang", Keranjang::where("id_member", Auth::guard("member")->user()->id_member)->get());
    
            // $keranjang = Keranjang::where("id_member", Auth::guard("member")->user()->id_member)->get();

            $invoice = Invoice::where("id_member", Auth::guard("member")->user()->id_member)->get();

            Session::put("invoice", $invoice);

            return view('member.home', compact("kategori", "barang"));
        }
    }

    public function data_keranjang(){
        $keranjang = Keranjang::where("id_member", Auth::guard("member")->user()->id_member)->get();

        $kode_barang = []; //hanya untuk mengeluarkan relasi    
        
        foreach($keranjang as $k){  
            $kode_barang[] = array($k->barang_ke_keranjang);
        }

        return response()->json($keranjang);
    }

    public function data_invoice(){
        $invoice = Invoice::where("id_member", Auth::guard("member")->user()->id_member)->get();

        $kode_invoice = []; //hanya untuk mengeluarkan relasi    
        
        foreach($invoice as $i){  
            $kode_invoice[] = array($i->kode_invoice);
        }

        return response()->json($invoice);
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

    public function data_history(){
        $history = Invoice::where("id_member", Auth::guard("member")->user()->id_member)->where("status", "terkonfirmasi")->get();

        return response()->json($history);
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

        date_default_timezone_set("Asia/Jakarta");

        $tanggal = date("Y-m-d H:i:s");

        $tanggal_sekarang = substr($tanggal, strrpos($tanggal, "-") + 1, 3);

        $tanggal_pengganti = substr($tanggal, strrpos($tanggal, "-") + 1, 2) + 7;
        
        $jatuh_tempo = str_replace($tanggal_sekarang, $tanggal_pengganti." ", $tanggal);

        $id_member = Member::max("id_member");

        $id_member_slash = strrpos($id_member, "-");

        $id_member_substr = substr($id_member, $id_member_slash + 1) +1;

        $invoice_max = Invoice::max("kode_invoice");

        $invoice_substr = substr($invoice_max, strrpos($invoice_max, "-") + 1) + 1;

        $invoice = new Invoice;

        $invoice->kode_invoice = "INV-".$id_member_substr."-".$invoice_substr;

        $invoice->id_member = Auth::guard("member")->user()->id_member;

        $invoice->tanggal_invoice = $tanggal;

        $invoice->jatuh_tempo = $jatuh_tempo;

        $invoice->status = "belum dibuat";

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

        $barang = Barang::find($kode_keranjang->kode_barang);

        $stok_barang = $barang->stok;

        $barang->stok = $stok_barang - 1;

        $barang->update();

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

        date_default_timezone_set("Asia/Jakarta");

        $tanggal = date("Y-m-d H:i:s");

        $tanggal_sekarang = substr($tanggal, strrpos($tanggal, "-") + 1, 3);

        $tanggal_pengganti = substr($tanggal, strrpos($tanggal, "-") + 1, 2) + 7;
        
        $jatuh_tempo = str_replace($tanggal_sekarang, $tanggal_pengganti." ", $tanggal);

        $invoice = Invoice::find($kode_invoice);

        $invoice->atas_nama = $request->atas_nama;

        $invoice->alamat_penerima = $request->alamat_penerima;

        $invoice->tanggal_invoice = $tanggal;

        $invoice->jatuh_tempo = $jatuh_tempo;

        $invoice->telepon = $request->telepon;

        $invoice->ongkir = $request->ongkir;

        $invoice->total = $request->total;

        $invoice->status = "menunggu pembayaran";

        $invoice->update();

        // Session::flash("invoice", "berhasil");
        
        return redirect()->route("member.lihat_invoice", $kode_invoice);
    }

    public function lihat_invoice($kode_invoice){

        $invoice = Invoice::find($kode_invoice);

        $invoice_sum = Invoice_barang::where("kode_invoice", $kode_invoice)->sum("total");

        $member = Member::find(Auth::guard("member")->user()->id_member);

        $bank = Bank::all();

        return view("member.lihat_invoice", compact('invoice', "invoice_sum", "member", "bank"));
    }

    public function print_invoice($kode_invoice){

        $invoice = Invoice::find($kode_invoice);

        $invoice_sum = Invoice_barang::where("kode_invoice", $kode_invoice)->sum("total");

        $member = Member::find(Auth::guard("member")->user()->id_member);

        $bank = Bank::all();

        return view("member.print_invoice", compact('invoice', "invoice_sum", "member", "bank"));
    }

    public function konfirmasi_pembayaran(){
        return view("member.konfirmasi_pembayaran");
    }

    public function upload_bukti(Request $request){
        
        $cek = Invoice::find($request->kode_invoice);
        
        $cek_ada = Bukti::where("kode_invoice", $request->kode_invoice)->get();

        if(!empty($cek)){

            if(count($cek_ada) > 0){

                Session::flash("invoice_sudah_ada", "gagal");

                return redirect()->back();

            }else{
                
                $id_member = Member::max("id_member");

                $id_member_slash = strrpos($id_member, "-");

                $id_member_substr = substr($id_member, $id_member_slash + 1) +1;

                $invoice_substr = substr($request->kode_invoice, strrpos($request->kode_invoice, "-") + 1) + 1;
                
                $bukti_max = Bukti::max("kode_bukti");

                $bukti_substr = substr($bukti_max, strrpos($bukti_max, "-") + 1) + 1;
                
                $bukti = new Bukti;

                $bukti->kode_bukti = "BKT-".$id_member_substr."-".$invoice_substr."-".$bukti_substr;

                $bukti->id_member = $id_member;

                $bukti->kode_invoice = $request->kode_invoice;

                //upload foto
                
                $bukti_pembayaran = $request->file("bukti_pembayaran");
                
                $tujuan_upload = 'images/bukti/';

                $nama_file = time()."-".$bukti_pembayaran->getClientOriginalName();
                
                $bukti_pembayaran->move($tujuan_upload, $nama_file);

                $bukti->bukti = $nama_file;

                $bukti->tanggal_upload = now();

                // $bukti->status = "menunggu konfirmasi";

                $bukti->save();

                $invoice = Invoice::find($request->kode_invoice);

                $invoice->status = "menunggu konfirmasi";

                $invoice->update();

                Session::flash("invoice_berhasil", "berhasil");

                return redirect()->back();
            }
        }else{
            Session::flash("invoice_tidak_ada", "gagal");

            return redirect()->back();
        }
    }

    public function hapus_invoice($kode_invoice){
        $invoice = Invoice::find($kode_invoice);

        $invoice->delete();

        Session::flash("invoice_hapus", "berhasil");

        return redirect()->route("member.dashboard");
    }

    public function lihat_bukti_menunggu($kode_invoice){

        $invoice = Invoice::find($kode_invoice);

        $invoice_sum = Invoice_barang::where("kode_invoice", $kode_invoice)->sum("total");

        $member = Member::find(Auth::guard("member")->user()->id_member);

        $bank = Bank::all();

        // echo $invoice->invoice_ke_bukti[0]['bukti'];
        return view("member.invoice_menunggu", compact("invoice", "bank", "member", "invoice_sum"));
    }

    public function update_bukti(Request $request){

        $bukti = Bukti::find($request->kode_bukti);

        File::delete("images/bukti/".$bukti->bukti);

        $bukti_pembayaran = $request->file("bukti_update");
                
        $tujuan_upload = 'images/bukti/';

        $nama_file = time()."-".$bukti_pembayaran->getClientOriginalName();
        
        $bukti_pembayaran->move($tujuan_upload, $nama_file);

        $bukti->bukti = $nama_file;

        $bukti->update();

        $invoice = Invoice::find($request->kode_invoice);

        $invoice->status = "menunggu konfirmasi";

        $invoice->update();

        Session::flash("update_bukti", "berhasil");

        return redirect()->back();

        // echo $invoice->invoice_ke_bukti[0]['bukti'];
        // return view("member.invoice_menunggu", compact("invoice", "bank", "member", "invoice_sum"));
    }

    public function lihat_bukti_history($kode_invoice){

        $invoice = Invoice::find($kode_invoice);

        $invoice_sum = Invoice_barang::where("kode_invoice", $kode_invoice)->sum("total");

        $bukti = $invoice->invoice_ke_bukti;

        $member = Member::find(Auth::guard("member")->user()->id_member);

        $bank = Bank::all();

        return view("member.invoice_history", compact("invoice", "bank", "member", "invoice_sum", "bukti"));
    }

    public function profil_default(Request $r){
        $member = Member::find(Auth::guard("member")->user()->id_member);

        $member->nama = $r->nama;

        $member->email = $r->email;

        $member->alamat = $r->alamat;

        $member->telepon = $r->telepon;

        if($r->has("pp")){
            $pp = $r->file("pp");
                    
            $tujuan_upload = 'images/member/';
    
            $nama_file = time()."-".$pp->getClientOriginalName();
            
            $pp->move($tujuan_upload, $nama_file);
    
            $member->profil = $nama_file;
        }

        $member->update();

        Session::flash("update_profil", "berhasil");

        return redirect()->back();
    }

    public function profil_baru(Request $r){
        $member = Member::find(Auth::guard("member")->user()->id_member);

        $member->nama = $r->nama;

        $member->email = $r->email;

        $member->alamat = $r->alamat;

        $member->telepon = $r->telepon;

        if($r->has("pp")){
            
            File::delete("images/member/".$member->profil);

            $pp = $r->file("pp");
                    
            $tujuan_upload = 'images/member/';
    
            $nama_file = time()."-".$pp->getClientOriginalName();
            
            $pp->move($tujuan_upload, $nama_file);
    
            $member->profil = $nama_file;
        }

        $member->update();

        Session::flash("update_profil", "berhasil");

        return redirect()->back();
    }
}