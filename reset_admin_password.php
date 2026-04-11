<?php
define('BASEPATH', __DIR__ . '/system/');
define('ENVIRONMENT', 'development');
require_once __DIR__ . '/application/config/database.php';

$new_password = isset($_GET['pass']) ? $_GET['pass'] : 'vivek@@admin9797';
$conn = new mysqli(
    $db['default']['hostname'],
    $db['default']['username'],
    $db['default']['password'],
    $db['default']['database']
);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$hash = password_hash($new_password, PASSWORD_DEFAULT);
$conn->query("UPDATE admin_users SET password = '".$conn->real_escape_string($hash)."'WHERE username = '".$conn->real_escape_string($username)."'");

if ($conn->affected_rows > 0) {
    echo '<h2>Admin password reset successfully!</h2>';
    echo '<p>Username: <strong>admin</strong></p>';
    echo '<p>New password: <strong>' . htmlspecialchars($new_password) . '</strong></p>';
    echo '<p><a href="admin">Go to Admin Login</a></p>';
    echo '<p style="color:red;"><strong>DELETE this file (reset_admin_password.php) now for security!</strong></p>';
} else {
    echo '<p>No admin user found. Make sure database is imported.</p>';
}
$conn->close();
