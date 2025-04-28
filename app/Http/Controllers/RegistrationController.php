<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccess;

class RegistrationController extends Controller
{
    // afficher form
    public function showForm()
    {
        $registrations = Registration::latest()->get();
        return view('register', compact('registrations'));
    }

    // process login
    public function register(Request $request)
    {
        // check database
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => [
                'required',
                'email',
                'unique:registrations,email',
                function($attribute, $value, $fail) {
                    if (!str_ends_with($value, '@gmail.com')) {
                        $fail('The email must be a gmail.com address.');
                    }
                },
            ],
            'password' => 'required|string|min:6|confirmed',
        ]);

        // stocker les données
        $registration = Registration::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // send email
        Mail::to($request->email)->send(new RegistrationSuccess($registration));

        return redirect()->route('register.form')->with('success', 'Registration successful. Please check your email!');
    }
}
