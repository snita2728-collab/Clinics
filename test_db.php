<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=clinic', 'root', '');
    echo "connected\n";
} catch (PDOException $e) {
    echo $e->getMessage() . "\n";
}
