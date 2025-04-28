<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/../includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<?php
if (!isset($_SESSION['user'])) {
    if (!$member['admin'] || !$member['moderator']) {
        header("Location: " . $baseUrl . "/404.php");
    }
}
?>

<!-- Setting Page Title Start -->
<?php $pageTitle = "Admin Panel"; ?>
<!-- Setting Page Title Start -->

<!-- Including Header Start -->
<?php include_once(__DIR__ . "/../partials/header.php"); ?>
<!-- Including Header End -->

<!-- Main Content Start -->
<main class="main">
    <!-- Admin Panel Start -->
    <section class="container admin">
        <!-- Requiring Admin Nav Start -->
        <?php require(__DIR__ . "/../partials/admin-nav.php"); ?>
        <!-- Requiring Admin Nav End -->

        <!-- Admin Content Start -->
        <section class="admin__content">
            <h1>Dashboard</h1>

            <!-- Admin Dashboard Start -->
            <div class="admin__dashboard">

                <!-- Admin Card Start -->
                <article class="admin__card">
                    <i class="ri-group-line"></i>
                    <p>12</p>
                    <p>Members</p>
                </article>
                <!-- Admin Card End -->

                <!-- Admin Card Start -->
                <article class="admin__card">
                    <i class="ri-shield-user-line"></i>
                    <p>2</p>
                    <p>Private Members</p>
                </article>
                <!-- Admin Card End -->

                <!-- Admin Card Start -->
                <article class="admin__card">
                    <i class="ri-chat-thread-line"></i>
                    <p>12</p>
                    <p>Total Threads</p>
                </article>
                <!-- Admin Card End -->

                <!-- Admin Card Start -->
                <article class="admin__card">
                    <i class="ri-chat-1-line"></i>
                    <p>65</p>
                    <p>Total Posts</p>
                </article>
                <!-- Admin Card End -->

            </div>
            <!-- Admin Dashboard End -->
        </section>
        <!-- Admin Content End -->
    </section>
    <!-- Admin Panel End -->
</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/../partials/footer.php"); ?>
<!-- Including Footer End -->