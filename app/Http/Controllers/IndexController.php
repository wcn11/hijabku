<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Barang;
use App\Keranjang;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        if(Auth::guard("member")->check()){
            return redirect()->route("member.dashboard");
        }else{
            
            $kategori = Kategori::all();

            $barang = Barang::all();

            return view("member/home", compact("kategori", "barang"));
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

            return response()->json("berhasil");

        }else{
            return response()->json("belum_login");
        }
    }
}
