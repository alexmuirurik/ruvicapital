<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Userlog;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(in_array($request->user()->user_type, ['admin', 'super_admin'])){
            $users = User::where('user_type', 'investor')->select(
                'users.username', 
                'users.profile_img',
                'users.names',
                'users.user_type',
                'users.status',
                'users.created_at',
                DB::Raw('SUM(referrals.deposit_amount) as deposit'),
                DB::Raw('SUM(referrals.referrer_commission) as commission')
            )->leftJoin('referrals', 'referrals.user_id', '=', 'users.id')->whereNot('referrals.referrer_status', 'paid')
            ->groupBy('username', 'profile_img', 'names', 'user_type', 'status', 'created_at')->paginate(30);
        }else{
            $users = User::where('referrer', $request->user()->referral_id)->join('referrals', 'referrals.user_id', '=', 'users.id')
            ->whereNot('referrals.referrer_status', 'paid')->paginate(30);
        }
        
        return view('pages.user', compact('users'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Request $request)
    {
        $userlogs   = Userlog::where('user_id', $user->id)->orderByDesc('created_at')->paginate(3);
        $referrals  = Referral::where('referrer_id', $request->user()->referral_id)->get();
        return view('pages.profile', compact('user', 'userlogs', 'referrals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $referral_id = User::where('referral_id', $request->referral)->first();
        $profile_img = $user->profile_img;
        if($request->profile_img !== null){
            $file     = $request->file('profile_img');
            $filename = 'img/users/'.$request->user()->username.'.'.$file->getClientOriginalExtension();
            $filePath = Storage::putFileAs( 'public', $file, $filename);
            $profile_img = '/storage/'.$filename;
        }

        if($referral_id && $referral_id->referral_id !== $user->referral_id){
            return back()->withErrors(['duplicate' => 'Referral ID is already in use by another user']);
        }

        $updateUser = $user->update([
            'profile_img'   => $profile_img,
            'names'         => $request->names,
            'referral_id'   => $request->referral,
            'firstname'     => $request->firstname,
            'lastname'      => $request->lastname,
            'email'         => $request->email,
            'mobile'        => $request->mobile
        ]);


        if($updateUser){
            return redirect(route('user.show', $request->user()->username));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
