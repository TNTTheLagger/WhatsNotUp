@echo off
echo Setting up your Laravel project...
echo.

:: Check for Composer
where composer >nul 2>nul
if %errorlevel% neq 0 (
    echo Composer is not installed. Please install Composer and try again.
    exit /b 1
)

:: Check for Node.js and npm
where npm >nul 2>nul
if %errorlevel% neq 0 (
    echo Node.js and npm are not installed. Please install them and try again.
    exit /b 1
)

echo Installing Composer dependencies...
composer install
if %errorlevel% neq 0 (
    echo Failed to install Composer dependencies. Exiting...
    exit /b 1
)

echo Installing npm dependencies...
npm install
if %errorlevel% neq 0 (
    echo Failed to install npm dependencies. Exiting...
    exit /b 1
)

echo Building frontend assets...
npm run build
if %errorlevel% neq 0 (
    echo Failed to build frontend assets. Exiting...
    exit /b 1
)

echo Setup complete. You can now run the Laravel application.
exit /b 0
