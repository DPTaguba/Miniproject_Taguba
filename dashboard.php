<?php
session_start();
require_once __DIR__ . '/../db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$stats = [];
try {
    $stats['projects'] = $pdo->query('SELECT COUNT(*) FROM projects')->fetchColumn();
    $stats['messages'] = $pdo->query('SELECT COUNT(*) FROM messages')->fetchColumn();
} catch (Exception $e) {
    $stats['error'] = $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<header>
    <h1>Admin Dashboard</h1>
    <nav>
        <a href="../index.php">Home</a>
        <a href="../aboutme.php">About Me</a>
        <a href="../contact.php">Contact</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section style="padding: 40px; color: white;">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

    <?php if (isset($stats['error'])): ?>
        <p style="color: #f33;">Could not load stats: <?php echo htmlspecialchars($stats['error']); ?></p>
    <?php else: ?>
        <p>Total projects: <?php echo intval($stats['projects']); ?></p>
        <p>Total messages: <?php echo intval($stats['messages']); ?></p>
    <?php endif; ?>

    <ul style="list-style: none; padding: 0;">
        <li><a href="projects.php">Manage Projects</a></li>
        <li><a href="messages.php">View Messages</a></li>
    </ul>
</section>
</body>
</html>
