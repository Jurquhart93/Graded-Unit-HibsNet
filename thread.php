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
        <!-- Post Start -->
        <section class="post">
            <?php $postName = $post['post_name']; ?>
            <?php include_once(__DIR__ . "/components/post/breadcrum.php"); ?>
            <?php include_once(__DIR__ . "/components/post/content.php"); ?>
            <?php include_once(__DIR__ . "/components/post/author.php"); ?>
        </section>
        <!-- Post End -->

        <!-- If User is Logged In Then Show Button Start -->
        <?php if (isset($_SESSION['user'])) { ?>
            <a class="button--margin button__post" href="<?php echo $baseUrl; ?>/components/post-form.php?post_id=<?php echo $postId; ?>&post_name=post-reply">Add a Reply</a>
        <?php } ?>
        <!-- If User is Logged In Then Show Button End -->

        <!-- Include Each Reply Start -->
        <?php foreach ($replies as $reply) { ?>
            <?php include(__DIR__ . "/components/reply.php"); ?>
        <?php } ?>
        <!-- Include Each Reply End -->
    </section>
    <!-- Thread End -->
</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->