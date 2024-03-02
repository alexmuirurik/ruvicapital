<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Userlog;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Jenssegers\Agent\Facades\Agent;
use App\Http\Controllers\Controller;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Jenssegers\Agent\Agent as AgentAgent;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'gender'    => ['required', 'string', 'max:255'],
            'mobile'    => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $username   = \Illuminate\Support\Str::slug($request->firstname.$request->lastname);
        $check_user = User::where('username', $username)->orWhere('email', $request->email)->first();
        if($check_user) return back()->withErrors(['duplicate' => 'User already exists. Try using a different name or email address']);

        $countusers = User::count();
        $gender = ($request->gender === 'male') ? 'men' : 'women';
        $user = User::create([
            'firstname'     => $request->firstname,
            'lastname'      => $request->lastname,
            'names'         => $request->firstname. ' ' . $request->lastname,
            'username'      => $username,
            'user_type'     => 'investor',
            'last_seen'     => time(),
            'profile_img'   => 'https://randomuser.me/api/portraits/'.$gender.'/'.$countusers.'.jpg',
            'gender'        => $request->gender,
            'referrer'      => $request->referrer,
            'mobile'        => $request->mobile,
            'status'        => 'unverified',
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $user_id =  User::select('id')->where('username', $username)->first();
        Userlog::create([
            'user_id'       => $user_id->id,
            'ip_address'    => $request->ip(),
            'browser'       => Agent::browser(),
            'os'            => Agent::platform(),
            'device'       => Agent::device(),
        ]);

        $title = 'Welcome to the Ruvi Capital Investment Team';
        $body = 'Thank you for participating!';

        Mail::to($request->email)->send(new UserRegistered($title, $body));

        return redirect(RouteServiceProvider::HOME);
    }
}
