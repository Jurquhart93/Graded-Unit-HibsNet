<!-- Inlcuding Database Files Start -->
<?php include_once(__DIR__ . '/database/conn.php'); ?>
<!-- Inlcuding Database Files End -->

<!-- Setting Page Title Start -->
<?php $pageTitle = "Subcategory"; ?>
<!-- Setting Page Title Start -->

<!-- Including Header Start -->
<?php include_once(__DIR__ . "/partials/header.php"); ?>
<!-- Including Header End -->

<!-- Main Content Start -->
<main class="main">
    <!-- Subcategory Start -->
    <section class="subcategory container">
        <!-- Subcategory Header Start -->
        <div class="subcategory__header">
            <div>
                <a href="<?php echo $baseUrl ?>/forum.php">Categories</a>
                <span>/</span>
                <h1>Subcategory</h1>
            </div>

            <i class="ri-filter-line"></i>
        </div>
        <!-- Subcategory Header End -->

        <!-- Including Post(s) Start -->
        <?php include("./components/post.php"); ?>
        <?php include("./components/post.php"); ?>
        <?php include("./components/post.php"); ?>
        <?php include("./components/post.php"); ?>
        <!-- Including Post(s) End -->
    </section>
    <!-- Subcategory End -->
</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->