<?php
require_once __DIR__ . '/config.php';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";charset=utf8mb4", DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `" . DB_NAME . "`");

    $pdo->exec(<<<'SQL'
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS profile (
    id INT PRIMARY KEY DEFAULT 1,
    full_name VARCHAR(100) NOT NULL,
    course VARCHAR(100) NOT NULL,
    school VARCHAR(150) NOT NULL,
    address TEXT NOT NULL,
    about TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    link VARCHAR(255) DEFAULT NULL,
    image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
SQL
    );

    // Insert default admin user if not exists
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = ?');
    $stmt->execute(['admin']);

    if ($stmt->fetchColumn() == 0) {
        $passwordHash = password_hash('admin123', PASSWORD_DEFAULT);
        $insert = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $insert->execute(['admin', $passwordHash]);
        echo "Created default admin user: <strong>admin</strong> / <strong>admin123</strong><br>";
    } else {
        echo "Admin user already exists.<br>";
    }

    // Insert default profile row if not exists
    $stmt = $pdo->query('SELECT COUNT(*) FROM profile');
    if ($stmt->fetchColumn() == 0) {
        $insert = $pdo->prepare('INSERT INTO profile (full_name, course, school, address, about) VALUES (?, ?, ?, ?, ?)');
        $insert->execute([
            'Dave Paolo R. Taguba',
            'Bachelor of Science in Information Technology',
            'University of Mindanao',
            'Purok Dacudao Brngy Lizada Toril Davao City',
            'Welcome to my portfolio website! Here you can find information about me and how to contact me.',
        ]);
        echo "Inserted default profile data.<br>";
    } else {
        echo "Profile data already exists.<br>";
    }

    echo "<p>Setup complete. Delete or secure setup.php after use.</p>";
} catch (PDOException $e) {
    die('Setup error: ' . $e->getMessage());
}
