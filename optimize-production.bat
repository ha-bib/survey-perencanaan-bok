@echo off
REM Laravel Production Optimization Script
REM Run this after deploying to production

echo ========================================
echo Laravel Performance Optimization Script
echo ========================================

echo.
echo [1/5] Clearing old caches...
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan route:clear

echo.
echo [2/5] Caching configuration...
php artisan config:cache

echo.
echo [3/5] Caching routes...
php artisan route:cache

echo.
echo [4/5] Caching views...
php artisan view:cache

echo.
echo [5/5] Running migrations...
php artisan migrate --force

echo.
echo ========================================
echo Optimization Complete!
echo ========================================
echo.
echo IMPORTANT: Make sure to set in .env:
echo   APP_DEBUG=false
echo   APP_ENV=production
echo   CACHE_STORE=file (or redis for better performance)
echo   SESSION_DRIVER=file (or redis/database)
echo.
pause
