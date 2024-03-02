<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreWithdrawRequest;
use App\Http\Requests\UpdateWithdrawRequest;
use App\Mail\MoneyDisbured;
use App\Mail\WithdrawMade;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(in_array($request->user()->user_type, ['admin', 'super_admin'])){
            $withdraws  =  Withdraw::where('status', 'pending_disbursement')->orWhere('user_id', $request->user()->user_id)->paginate(30);
        }else{
            $withdraws  =  Withdraw::where('user_id', $request->user()->user_id)->paginate(30);
        }
        
        $earning    =  Earning::where('user_id', $request->user()->user_id)->where('status', 'working_capital')->first();
        return view('pages.withdraw', compact('withdraws', 'earning'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWithdrawRequest $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);

        $earning    =  Earning::where('user_id', $request->user()->user_id)->where('status', 'working_capital')->first();
        $withdraw   =  Withdraw::where('user_id', $request->user()->user_id)->where('status', 'pending_disbursement')->first();
        $withdrawable = $earning?->working_capital + $earning?->interest_earnings;
        if($withdrawable < $request->amount) return back()->withErrors(['amount' => 'You Don\'t have enough funds to withdraw $'.$request->amount])->withInput();

        if($withdraw){
            Withdraw::where('user_id', $request->user()->user_id)->where('status', 'pending_disbursement')->update([
                'amount'    => $request->amount + $withdraw->amount
            ]);
        }

        if(!$withdraw){
            Withdraw::create([
                'earning_id'        => $request->user()->id,
                'user_id'           => $request->user()->id,
                'amount'            => $request->amount,
                'contact_number'    => $earning->slug,
                'status'            => 'pending_disbursement'
            ]);
        }

        $title = 'Welcome to the Ruvi Capital Investment Team';
        $body = 'Thank you for participating!';

        Mail::to($request->email)->send(new WithdrawMade($title, $body));
        return redirect('withdraw');
    }

    /**
     * Display the specified resource.
     */
    public function show(Withdraw $withdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Withdraw $withdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWithdrawRequest $request, Withdraw $withdraw)
    {
        if(!$withdraw) return back()->withErrors(['withdraw' => 'Withdraw Request Does Not exist']);

        $withdraw->update([ 'status' => 'funds_sent' ]);
        $title = 'Welcome to the Ruvi Capital Investment Team';
        $body = 'Thank you for participating!';

        // Mail::to($request->email)->send(new MoneyDisbured($title, $body));
        return back()->with('success', 'Withdraw Request Marked as Sent');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Withdraw $withdraw)
    {
        //
    }
}
