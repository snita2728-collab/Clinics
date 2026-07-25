@echo off
title Clinic Management System Launcher
echo ==========================================
echo Starting Clinic Management System Auto-Setup
echo ==========================================
echo.

REM 1. Run environment setup, database creation, migration and conditional seeding
echo [1/3] Setting up database and running migrations/seeding if needed...
php setup_helper.php
echo.

REM 2. Clear config and views cache
echo [2/3] Clearing application caches...
php artisan config:clear
php artisan view:clear
echo.

REM 3. Start Laravel serve
echo [3/3] Starting local development server...
echo.
echo ==========================================
echo SETUP COMPLETE!
echo The system will be available at: http://127.0.0.1:8000
echo ==========================================
echo.
php artisan serve
pause
