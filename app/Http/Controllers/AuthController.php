<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    //
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/(^[A-Za-z]+$)+/',
            'lastName' => 'required|regex:/(^[A-Za-z]+$)+/',
            'login' => 'required|unique:uzytkownicy|min:8|regex:/(^[A-Za-z0-9_.-]+$)+/',
            'email' => 'required|email|unique:uzytkownicy',
            'password' => 'required|min:8',
            'passwordConfirm' => 'required|same:password'
        ]);
        if($validator->fails()) {
            return redirect()->route('welcome')
                        ->withErrors($validator, 'register')
                        ->withInput();
        }
        $user = new User();
        $user->imie = $request->name;
        $user->nazwisko = $request->lastName;
        $user->email = $request->email;
        $user->login = $request->login;
        $user->haslo = Hash::make($request->password);
        if($user->save()) {
            Auth::login($user);
            event(new Registered($user));
            return redirect()->route('verification.notice');
        }
    }

    public function login(Request $request) {
        $credentials = $request->only(['login', 'password']);
        if (Auth::attempt($credentials)) {
            return redirect()->route('welcome');
        }
        return redirect()->route('welcome')->withInput()->withErrors(['Login albo hasło niepoprawne'], 'login');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }

    public function verifyNotice() {
        return view('auth.verify');
    } 

    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();
        
        return redirect()->route('welcome');
    }

    public function verifyResend(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
