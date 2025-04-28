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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Quill Rich Text Editor Start -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.core.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.core.js"></script>
    <!-- Quill Rich Text Editor End -->

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

            <!-- Hamburget Menu Start -->
            <div class="hamburger">
                <i class="ri-menu-line" id="hamburger-icon"></i>
            </div>
            <!-- Hamburget Menu End -->

            <div class="nav__links">
                <!-- Main Links Start -->
                <ul>
                    <li>
                        <a href="<?php echo $baseUrl; ?>/index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo $baseUrl; ?>/forum.php">Forum</a>
                    </li>
                    <?php if (isset($_SESSION['user']) && $member['admin'] || isset($_SESSION['user']) && $member['moderator']) { ?>
                        <li>
                            <a href="<?php echo $baseUrl; ?>/admin/">Admin Panel</a>
                        </li>
                    <?php } ?>
                </ul>
                <!-- Main Links End -->

                <!-- Login/ Register Links Start -->
                <ul>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li>
                            <a href="<?php echo $baseUrl; ?>/profile.php?id=<?php echo $member['id']; ?>">Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo $baseUrl; ?>/logout.php">Logout</a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo $baseUrl; ?>/login.php">Login</a>
                        </li>
                        <li class="register">
                            <a href="<?php echo $baseUrl; ?>/register.php">Register</a>
                        </li>
                    <?php } ?>
                </ul>
                <!-- Login/ Register Links End -->
            </div>
        </nav>
    </header>
    <!-- Navigation End -->