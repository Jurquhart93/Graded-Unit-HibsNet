<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<?php
$postId = $_GET['id'];

$post = null;
$reply = null;

$post = PreparedSelectStmt($conn, "SELECT
                                gu_posts.id,
                                gu_subcategories.id AS subcategory_id, 
                                gu_subcategories.subcategory_name, 
                                gu_members.username,
                                gu_posts.member_id, 
                                gu_posts.post_name, 
                                gu_posts.post_content,
                                gu_posts.created_at
                            FROM gu_posts
                            JOIN gu_subcategories ON gu_subcategories.id = gu_posts.subcategory_id
                            JOIN gu_members ON gu_members.id = gu_posts.member_id 
                            WHERE gu_posts.id = ?", "i", [$postId]);


/////////////
// PAGINATION - Code From: https://www.youtube.com/watch?v=3-5DpAiCHy8&t=727s
/////////
$start = 0;

$rows_per_page = 2;

$records = $conn->query("SELECT * FROM gu_replies WHERE post_id = $postId");
$num_of_rows = $records->num_rows;

$pages = ceil($num_of_rows / $rows_per_page);

if (isset($_GET['page'])) {
    $page = $_GET['page'] - 1;

    $start = $page * $rows_per_page;
}

$replies = PreparedSelectStmt($conn, "SELECT 
                                gu_replies.id,
                                gu_members.username,
                                gu_replies.member_id,
                                gu_replies.post_id,
                                gu_replies.reply_content,
                                gu_replies.created_at
                            FROM gu_replies 
                            JOIN gu_members ON gu_members.id = gu_replies.member_id
                            WHERE post_id = ?
                            LIMIT ?, ?", "iii", [$postId, $start, $rows_per_page]);


if (isset($replies['id'])) {
    $replies = [$replies];
}

//////////
// PAGINATION END
////////////
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
        <?php if (isset($_GET['page']) && $_GET['page'] < 2) { ?>
            <section class="post">
                <?php
                $postName = $post['post_name'];
                $username = $post['username'];
                ?>

                <?php require(__DIR__ . "/components/post/breadcrum.php"); ?>
                <?php require(__DIR__ . "/components/post/name.php"); ?>
                <div class="post__wrapper">
                    <?php require(__DIR__ . "/components/post/content.php"); ?>
                    <?php require(__DIR__ . "/components/post/author.php"); ?>
                </div>
            </section>
        <?php } ?>
        <!-- Post End -->

        <!-- If User is Logged In Then Show Button Start -->
        <?php if (isset($_SESSION['user'])) { ?>
            <a class="button--margin button__post" href="<?php echo $baseUrl; ?>/components/post-form.php?post_id=<?php echo $postId; ?>&post_name=post-reply">Add a Reply</a>
        <?php } ?>
        <!-- If User is Logged In Then Show Button End -->

        <!-- Checking if Replies is empty or not Start -->
        <?php if (!empty($replies)) { ?>
            <!-- Include Each Reply Start -->
            <?php foreach ($replies as $reply) { ?>
                <?php include(__DIR__ . "/components/reply.php"); ?>
            <?php } ?>
            <!-- Include Each Reply End -->
        <?php } ?>
        <!-- Checking if Replies is empty or not End -->

        <div class="pagination">
            <?php
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = max(2, $currentPage - 2);
            $end = min($pages - 1, $currentPage + 2);
            ?>

            <a href="<?php echo $baseUrl; ?>/thread.php?id=<?php echo $postId ?>&page=1">1</a>

            <?php if ($start > 2) { ?>
                <span>...</span>
            <?php } ?>

            <?php for ($i = $start; $i <= $end; $i++) { ?>
                <a href="<?php echo $baseUrl; ?>/thread.php?id=<?php echo $postId ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php } ?>

            <?php if ($end < $pages - 1) { ?>
                <span>...</span>
            <?php } ?>

            <?php if ($pages > 1) { ?>
                <a href="<?php echo $baseUrl; ?>/thread.php?id=<?php echo $postId ?>&page=<?php echo $pages; ?>"><?php echo $pages; ?></a>
            <?php } ?>
        </div>
    </section>
    <!-- Thread End -->
</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->