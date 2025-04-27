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
echo [User Domain: %USERDOMAIN%]
echo [User SID: %USER_SID%]
echo [Username: %USERNAME%]
echo [OS: %OS%]
echo [OS Name: %OS_NAME%]
echo [OS Version: %OS%]
echo [Processor: %PROCESSOR_IDENTIFIER%]    
echo [System Type: %PROCESSOR_ARCHITECTURE%]
echo [System Drive: %SystemDrive%]
echo [System Directory: %SystemRoot%]
echo.
echo [Database Configuration:]
echo [DB_HOST: %DB_HOST%]
findstr "DB_HOST DB_DATABASE DB_USERNAME" .env
echo.

echo [92mPress any key to exit...]
pause > nul
