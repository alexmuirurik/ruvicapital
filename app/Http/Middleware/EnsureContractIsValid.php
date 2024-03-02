<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Deposit;
use App\Models\Contract;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureContractIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $contract = Contract::where('user_id', $request->user()->user_id)->where('status', 'active_contract')->first();
        $deposit  =  Deposit::where('user_id', $request->user()->user_id)->where('status', 'pending_receipt')->first();
        if(!$contract and $deposit){
            session()->flash('notification', 'Please sign your contract forms. You can\'t earn interests from your deposits until you do so.'); 
        }

        if(!$request->user()->email_verified_at){
            session()->flash('notification', 'Please verify your email. We\'ve sent you an email to you with a link to do so. ');
        }

        return $next($request);
    }
}
