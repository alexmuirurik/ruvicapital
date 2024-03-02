<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Earning;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class HomeController extends Controller{
    public function index(Request $request){
        if(in_array($request->user()->user_type, ['admin', 'super_admin'])){
            $earnings   = Earning::where('status', 'working_capital')->orWhere('user_id', $request->user()->user_id)
            ->orderByDesc('created_at')->paginate(10);
            $earning    = [
                'working_capital'       => $earnings->sum('working_capital'),
                'wc_increments'         => $earnings->sum(function ($earnings) { return array_sum((array)json_decode($earnings->wc_increments)); }),
                'interest_earnings'     => $earnings->sum('interest_earnings'),
                'ie_increments'         => $earnings->sum(function ($earnings) { return array_sum((array)json_decode($earnings->ie_increments)); }),
                'withdrawable_earnings' => $earnings->sum('working_capital') + $earnings->sum('interest_earnings'),
                'we_increments'         => $earnings->sum('interest_earnings')
            ];

            $deposits = Deposit::where('status', 'pending_receipt')->orWhere('user_id', $request->user()->user_id)
            ->orderByDesc('created_at')->paginate(10)
            ->merge(
                Withdraw::where('status', 'pending_disbursement')->orWhere('user_id', $request->user()->user_id)
                ->orderByDesc('created_at')->paginate(10)
            );

            $chartearnings   =   (array)Earning::select('interest_earnings')->orderByDesc('created_at')->paginate(12);
            $chartdeposits   =   (array)Earning::select('working_capital')->orderByDesc('created_at')->paginate(12);

            return view('pages.adminboard', compact('deposits', 'earning', 'chartearnings', 'chartdeposits'));
        }else{
            $deposits   = Deposit::where('user_id', $request->user()->user_id)->orderByDesc('created_at')->paginate(10)->merge(
                Withdraw::where('user_id', $request->user()->user_id)->orderByDesc('created_at')->paginate(10)
            );
            $earning   = Earning::where('user_id', $request->user()->user_id)->where('status', 'working_capital')->first();

            $chartdeposits   =   (array)Earning::select('working_capital')->where('user_id', $request->user()->id)
            ->orderByDesc('created_at')->paginate(12);
            $chartearnings   =   (array)Earning::select('interest_earnings')->where('user_id', $request->user()->id)
            ->orderByDesc('created_at')->paginate(12);
            
            return view('pages.dashboard', compact('deposits', 'earning', 'chartearnings', 'chartdeposits'));
        }
    }

    public function ajaxChart(Request $request) {
        if(in_array($request->user()->user_type, ['admin', 'super_admin'])){
            
        }else{
            $deposits   =   Earning::select('working_capital')->where('user_id', $request->user()->id)->orderByDesc('created_at')->paginate(12);
            $earnings   =   Earning::select('working_capital')->where('user_id', $request->user()->id)->orderByDesc('created_at')->paginate(12);
        }

        return [ 
            [ 'name' => "Deposits", 'data' => [42, 52, 16, 55, 59, 51, 45, 32, 26, 33, 44, 51] ], 
            [ 'name' => "Earnings", 'data' => [6, 12, 4, 7, 5, 3, 6, 4, 3, 3, 5, 6] ]
        ];
    }
}