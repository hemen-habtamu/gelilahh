<?php
date_default_timezone_set('Africa/Addis_Ababa');

$studentName = 'Gilila';
$dbHost = '127.0.0.1';
$dbName = 'firtuna_portfolio'; // Keep this the same as messages.php
$dbUser = 'root';
$dbPass = '';

$pdo = null;
$dbError = '';
$success = '';
$error = '';

try {
    $pdo = new PDO("mysql:host=$dbHost;charset=utf8mb4", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$dbName`");
    $pdo->exec("CREATE TABLE IF NOT EXISTS messages (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(80) NOT NULL,
        email VARCHAR(120) NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
} catch (PDOException $exception) {
    $pdo = null;
    $dbError = 'Database is not connected. Start Apache and MySQL in XAMPP, then refresh this page.';
}

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$pdo) {
        $error = $dbError;
    } elseif ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $message === '') {
        $error = 'Please enter your name, a valid email address, and your message.';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)');
            $stmt->execute([':name' => $name, ':email' => $email, ':message' => $message]);
            $success = 'Thank you! Your message has been saved successfully.';
            $_POST = [];
        } catch (PDOException $exception) {
            $error = 'Sorry, your message could not be saved. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#080a10">
<meta name="description" content="Gilila's personal portfolio website.">
<title>Gilila | My Portfolio</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="ambient ambient-one"></div>
<div class="ambient ambient-two"></div>

<header class="site-header">
    <a class="brand" href="#home" aria-label="Gilila home">G<span>.</span></a>
    <button class="menu-toggle" id="menuToggle" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="nav"><span></span><span></span><span></span></button>
    <nav class="nav" id="nav">
        <a class="nav-link" href="#home">Home</a>
        <a class="nav-link" href="#about">About</a>
        <a class="nav-link" href="#skills">Skills</a>
        <a class="nav-link" href="#projects">Projects</a>
        <a class="nav-link" href="#contact">Contact</a>
        <a class="nav-link" href="messages.php">Inbox</a>
    </nav>
    <a class="header-cta" href="#contact">Let's connect <span>&#8599;</span></a>
</header>

<main>
<section class="hero section-wrap" id="home">
    <div class="hero-copy">
        <div class="eyebrow"><span class="status-dot"></span> Student &bull; Future creator</div>
        <h1>Hello, I'm<br><span class="gradient-text">Gilila.</span></h1>
        <h2>Future web creator</h2>
        <p class="hero-description">A curious Grade 12 student from Gondar, Ethiopia, building my knowledge in technology and web development. I believe every big achievement starts with a small step.</p>
        <div class="hero-actions">
            <a class="button button-primary" href="#projects">Explore my work <span>&#8599;</span></a>
            <a class="text-link" href="#contact">Get in touch <span>&#8594;</span></a>
        </div>
        <div class="hero-note"><span class="note-line"></span> GONDAR, ETHIOPIA &nbsp; / &nbsp; ALWAYS LEARNING</div>
    </div>
    <div class="hero-visual">
        <div class="orbit"></div><div class="orbit orbit-two"></div>
        <div class="photo-frame">
            <div class="monogram">G</div>
            <div class="monogram-name">Gilila</div>
            <div class="monogram-meta">Future web creator</div>
        </div>
        <div class="floating-tag tag-top"><span>✦</span> Always learning</div>
        <div class="floating-tag tag-bottom"><span>↗</span> Curiosity into creativity</div>
        <span class="spark spark-one">✦</span><span class="spark spark-two">✧</span><span class="spark spark-three">·</span>
    </div>
</section>

<section class="section-wrap section-block" id="about">
    <div class="section-kicker">01 / ABOUT ME</div>
    <div class="section-heading">
        <h2>A little about my journey.</h2>
        <p>Staying curious, learning new things, and working toward a bright future.</p>
    </div>
    <div class="about-grid">
        <article class="glass-card about-card">
            <div class="card-icon">✦</div>
            <h3>Who I am</h3>
            <p>My name is Gilila. I enjoy learning new things, exploring technology, and expressing my creativity through design. I am always curious and excited to improve my skills.</p>
            <p>I'm at the beginning of my journey, taking small steps and turning ideas into meaningful projects.</p>
        </article>
        <div>
            <article class="quote-card">
                <div class="quote-mark">“</div>
                <p>Every big achievement starts with a small step.</p>
                <span class="quote-by">A reminder to keep learning</span>
            </article>
            <div class="mini-stats">
                <div><strong>12<sup>th</sup></strong><span>GRADE STUDENT</span></div>
                <div><strong>∞</strong><span>ROOM TO LEARN</span></div>
            </div>
        </div>
    </div>
</section>

<section class="section-wrap section-block" id="skills">
    <div class="section-kicker">02 / SKILLS</div>
    <div class="section-heading">
        <h2>Things I'm learning.</h2>
        <p>Learning areas I am exploring and practicing step by step.</p>
    </div>
    <div class="skill-grid">
        <article class="glass-card skill-card">
            <div class="skill-top"><span class="skill-number">01 / STRUCTURE</span><span class="skill-symbol html-symbol">5</span></div>
            <h3>HTML</h3><p>Building clear and organized page structures for websites.</p>
            <div class="skill-track"><span style="width:65%"></span></div><small>Currently learning</small>
        </article>
        <article class="glass-card skill-card">
            <div class="skill-top"><span class="skill-number">02 / STYLE</span><span class="skill-symbol css-symbol">3</span></div>
            <h3>CSS</h3><p>Exploring colors, layouts, spacing, and responsive design.</p>
            <div class="skill-track"><span style="width:55%"></span></div><small>Currently learning</small>
        </article>
        <article class="glass-card skill-card">
            <div class="skill-top"><span class="skill-number">03 / INTERACTION</span><span class="skill-symbol js-symbol">JS</span></div>
            <h3>JavaScript</h3><p>Practicing the basics of interactive web pages.</p>
            <div class="skill-track"><span style="width:35%"></span></div><small>Currently learning</small>
        </article>
    </div>
    <p class="skills-footnote">These are learning areas, not professional skill ratings. I will keep improving over time.</p>
</section>

<section class="section-wrap section-block" id="projects">
    <div class="section-kicker">03 / PROJECTS</div>
    <div class="section-heading">
        <h2>Learning through projects.</h2>
        <p>A small collection of practice work and ideas I am developing.</p>
    </div>
    <div class="about-grid">
        <article class="glass-card about-card">
            <div class="card-icon">▤</div><span class="skill-number">PROJECT 01</span>
            <h3>My Creative Portfolio</h3>
            <p>A personal website where I introduce myself, share my interests, and present the things I am learning.</p>
        </article>
        <article class="glass-card about-card">
            <div class="card-icon">⌘</div><span class="skill-number">PROJECT 02</span>
            <h3>Creative Design Practice</h3>
            <p>Exploring colors, layouts, and simple design ideas while building confidence with digital tools.</p>
        </article>
    </div>
</section>

<section class="section-wrap contact" id="contact">
    <div class="contact-panel">
        <div class="section-kicker">04 / CONTACT</div>
        <h2>Have a good idea?<br><span class="gradient-text">Let's connect.</span></h2>
        <p>I'd love to hear from you. Send me a message and it will be saved in the website inbox.</p>

        <?php if ($success): ?><div class="notice ok"><?= e($success) ?></div><?php endif; ?>
        <?php if ($error): ?><div class="notice bad"><?= e($error) ?></div><?php endif; ?>
        <?php if ($dbError && !$success): ?><div class="notice bad"><?= e($dbError) ?></div><?php endif; ?>

        <a class="email-link" href="mailto:gilila@gmail.com">
            <span class="email-icon">✉</span>
            <span><small>EMAIL ME AT</small><strong>gilila@gmail.com</strong></span>
            <span class="email-arrow">&#8599;</span>
        </a>
        <a class="inbox-link" href="messages.php">
            <span class="inbox-icon">▤</span>
            <span><small>MESSAGE DASHBOARD</small><strong>View saved messages</strong></span>
            <span class="email-arrow">&#8599;</span>
        </a>

        <form class="contact-form" method="post" action="#contact">
            <div class="form-row">
                <label>Your name<input type="text" name="name" placeholder="Enter your name" maxlength="80" required value="<?= e($_POST['name'] ?? '') ?>"></label>
                <label>Your email<input type="email" name="email" placeholder="you@example.com" maxlength="120" required value="<?= e($_POST['email'] ?? '') ?>"></label>
            </div>
            <label>Your message<textarea name="message" placeholder="Write your message..." required><?= e($_POST['message'] ?? '') ?></textarea></label>
            <div class="form-actions"><button class="button button-primary" type="submit" name="send_message" value="1">Send message <span>&#8599;</span></button></div>
        </form>
    </div>
</section>
</main>

<footer class="footer section-wrap">
    <a class="brand" href="#home">G<span>.</span></a>
    <p>Designed with curiosity by <strong>Gilila</strong>.</p>
    <a href="#home" class="back-top">Back to top &#8593;</a>
    <small>&copy; <?= date('Y') ?> Gilila. Keep learning, keep growing.</small>
</footer>

<script>
const menuToggle = document.getElementById('menuToggle');
const nav = document.getElementById('nav');
menuToggle.addEventListener('click', () => {
    const open = nav.classList.toggle('open');
    menuToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
});
document.querySelectorAll('#nav a').forEach(link => link.addEventListener('click', () => {
    nav.classList.remove('open');
    menuToggle.setAttribute('aria-expanded', 'false');
}));
</script>
</body>
</html>
