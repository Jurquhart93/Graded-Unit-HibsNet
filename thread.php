<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<?php
$postId = $_GET['id'];
$post = GetPostById($conn, $postId);
$replies = GetReplies($conn, $postId);
?>

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
        <section class="post">
            <?php $postName = $post['post_name']; ?>
            <!-- Including Post Start -->
            <?php include_once(__DIR__ . "/components/post-header.php"); ?>
            <?php include_once(__DIR__ . "/components/post-container.php"); ?>
            <!-- Including Post End -->
        </section>

        <!-- Checking If Replies Is Not Empty Start -->
        <?php if (!empty($replies)) { ?>
            <?php foreach ($replies as $reply) { ?>
                <!-- Including Reply Start -->
                <?php include(__DIR__ . "/components/reply.php"); ?>
                <!-- Including Reply End -->
            <?php } ?>
        <?php } ?>
        <!-- Checking If Replies Is Not Empty End -->

        <!-- Checking If User Is Logged In Start -->
        <?php if (isset($_SESSION['user'])) { ?>

            <!-- Including Reply Form Start -->
            <a href="<?php echo $baseUrl; ?>/components/post-form.php?post_id=<?php echo $postId; ?>&post_name=post-reply">Post</a>
            <!-- Including Reply Form End -->
        <?php } ?>
        <!-- Checking If User Is Logged In End -->
    </section>
    <!-- Thread End -->
</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->