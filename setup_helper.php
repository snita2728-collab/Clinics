<?php
// Load .env values
$envFile = __DIR__ . '/.env';
if (!file_exists($envFile)) {
    if (file_exists($envFile . '.example')) {
        copy($envFile . '.example', $envFile);
        echo "Created .env from .env.example\n";
    } else {
        echo ".env file not found!\n";
        exit(1);
    }
}

// Simple parser for .env
$env = [];
$lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue;
    $parts = explode('=', $line, 2);
    if (count($parts) === 2) {
        $env[trim($parts[0])] = trim($parts[1]);
    }
}

$db_host = $env['DB_HOST'] ?? '127.0.0.1';
$db_port = $env['DB_PORT'] ?? '3306';
$db_name = $env['DB_DATABASE'] ?? 'clinic';
$db_user = $env['DB_USERNAME'] ?? 'root';
$db_pass = $env['DB_PASSWORD'] ?? 'admin';

// Attempt to connect and create the database if not exists
try {
    $dsn = "mysql:host=$db_host;port=$db_port";
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create DB
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database '$db_name' verified/created successfully.\n";
    
    // Reconnect selecting the database
    $pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if the users table exists and has records
    $hasUsers = false;
    try {
        $stmt = $pdo->query("SELECT COUNT(*) FROM `users`");
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            $hasUsers = true;
        }
    } catch (PDOException $e) {
        // Table doesn't exist
        $hasUsers = false;
    }
    
    if (!$hasUsers) {
        echo "Database is new or empty. Running migrations and seeders...\n";
        passthru('php artisan migrate --force');
        passthru('php artisan db:seed --force');
    } else {
        echo "Database already initialized with records. Skipping seeding to prevent duplicates.\n";
        passthru('php artisan migrate --force');
    }
    
} catch (PDOException $e) {
    echo "Warning: Could not connect to database: " . $e->getMessage() . "\n";
    echo "Please make sure your MySQL server is running and credentials in .env are correct.\n";
}
