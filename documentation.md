# Registration System Documentation

## Project Overview
This is a Laravel-based registration system with email verification, form validation

## Project Setup Commands

### 1. Create New Laravel Project
```bash
composer create-project laravel/laravel registerApp
cd registerApp
```

### 2. Create Database Migration
```bash
php artisan make:migration create_registrations_table
```

### 3. Create Model
```bash
php artisan make:model Registration
```

### 4. Create Controller
```bash
php artisan make:controller RegistrationController
```

### 5. Create Mail Class
```bash
php artisan make:mail RegistrationSuccess
```

## Project Structure

### 1. Database Migration
File: `database/migrations/2025_04_27_131821_create_registrations_table.php`
```php
public function up()
{
    Schema::create('registrations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->timestamps();
    });
}
```

### 2. Model
File: `app/Models/Registration.php`
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}
```

### 3. Controller
File: `app/Http/Controllers/RegistrationController.php`
- Handles form display
- Processes registration
- Validates input
- Sends confirmation email
- Shows registered users

### 4. Views
1. `resources/views/register.blade.php`
   - Registration form
   - Users list panel
   - Validation display
   - Success messages

2. `resources/views/registration_success.blade.php`
   - Email template for successful registration

### 5. Routes
File: `routes/web.php`
```php
Route::get('/register', [RegistrationController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');
```

## Features Explanation

### 1. Form Validation
- Name: Minimum 3 characters
- Email: Must be gmail.com address
- Password: Minimum 6 characters with confirmation
- Single error message display

### 2. Real-time Users List
- Shows all registered users
- Displays in side panel
- Updates automatically after registration
- Shows registration time

### 3. Email System
Uses Laravel's built-in Mail facade with:
- Custom email template
- HTML formatting
- User details in email

## Libraries and Dependencies

### 1. Laravel Mail
- Built-in Laravel mail system
- Configure in `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. Database
- Uses Laravel's database system
- Configure in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Running the Project

1. Install dependencies:
```bash
composer install
```


3. Run migrations:
```bash
php artisan migrate
```

4. Start server:
```bash
php artisan serve
```

## Validation Rules Explained

### Name Validation
```php
'name' => 'required|string|min:3|max:255'
```
- required: Field must not be empty
- string: Must be text
- min:3: Minimum 3 characters
- max:255: Maximum 255 characters

### Email Validation
```php
'email' => [
    'required',
    'email',
    'unique:registrations,email',
    // Custom gmail.com validation
]
```
- required: Field must not be empty
- email: Must be valid email format
- unique: Must not exist in database
- Custom: Must end with @gmail.com

### Password Validation
```php
'password' => 'required|string|min:6|confirmed'
```
- required: Field must not be empty
- string: Must be text
- min:6: Minimum 6 characters
- confirmed: Must match password_confirmation field


