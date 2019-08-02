<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kategori;
use Illuminate\Support\Facades\Session;
class KategoriController extends Controller
{
    public function index(){
        $kategori = Kategori::all();
        
        return view("admin.kategori", compact('kategori'));
    }

    public function tambah_kategori(Request $request){
        
        $kategori = new Kategori;

        $kategori_max = Kategori::max("kode_kategori");

        $kategori_slash = strrpos($kategori_max, "-");

        $kategori_substr = substr($kategori_max, $kategori_slash + 1) + 1;

        $kategori->kode_kategori = "KTG-".$kategori_substr;

        $kategori->nama_kategori = $request->nama_kategori;

        $kategori->save();

        Session::flash("tambah_kategori", "berhasil");

        return redirect()->back();

        // return view("admin.kategori", compact('kategori'));
    }
    
    public function hapus_kategori($kk){
        $kategori = Kategori::find($kk);

        $kategori->delete();

        Session::flash("hapus_kategori", "berhasil");

        return redirect()->back();
    }
    
    public function update_kategori(Request $request){

        $kategori = Kategori::find($request->kode_kategori);

        $kategori->nama_kategori = $request->nama_kategori;

        $kategori->update();

        Session::flash("update_kategori", "berhasil");

        return redirect()->back();
    }
}
