<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Earning;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreDepositRequest;
use App\Http\Requests\UpdateDepositRequest;
use App\Mail\DepositApproved;
use App\Mail\DepositMade;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(in_array($request->user()->user_type, ['admin', 'super_admin'])){
            $deposits = Deposit::where('status', 'pending_receipt')->orWhere('user_id', $request->user()->id)
            ->join('users', 'users.id', '=', 'deposits.user_id')->orderByDesc('created_at')->paginate(30);
        }else{
            $deposits = Deposit::where('user_id', $request->user()->id)->join('users', 'users.id', '=', 'deposits.user_id')
            ->orderByDesc('deposits.created_at')->paginate(30);
        }

        return view('pages.deposits', compact('deposits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect('/deposits');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepositRequest $request)
    {
        $request->validate([
            'amount'    => 'required',
        ]); 

        $deposit   =  Deposit::where('user_id', $request->user()->id)->where('status', 'pending_receipt')->first();

        if($deposit){
            $increment = ($deposit->increment) ? json_decode($deposit->increment) : [];
            array_push($increment, $request->amount);
            Deposit::where('user_id', $request->user()->id)->where('status', 'pending_receipt')->update([
                'amount'    => $deposit->amount + $request->amount,
                'increment' => json_encode($increment),
            ]);
        }

        if(!$deposit){
            Deposit::create([
                'user_id'   =>  $request->user()->id,
                'amount'    =>  $request->amount,
                'increment' =>  json_encode([]),
                'status'    =>  'pending_receipt',
            ]);
        }
        
        $title = 'Welcome to the Ruvi Capital Investment Team';
        $body = 'Thank you for participating!';

        // Mail::to($request->user()->email)->send(new DepositMade($title, $body));
        return redirect('/deposits');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deposit $deposit)
    {

        return print_r($deposit);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deposit $deposit)
    {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepositRequest $request, Deposit $deposit)
    {
        if(!$deposit) return redirect('/deposit')->withErrors(['deposit'=>'We Couldn\'t find a Deposit by that ID'])->withInput();

        $update_deposit = $deposit->update(['status' => 'funds_received']);
        if(!$update_deposit) return redirect('/deposits')->withErrors(['deposit', 'We encountered an Error Approving the Deposit!'])->withInput();

        $earning    = Earning::where('user_id', $deposit->user_id)->where('status', 'working_capital')->first();
        if($earning){
            $increment = ($earning->wc_increments) ? json_decode($earning->wc_increments) : [];
            array_push($increment, $deposit->amount);
            Earning::where('username', $deposit->username)->where('status', 'working_capital')->update([
                'working_capital'   => $earning->working_capital + $deposit->amount,
                'wc_increments'     => json_encode($increment)
            ]);
        }
        
        if(!$earning){
            print( 'console->log(\'ddssd\')' );
            Earning::create([
                'user_id'           =>  $deposit->user_id,
                'deposit_id'        =>  $deposit->id,
                'slug'              =>  $deposit->udeposit_id,
                'working_capital'   =>  $deposit->amount,
                'wc_increments'     =>  json_encode([]),
                'month'             =>  date('Y-m-d H:i:s'), 
                'status'            =>  'working_capital'
            ]);
        }
            
        $title = 'Welcome to the Ruvi Capital Investment Team';
        $body = 'Thank you for participating!';

        // Mail::to($request->email)->send(new DepositApproved($title, $body));
        return redirect('/earnings');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deposit $deposit)
    {
        return redirect('/deposits');
    }
}
