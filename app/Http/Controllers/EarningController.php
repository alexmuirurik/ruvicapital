<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Earning;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreEarningRequest;
use App\Http\Requests\UpdateEarningRequest;
use App\Mail\EarningAwarded;

class EarningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(in_array($request->user()->user_type, ['admin', 'super_admin'])){
            $earnings = Earning::where('status', 'working_capital')->orWhere('user_id', $request->user()->id)->orderByDesc('created_at')->paginate(30);
        }else{
            $earnings = Earning::where('user_id', $request->user()->id)->orderByDesc('created_at')->paginate(30);
        }
        
        return view('pages.earnings', compact('earnings'));
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
    public function store(StoreEarningRequest $request)
    {
        $earnings = Earning::where('status', 'working_capital')->get();
        if(empty($earnings)) return back()->withErrors(['profits' => 'There are no users to award profits today']);

        Earning::where('status', 'working_capital')->lazyById()->each(function(object $earning){
            $day = now()->day.'_'.now()->month.'_'.now()->year;
            $increment = ($earning->ie_increments) ? json_decode($earning->ie_increments) : [];
            if(isset($increment->$day)) return redirect('/earnings')->withErrors(['awarded' => 'We cannot award profit twice on the same day']);

            $profit    = $earning->working_capital * 0.01;
            $increment[$day]    =   $profit;
            Earning::where('id', $earning->id)->update([
                'interest_earnings' => $earning->interest_earnings + $profit,
                'ie_increments'     => json_encode($increment)
            ]);
        });
        
        $title = 'Welcome to the Ruvi Capital Investment Team';
        $body = 'Thank you for participating!';

        // Mail::to($request->email)->send(new EarningAwarded($title, $body));
        return redirect('/earnings');
    }

    /**
     * Display the specified resource.
     */
    public function show(Earning $earning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Earning $earning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEarningRequest $request, Earning $earning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Earning $earning)
    {
        //
    }
}
