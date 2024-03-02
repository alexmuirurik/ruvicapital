<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Deposit;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Mail\ContractCreated;
use App\Mail\ContractTerminated;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(in_array($request->user()->user_type, ['admin', 'super_admin'])){ 
            $contracts = Contract::where('status', 'active_contract')->join('users', 'users.id', '=', 'contracts.user_id')
            ->orderByDesc('contracts.created_at')->paginate(30);
        }else{
            $contracts = Contract::where('user_id', $request->user()->id)->join('users', 'users.id', '=', 'contracts.user_id')
            ->orderByDesc('contracts.created_at')->paginate(30);
        }
        
        return view('pages.contract', compact('contracts'));
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
    public function store(StoreContractRequest $request)
    {
        $contract = Contract::where('user_id', $request->user()->id)->where('status', 'active_contract')->first();
        if($contract) return back()->withErrors(['Duplicate' => 'Sorry an Active Contract Already Exists']);

        $deposit   = Deposit::where('user_id', $request->user()->id)->where('status', 'pending_receipt')->first();
        if(!$deposit) return back()->withErrors(['Deposit' => 'Sorry we need you to make a deposit first before we proceed']);

        $month  =   Carbon::now()->addMonths((int)$request->withdraw);
        $create_contract = Contract::create([
            'udeposit_id'   => $deposit->udeposit_id,
            'user_id'       => $request->user()->id,
            'termination_date' => $month,
            'amount'        =>  $deposit->amount,
            'status'        => 'active_contract'
        ]);

        if($create_contract){
           $request->session()->forget('contract'); 
        }

        $title = 'Welcome to the Ruvi Capital Investment Team';
        $body = 'Thank you for participating!';

        // Mail::to($request->email)->send(new ContractCreated($title, $body));

        return redirect('contract');

    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        if(!$contract) return back()->withErrors(['contract' => 'The User does not have an active contract']);
        
        $contract->update([ 'status'    =>  'contract_terminated' ]);
        $title = 'Welcome to the Ruvi Capital Investment Team';
        $body = 'Thank you for participating!';

        // Mail::to($request->email)->send(new ContractTerminated($title, $body));
        return back()->with('success', 'Contract Terminated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
