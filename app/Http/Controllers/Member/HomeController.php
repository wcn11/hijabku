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
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('member.auth:member');
    }

    /**
     * Show the Member dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if(Auth::guard("member")->check()){
            $kategori = Kategori::all();
    
            $barang = Barang::all();
    
            Session::put("keranjang", Keranjang::where("id_member", Auth::guard("member")->user()->id_member)->get());
    
            // $keranjang = Keranjang::where("id_member", Auth::guard("member")->user()->id_member)->get();

            return view('member.home', compact("kategori", "barang"));
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

}