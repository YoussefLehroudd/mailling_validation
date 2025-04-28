<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Registration;

/**
 * Classe pour gérer l'envoi d'emails de confirmation d'inscription
 * Class to handle sending registration confirmation emails
 * فئة للتعامل مع إرسال رسائل البريد الإلكتروني لتأكيد التسجيل
 */
class RegistrationSuccess extends Mailable
{
    /**
     * Utilise les traits pour la mise en file d'attente et la sérialisation
     * Use traits for queueing and serialization of emails
     * استخدام السمات للوضع في قائمة الانتظار وتسلسل رسائل البريد الإلكتروني
     */
    use Queueable, SerializesModels;

    /**
     * Les données d'inscription accessibles dans la vue de l'email
     * Registration data accessible in the email view
     * بيانات التسجيل التي يمكن الوصول إليها في عرض البريد الإلكتروني
     * 
     * @var Registration
     */
    public $registration;

    /**
     * Crée une nouvelle instance de l'email
     * Create a new message instance
     * إنشاء نسخة جديدة من الرسالة
     * 
     * @param Registration $registration Les données de l'utilisateur inscrit / The registered user's data / بيانات المستخدم المسجل
     */
    public function __construct(Registration $registration)
    {
        // Stocke les données d'inscription pour utilisation dans la vue
        // Store registration data for use in the view
        // تخزين بيانات التسجيل للاستخدام في العرض
        $this->registration = $registration;
    }

    /**
     * Construit le message de l'email
     * Build the email message
     * بناء رسالة البريد الإلكتروني
     * 
     * @return $this
     */
    public function build()
    {
        // Définit le sujet de l'email et utilise la vue 'registration_success'
        // Set email subject and use the 'registration_success' view
        // تعيين موضوع البريد الإلكتروني واستخدام عرض 'registration_success'
        return $this->subject('Registration Successful')
                    ->view('registration_success');
    }
}
