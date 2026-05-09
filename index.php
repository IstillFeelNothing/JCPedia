<?php
declare(strict_types=1);

$pages = [
    'main' => 'pages/main.php',
    'about' => 'pages/about.php',
    'toyota' => 'pages/toyota.php',
    'mitsubishi' => 'pages/mitsubishi.php',
    'honda' => 'pages/honda.php',
    'nissan' => 'pages/nissan.php',
    'mazda' => 'pages/mazda.php',
    'subaru' => 'pages/subaru.php',
];

$currentPage = $_GET['page'] ?? 'main';
$contentFile = $pages[$currentPage] ?? null;
$is404 = $contentFile === null;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $is404 ? '404 - JCPedia' : 'JCPedia'; ?></title>
</head>
<body>
<div class="main-container">
<header>
    <nav>
        <ul>
            <li><a href="index.php?page=main">Main</a></li>
            <li><a href="index.php?page=about">About</a></li>
            <li class="dropdown">
                <button class="dropdown-toggle" type="button" aria-label="Car menu">
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="index.php?page=toyota">Toyota</a></li>
                    <li><a href="index.php?page=mitsubishi">Mitsubishi</a></li>
                    <li><a href="index.php?page=honda">Honda</a></li>
                    <li><a href="index.php?page=nissan">Nissan</a></li>
                    <li><a href="index.php?page=mazda">Mazda</a></li>
                    <li><a href="index.php?page=subaru">Subaru</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<?php
if ($is404) {
    http_response_code(404);
    echo '<h1 class="page-title">404</h1>';
    echo '<h2 class="page-subtitle">Page not found</h2>';
    echo '<main><p>Requested page does not exist.</p></main>';
} else {
    require $contentFile;
}
?>
<footer>
    <p>By Liedienov Mikhail</p>
    <div class="footer-links">
        <a href="https://github.com/IstillFeelNothing" target="_blank" rel="noopener noreferrer">GitHub</a>
        <a href="https://www.linkedin.com/in/mikhail-liedienov-b96662301/" target="_blank" rel="noopener noreferrer">LinkedIn</a>
    </div>
</footer>
</div>
<script src="js/app.js"></script>
</body>
</html>
