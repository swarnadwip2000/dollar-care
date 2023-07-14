<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.auth.login');
    }

    public function register()
    {
        return view('frontend.auth.register');
    }

    public function loginCheck(Request $request)
    {                           
        $request->validate([
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|exists:users,email',
            'password' => 'required|min:8|max:20',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // dd(session()->all());
            $user = Auth::user();
            $location = Location::where('user_id', $user->id)->latest('id')->first();
            if ($user->status == true) {
                if ($location || session()->has('latitude')) {
                    if ($user->hasRole('DOCTOR')) {
                        return redirect()->route('doctor.dashboard');
                    } else if ($user->hasRole('PATIENT')) {
                        return redirect()->route('patient.dashboard');
                    } else {
                        Auth::logout();
                        return redirect()->back()->with('error', 'Your account is not active. Please contact with admin');
                    }
                } else {
                    Auth::logout();
                    return view('frontend.auth.location');
                }
            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'Your account is not active. Please contact with admin');
            }
        } else {
            return redirect()->back()->with('error', 'Email or Password is incorrect');
        }
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'phone' => 'required|numeric',
            'type' => 'required',
            'email' => 'required|unique:users,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:8|max:20',
            'confirm_password' => 'required|min:8|max:20|same:password',
        ],[
            'first_name.required' => 'Please enter first name',
            'last_name.required' => 'Please enter last last name',
            'gender.required' => 'Please select a gender',
            'age.required' => 'Please enter age',
            'phone.required' => 'Please enter phone number',
            'phone.numeric' => 'Phone number must be numeric',
            'type.required' => 'Please select a type',
            'email.required' => 'Please enter email address',
            'email.unique' => 'Email address already exists',
            'email.regex' => 'Please enter valid email address',
            'password.required' => 'Please enter password',
            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password must be at most 20 characters',
            'confirm_password.required' => 'Please enter confirm password',
            'confirm_password.min' => 'Confirm password must be at least 8 characters',
            'confirm_password.max' => 'Confirm password must be at most 20 characters',
            'confirm_password.same' => 'Confirm password does not match',
        ]);

        $user = new User();
        $user->name = $request->first_name.' '.$request->last_name;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = true;
        $user->save();

        if ($user->type == 'Doctor') {
            $user->assignRole('DOCTOR');
        } else {
            $user->assignRole('PATIENT');
        } 

        $maildata = [
            'name' => $request->name.' '.$request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
        ];
        Mail::to($request->email)->send(new WelcomeMail($maildata));

        return redirect()->route('login')->with('message', 'Registration successful. Please login');
    }

    public function patientLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function doctorLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
