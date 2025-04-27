<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccess;

class RegistrationController extends Controller
{
    // عرض الفورمة
    public function showForm()
    {
        $registrations = Registration::latest()->get();
        return view('register', compact('registrations'));
    }

    // معالجة التسجيل
    public function register(Request $request)
    {
        // التحقق من البيانات
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

        // تخزين البيانات في قاعدة البيانات
        $registration = Registration::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // إرسال الإيميل
        Mail::to($request->email)->send(new RegistrationSuccess($registration));

        return redirect()->route('register.form')->with('success', 'Registration successful. Please check your email!');
    }
}
