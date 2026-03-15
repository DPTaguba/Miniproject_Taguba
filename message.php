<?php
session_start();
require_once __DIR__ . '/../db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$messages = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Messages</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<header>
    <h1>Messages</h1>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section style="padding: 40px; color: white;">
    <?php if (empty($messages)): ?>
        <p>No messages yet.</p>
    <?php else: ?>
        <table style="width:100%; border-collapse: collapse; color: white;">
            <thead>
                <tr>
                    <th style="border-bottom: 1px solid #fff; padding: 8px; text-align: left;">Date</th>
                    <th style="border-bottom: 1px solid #fff; padding: 8px; text-align: left;">Name</th>
                    <th style="border-bottom: 1px solid #fff; padding: 8px; text-align: left;">Email</th>
                    <th style="border-bottom: 1px solid #fff; padding: 8px; text-align: left;">Message</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $msg): ?>
                    <tr>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($msg['created_at']); ?></td>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($msg['name']); ?></td>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($msg['email']); ?></td>
                        <td style="padding: 8px; white-space: pre-wrap;"><?php echo htmlspecialchars($msg['message']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
</body>
</html>
