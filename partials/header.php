<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags Start -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta Tags End -->

    <!-- Icons CDN Start -->
    <link href=" https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css " rel="stylesheet" />
    <!-- Icons CDN End -->

    <!-- Google Fonts Start -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Google Fonts End -->

    <!-- Stylesheet Start -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/GUstyles.css">
    <!-- Stylesheet End -->

    <!-- Site Title Start -->
    <title>HibsNet | <?php echo $pageTitle; ?></title>
    <!-- Site Title End -->
</head>

<body>

    <!-- Navigation Start -->
    <header class="header">
        <nav class="nav container">
            <!-- Logo Start -->
            <?php include(__DIR__ . "/../components/logo.php"); ?>
            <!-- Logo End -->

            <!-- Main Links Start -->
            <ul>
                <li>
                    <a href="<?php echo $baseUrl; ?>/index.php">Home</a>
                </li>
                <li class="middot">
                    &sdot;
                </li>
                <li>
                    <a href="<?php echo $baseUrl; ?>/forum.php">Forum</a>
                </li>
                <li class="middot">
                    &sdot;
                </li>
                <li>
                    <a href="<?php echo $baseUrl; ?>/forum.php">Forum</a>
                </li>
            </ul>
            <!-- Main Links End -->

            <!-- Login/ Register Links Start -->
            <ul>
                <li>
                    <a href="<?php echo $baseUrl; ?>/login.php">Login</a>
                </li>
                <li class="register">
                    <a href="<?php echo $baseUrl; ?>/register.php">Register</a>
                </li>
            </ul>
            <!-- Login/ Register Links End -->
        </nav>
    </header>
    <!-- Navigation End -->