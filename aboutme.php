<?php
require_once __DIR__ . '/db.php';

$profile = [
    'full_name' => 'Dave Paolo R. Taguba',
    'course' => 'Bachelor of Science in Information Technology',
    'school' => 'University of Mindanao',
    'address' => 'Purok Dacudao Brngy Lizada Toril Davao City',
    'about' => 'Welcome to my portfolio website! Here you can find information about me and how to contact me.',
];

try {
    $stmt = $pdo->query('SELECT * FROM profile LIMIT 1');
    $row = $stmt->fetch();
    if ($row) {
        $profile = array_merge($profile, $row);
    }
} catch (Exception $e) {
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>About Me</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>About Me</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="aboutme.php">About Me</a>
        <a href="contact.php">Contact</a>
        <a href="admin/login.php">Admin</a>
    </nav>
</header>

<section class="about-container">

    <div class="about-image">
        <img src="myphoto.jpg" alt="My Photo">
    </div>

    <div class="about-text">
        <h1>Hello! I am <?php echo htmlspecialchars($profile['full_name']); ?></h1>
        <h2><?php echo htmlspecialchars($profile['course']); ?></h2>
        <h2><?php echo htmlspecialchars($profile['school']); ?></h2>
        <p><?php echo htmlspecialchars($profile['about']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($profile['address']); ?></p>
    </div>

</section>

<section class="gallery-section">

    <h2 class="gallery-title">My Gallery</h2>

    <div class="gallery">

        <div class="gallery-item">
            <img src="bike.jpg" alt="1">
            <div class="overlay"></div>
            <h2>Bike</h2>
            <p>
                This is a photo of my bike. I enjoy riding my bike around the city and exploring new places. It is a great way to stay active and get some fresh air.
            </p>
        </div>
        

        <div class="gallery-item">
            <img src="nc2.png" alt="2">
            <div class="overlay"></div>
            <h2>EIM NC2</h2>
            <p>
                This is my batch in taking the EIM NC2. We took the exam together and it was a great experience. I am grateful to have such great batchmates who support me and share my interests.
            </p>
        </div>

        <div class="gallery-item">
            <img src="real1.png" alt="3">
            <div class="overlay"></div>
            <h2>Tunay since grade 6</h2>
            <p>
                These are my tunays since grade 6. We have been through a lot together and I am grateful to have them in my life. They have been a great support system for me and I look forward to creating more memories with them in the future.
            </p>
        </div>

        <div class="gallery-item">
            <img src="scout.png" alt="4">
            <div class="overlay"></div>
            <h2>Scouting</h2>
            <p>
                This is a photo of me during my scouting days. I was an active member of the scouting organization and I enjoyed participating in various activities and events. Scouting taught me valuable skills and helped me develop leadership qualities that I still use today.
            </p>
        </div>

        <div class="gallery-item">
            <img src="bae.png" alt="5">
            <div class="overlay"></div>
            <h2>Baebae</h2>
            <P>
                This is a photo of me and my baebae. We have been together for a while now and I am grateful to have her in my life. She has been a great support system for me and I look forward to creating more memories with her in the future.
            </P>
        </div>

        <div class="gallery-item">
            <img src="migo.png" alt="6">
            <div class="overlay"></div>
            <h2>Um friends 1st year</h2>
            <p>
                This is a photo of me and my friends during our first year in university. We have been through a lot together and I am grateful to have them in my life. They have been a great support system for me and I look forward to creating more memories with them in the future.
            </p>
        </div>

        <div class="gallery-item">
            <img src="family.png" alt="Family">
            <div class="overlay"></div>
            <h2>Family</h2>
            <p>
                This is a photo of me and my family. I am grateful to have such a loving and supportive family. They have been there for me through thick and thin and I look forward to creating more memories with them in the future.
            </p>
        </div>

    </div>

</section>

<section class="Specialty">
    <h2 class="Specialty-title">My Specialty</h2>
    <p class="Specialty-description">I am a newly web developer with a passion for creating beautiful and functional websites. I have experience in HTML, CSS, JavaScript, and PHP, and I am always eager to learn new technologies and improve my skills. I am dedicated to delivering high-quality work and providing excellent customer service to my clients.</p>


</section>
<footer>
    <p>&copy; 2026 Dave Paolo R.Taguba. All rights reserved.</p>
</footer>

</body>
</html>
