<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccess;

/**
 * Controller pour gérer les inscriptions des utilisateurs
 * Controller to handle user registrations
 * وحدة تحكم لمعالجة تسجيلات المستخدمين
 */
class RegistrationController extends Controller
{
    /**
     * Affiche le formulaire d'inscription avec la liste des inscriptions récentes
     * Display the registration form with list of recent registrations
     * عرض نموذج التسجيل مع قائمة التسجيلات الأخيرة
     * 
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        // Récupère les inscriptions les plus récentes
        // Get the most recent registrations
        // الحصول على التسجيلات الأخيرة
        $registrations = Registration::latest()->get();
        
        // Affiche la vue 'register' avec les données des inscriptions
        // Display the 'register' view with registration data
        // عرض صفحة 'register' مع بيانات التسجيل
        return view('register', compact('registrations'));
    }

    /**
     * Traite la soumission du formulaire d'inscription
     * Process the registration form submission
     * معالجة تقديم نموذج التسجيل
     * 
     * @param Request $request Les données du formulaire / Form data / بيانات النموذج
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Valide les données du formulaire
        // Validate form data
        // التحقق من صحة بيانات النموذج
        $validated = $request->validate([
            // Le nom doit avoir au moins 3 caractères et max 255
            // Name must be at least 3 characters and max 255
            // يجب أن يكون الاسم 3 أحرف على الأقل و 255 كحد أقصى
            'name' => 'required|string|min:3|max:255',
            
            // Validation personnalisée pour l'email
            // Custom email validation
            // التحقق المخصص للبريد الإلكتروني
            'email' => [
                'required',
                'email',
                'unique:registrations,email', // L'email doit être unique / Email must be unique / يجب أن يكون البريد الإلكتروني فريدًا
                function($attribute, $value, $fail) {
                    // Vérifie si l'email se termine par @gmail.com
                    // Check if email ends with @gmail.com
                    // التحقق مما إذا كان البريد الإلكتروني ينتهي بـ @gmail.com
                    if (!str_ends_with($value, '@gmail.com')) {
                        $fail('The email must be a gmail.com address.');
                    }
                },
            ],
            
            // Le mot de passe doit avoir au moins 6 caractères et être confirmé
            // Password must be at least 6 characters and be confirmed
            // يجب أن تكون كلمة المرور 6 أحرف على الأقل وتأكيدها
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Crée un nouvel enregistrement dans la base de données
        // Create a new record in the database
        // إنشاء سجل جديد في قاعدة البيانات
        $registration = Registration::create([
            'name' => $request->name,
            'email' => $request->email,
            // Crypte le mot de passe avant de le stocker
            // Encrypt the password before storing
            // تشفير كلمة المرور قبل التخزين
            'password' => Hash::make($request->password),
        ]);

        // Envoie un email de confirmation à l'utilisateur
        // Send confirmation email to user
        // إرسال بريد إلكتروني للتأكيد إلى المستخدم
        Mail::to($request->email)->send(new RegistrationSuccess($registration));

        // Redirige vers le formulaire avec un message de succès
        // Redirect back to form with success message
        // إعادة التوجيه إلى النموذج مع رسالة نجاح
        return redirect()->route('register.form')->with('success', 'Registration successful. Please check your email!');
    }
}
