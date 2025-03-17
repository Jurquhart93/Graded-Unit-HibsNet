<!-- Inlcuding Database Files Start -->
<?php include_once(__DIR__ . '/database/conn.php'); ?>
<!-- Inlcuding Database Files End -->

<!-- Setting Page Title Start -->
<?php $pageTitle = "Post"; ?>
<!-- Setting Page Title Start -->

<!-- Including Header Start -->
<?php include_once(__DIR__ . "/partials/header.php"); ?>
<!-- Including Header End -->

<!-- Main Content Start -->
<main class="main">
    <!-- Thread Start -->
    <section class="thread container">
        <!-- Including Post(s) Start -->
        <?php include("./components/post.php"); ?>
        <!-- Including Post(s) End -->

        <!-- Reply Start -->
        <div class="reply">
            <div class="reply__header">
                <div>
                    Reply by: <a href="#">Authors Names</a>
                    <span>&sdot; 12 hours ago</span>
                </div>

                <!-- More Icon Start -->
                <i class="ri-more-2-line"></i>
                <!-- More Icon End -->
            </div>

            <p class="reply__body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Asperiores ab cupiditate vitae optio maxime distinctio dolorum
                corrupti quisquam harum, aspernatur, hic et doloribus debitis,
                minus quos ipsam sunt facilis. Aliquid blanditiis alias magnam
                ad vel error nostrum eaque!
            </p>

            <div class="reply__footer">
                <a href="#">View 3 Replies</a>
                <i class="ri-corner-right-down-line"></i>
            </div>
        </div>
        <!-- Reply End -->
    </section>
    <!-- Thread End -->
</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->