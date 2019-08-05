<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Kategori;
use App\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Barang;
use Illuminate\Http\Request;

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
            $keranjang = Keranjang::where("kode_barang", $kode_barang)->where("id_member", Auth::guard("member")->user()->id_member)->delete();
        }else{
            $keranjang = Keranjang::find($request->kode_keranjang);
            $keranjang->delete();
        }

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

            return response()->json($kode_barang);

        }else{
            return response()->json("belum_login");
        }
    }

}