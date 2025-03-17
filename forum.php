<!-- Inlcuding Database Files Start -->
<?php include_once(__DIR__ . '/database/conn.php'); ?>
<!-- Inlcuding Database Files End -->

<!-- Setting Page Title Start -->
<?php $pageTitle = "Forum"; ?>
<!-- Setting Page Title Start -->

<!-- Including Header Start -->
<?php include_once(__DIR__ . "/partials/header.php"); ?>
<!-- Including Header End -->

<!-- Main Content Start -->
<main class="main">
    <!-- Forum Content Start -->
    <section class="forum container">
        <h1 class="title title--h1">Forum Categories</h1>

        <section class="categories">
            <!-- Including Categories Start -->
            <?php include("./components/category.php") ?>
            <!-- Including Categories End -->
        </section>
    </section>
    <!-- Forum Content End -->

</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->