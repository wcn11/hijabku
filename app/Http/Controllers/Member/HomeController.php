<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

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
        return view('member.home');
    }

}