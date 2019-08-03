<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    public function index(){
        $member = Member::all();

        return view("admin.member", compact("member"));
    }
    public function hapus_member($id_member){
        $member = Member::find($id_member);

        $member->delete();

        Session::flash("hapus_member", "berhasil");

        return redirect()->back();
    }
}
