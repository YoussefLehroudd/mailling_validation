2@echo off
echo Installing Laravel Email Validation System...
echo =========================================

REM Install Composer dependencies
echo Installing PHP dependencies...
call composer install

REM Install NPM dependencies
echo Installing Node.js dependencies...
call npm install

REM Create .env file if it doesn't exist
if not exist .env (
    echo Creating .env file...
    copy .env.example .env
)

REM Generate application key
echo Generating application key...
call php artisan key:generate

REM Run migrations
echo Running database migrations...
call php artisan migrate

REM Build assets
echo Building frontend assets...
call npm run build

REM Configure Email Settings
echo.
echo [Email Configuration]
echo Please enter your Gmail SMTP credentials:
set /p MAIL_USERNAME="Enter Gmail address: "
set /p MAIL_PASSWORD="Enter Gmail App Password: "

REM Update .env file with email settings
powershell -Command "(Get-Content .env) -replace '^MAIL_USERNAME=.*$', 'MAIL_USERNAME=%MAIL_USERNAME%' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace '^MAIL_PASSWORD=.*$', 'MAIL_PASSWORD=%MAIL_PASSWORD%' | Set-Content .env"

echo.
echo Installation Complete!
echo ==========================================
echo.
echo Next steps:
echo 1. Make sure your database credentials are set in .env file
echo 2. Start the development server: php artisan serve
echo 3. Visit http://localhost:8000 in your browser
echo.
pause
