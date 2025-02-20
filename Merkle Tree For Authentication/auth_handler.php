<?php
session_start();
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = 'localhost';
$dbname = 'graphical_auth';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        pattern VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);

} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    die(json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]));
}

$action = $_GET['action'] ?? '';

if ($action === 'register') {
    try {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $pattern = $_POST['pattern'] ?? '';

        if (empty($name) || empty($email) || empty($pattern)) {
            throw new Exception('All fields are required');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format');
        }

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception('Email already registered');
        }

        $patternArray = json_decode($pattern, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid pattern format');
        }
        
        $patternString = implode(',', $patternArray);
        
        $stmt = $pdo->prepare("INSERT INTO users (name, email, pattern) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $patternString]);
        
        echo json_encode(['success' => true, 'message' => 'Registration successful']);
    } catch(Exception $e) {
        error_log("Registration Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} elseif ($action === 'login') {
    try {
        $email = trim($_POST['email'] ?? '');
        $pattern = $_POST['pattern'] ?? '';

        if (empty($email) || empty($pattern)) {
            throw new Exception('Email and pattern are required');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format');
        }

        $patternArray = json_decode($pattern, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid pattern format');
        }
        
        $submittedPattern = implode(',', $patternArray);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception('Email not found');
        }

        if ($submittedPattern === $user['pattern']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            
            echo json_encode([
                'success' => true, 
                'message' => 'Login successful',
                'redirect' => 'home.php'
            ]);
        } else {
            throw new Exception('Invalid pattern');
        }
    } catch(Exception $e) {
        error_log("Login Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
?>
