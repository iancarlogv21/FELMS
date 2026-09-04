<?php
require_once __DIR__ . '/config/db.php';

try {
    $db = Database::getInstance();
    $adminsCollection = $db->admins();

    $newPasswordPlain = 'admin123';
    $hashedPassword = password_hash($newPasswordPlain, PASSWORD_DEFAULT);

    $result = $adminsCollection->updateOne(
        ['username' => 'admin'],
        ['$set' => [
            'password' => $hashedPassword,
            'email' => 'iancarlogv@gmail.com',
            'full_name' => 'Ian Carlo Ventura'
        ]],
        ['upsert' => true]
    );

    echo "<h1 style='color:green;'>Admin Password Reset Success!</h1>";
    echo "<p>Username: <b>admin</b></p>";
    echo "<p>Password: <b>admin123</b></p>";
    echo "<p><a href='login.php'>Click here to go back to Login</a></p>";
} catch (\Exception $e) {
    echo "<h1 style='color:red;'>Error:</h1> " . $e->getMessage();
}