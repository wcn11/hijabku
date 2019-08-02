<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Barang;
use Illuminate\Support\Facades\Session;
use App\Kategori;

class BarangController extends Controller
{
    public function index(){
        $barang = Barang::all();

        $kategori = Kategori::all();

        return view("admin.barang", compact('barang', 'kategori'));
    }

    public function tambah_barang(Request $request){

        $barang = new Barang;

        $kode_kategori = $request->kode_kategori;

        $kode_kategori_slash = strrpos($kode_kategori, "-");

        $kode_kategori_substr = substr($kode_kategori, $kode_kategori_slash + 1);

        $kode_barang = Barang::max("kode_barang");

        $kode_barang_slash = strrpos($kode_barang,"-");

        $kode_barang_substr = substr($kode_barang, $kode_barang_slash + 1) + 1;

        $barang->kode_barang = "BRG-".$kode_kategori_substr."-".$kode_barang_substr;

        $barang->kode_kategori = $request->kategori_barang;

        $barang->nama_barang = $request->nama_barang;

        $barang->stok = $request->stok_barang;

        $barang->keterangan = $request->keterangan_barang;

        $barang->gambar = $request->gambar_barang;

        $barang->harga_barang = $request->harga_barang;

        $barang->save();

        Session::flash("update_barang", "berhasil");

        return redirect()->back();

    }

    public function update_barang(Request $request){

        $barang = Barang::find($request->kode_barang);

        $barang->gambar = $request->gambar_barang;

        $barang->nama_barang = $request->nama_barang;

        $barang->stok = $request->stok_barang;

        $barang->keterangan = $request->keterangan_barang;

        $barang->harga_barang = $request->harga_barang;

        $barang->kode_kategori = $request->kategori_barang;

        $barang->update();

        Session::flash("update_barang", "berhasil");

        return redirect()->back();

    }

    public function hapus_barang($kode_barang){

        $barang = Barang::find($kode_barang);

        $barang->delete();

        Session::flash("hapus_barang", "berhasil");

        return redirect()->back();

    }
}
