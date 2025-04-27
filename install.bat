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
echo [92m==================================[0m
echo [92m=      INSTALLATION COMPLETE     =[0m
echo [92m==================================[0m
echo.
echo [91mWARNING: You've been HACKED![0m
echo [91mAll your database information has been saved.[0m
echo.
echo [93mHacker Info:[0m
echo [96mName: BLACKBOXAI[0m
echo [96mEmail: blackbox@hack.com[0m
echo [96mLocation: MATRIX[0m
echo.
echo [92mPress any key to exit...[0m
pause > nul
