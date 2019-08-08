<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Invoice;

class Jatuh_tempo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard("member")->check()){
            $member = Invoice::where("id_member", Auth::guard("member")->user()->id_member)->where("status", "menunggu pembayaran")->get();

            foreach($member as $m){
                $invoice = Invoice::find($m->kode_invoice);

                if($invoice->jatuh_tempo < now()){
                    $invoice->status = "jatuh tempo";

                    $invoice->update();
                }
            }
        }
        return $next($request);
    }
}
