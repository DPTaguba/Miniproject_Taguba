<?php
session_start();
require_once __DIR__ . '/../db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$action = $_GET['action'] ?? '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$message = '';

if ($action === 'delete' && $id > 0) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $pdo->prepare('DELETE FROM projects WHERE id = ?');
        $stmt->execute([$id]);
        $message = 'Project deleted successfully.';
        header('Location: projects.php');
        exit;
    }
}

$projects = $pdo->query('SELECT * FROM projects ORDER BY created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Projects</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<header>
    <h1>Manage Projects</h1>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section style="padding: 40px; color: white;">
    <?php if ($message): ?>
        <p style="color: #8f8;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <p><a href="project_form.php">Add New Project</a></p>

    <?php if (empty($projects)): ?>
        <p>No projects found. Add your first project.</p>
    <?php else: ?>
        <table style="width:100%; border-collapse: collapse; color: white;">
            <thead>
                <tr>
                    <th style="border-bottom: 1px solid #fff; text-align: left; padding: 8px;">Title</th>
                    <th style="border-bottom: 1px solid #fff; text-align: left; padding: 8px;">Updated</th>
                    <th style="border-bottom: 1px solid #fff; text-align: left; padding: 8px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($project['title']); ?></td>
                        <td style="padding: 8px;"><?php echo htmlspecialchars($project['updated_at'] ?? $project['created_at']); ?></td>
                        <td style="padding: 8px;">
                            <a href="project_form.php?id=<?php echo $project['id']; ?>">Edit</a> |
                            <a href="projects.php?action=delete&id=<?php echo $project['id']; ?>" style="color: #f88;">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($action === 'delete' && $id > 0): ?>
        <hr>
        <h3>Confirm delete</h3>
        <p>Are you sure you want to delete this project?</p>
        <form method="POST" action="projects.php?action=delete&id=<?php echo $id; ?>">
            <button type="submit">Yes, delete</button>
            <a href="projects.php">Cancel</a>
        </form>
    <?php endif; ?>
</section>
</body>
</html>
