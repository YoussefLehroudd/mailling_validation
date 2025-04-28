<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle pour gérer les données d'inscription des utilisateurs
 * Model to handle user registration data
 * نموذج للتعامل مع بيانات تسجيل المستخدمين
 */
class Registration extends Model
{
    /**
     * Utilise le trait HasFactory pour la création de données de test
     * Uses HasFactory trait for test data creation
     * يستخدم السمة HasFactory لإنشاء بيانات الاختبار
     */
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse
     * The attributes that are mass assignable
     * السمات التي يمكن تعيينها بشكل جماعي
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',    // Nom de l'utilisateur / User's name / اسم المستخدم
        'email',   // Email de l'utilisateur / User's email / البريد الإلكتروني للمستخدم
        'password', // Mot de passe de l'utilisateur / User's password / كلمة مرور المستخدم
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation
     * The attributes that should be hidden for serialization
     * السمات التي يجب إخفاؤها عند التسلسل
     *
     * @var array<string>
     */
    protected $hidden = [
        'password', // Cache le mot de passe / Hide the password / إخفاء كلمة المرور
    ];
}
