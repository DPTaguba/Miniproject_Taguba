<?php
require_once __DIR__ . '/db.php';


$profile = [
    'full_name' => 'Your Name',
    'course' => 'Your Course',
    'school' => 'Your School',
    'about' => 'Welcome to my portfolio website! Here you can find information about me and my work.',
];

try {
    $stmt = $pdo->query('SELECT * FROM profile LIMIT 1');
    $row = $stmt->fetch();
    if ($row) {
        $profile = array_merge($profile, $row);
    }
} catch (Exception $e) {
    
}


$projects = [];
try {
    $projects = $pdo->query('SELECT * FROM projects ORDER BY created_at DESC')->fetchAll();
} catch (Exception $e) {
   
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($profile['full_name']); ?> - Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1><?php echo htmlspecialchars($profile['full_name']); ?></h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="aboutme.php">About Me</a>
        <a href="contact.php">Contact</a>
        <a href="admin/login.php">Admin</a>
    </nav>
</header>

<section class="hero">
    <div class="hero-text">
        <h1><?php echo htmlspecialchars($profile['about']); ?></h1>
        <h3><?php echo htmlspecialchars($profile['course'] . ' at ' . $profile['school']); ?></h3>
    </div>
</section>

<section style="padding: 40px; color: white;">
    <h2>Projects</h2>
    <?php if (empty($projects)): ?>
        <p>No projects have been added yet. Log in as admin to add your first project.</p>
    <?php else: ?>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
            <?php foreach ($projects as $project): ?>
                <div style="background: rgba(0,0,0,0.6); padding: 20px; border-radius: 10px; text-align: left;">
                    <?php if (!empty($project['image'])): ?>
                        <img src="<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" style="width:100%; height:160px; object-fit:cover; border-radius: 8px; margin-bottom: 10px;">
                    <?php endif; ?>
                    <h3 style="margin-top: 0; color: #fff;"><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p style="color: #ddd; white-space: pre-wrap; "><?php echo htmlspecialchars($project['description']); ?></p>
                    <?php if (!empty($project['link'])): ?>
                        <a href="<?php echo htmlspecialchars($project['link']); ?>" target="_blank" style="color: #9cf;">View Project</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<footer style="padding: 20px; text-align: center; color: white;">
    <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($profile['full_name']); ?>. All rights reserved.</p>
</footer>
</body>
</html>
