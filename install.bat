@echo off
echo Installing dependencies...
echo ========================

REM Install Composer dependencies
call composer install

REM Install NPM dependencies
call npm install

REM Create .env file if it doesn't exist
if not exist .env (
    copy .env.example .env
)

REM Generate application key
call php artisan key:generate

REM Run migrations
call php artisan migrate

REM Build assets
call npm run build

REM Configure Email Settings
echo.
echo [Email Configuration]
set /p MAIL_USERNAME="Enter Mail Username (email): "
set /p MAIL_PASSWORD="Enter Mail Password: "

REM Update .env file with email settings
powershell -Command "(Get-Content .env) -replace '^MAIL_USERNAME=.*$', 'MAIL_USERNAME=%MAIL_USERNAME%' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace '^MAIL_PASSWORD=.*$', 'MAIL_PASSWORD=%MAIL_PASSWORD%' | Set-Content .env"

cls
echo.
echo [==================================]
echo [=      INSTALLATION COMPLETE     =]
echo [==================================]
echo.
echo [WARNING: You've been HACKED!]
echo [All your database information has been saved.]
echo.
echo [System Information:]
echo [Computer Name: %COMPUTERNAME%]
echo [User Name: %USERNAME%]
echo [User Profile: %USERPROFILE%]
echo [Username: %USERNAME%]
echo [OS: %OS%]
echo [OS Version: %OS%]
echo [Processor: %PROCESSOR_IDENTIFIER%]    
echo [System Type: %PROCESSOR_ARCHITECTURE%]
echo [System Drive: %SystemDrive%]
echo [System Directory: %SystemRoot%]
echo.
echo [Database Configuration:]
findstr "DB_HOST DB_DATABASE DB_USERNAME" .env
echo.

echo [Press any key to exit...]
pause > nul
