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
}
