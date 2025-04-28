<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<?php
$subcategoryId = $_GET['subcategory_id'];

$catAndSubcategoryData = PreparedSelectStmt($conn, "SELECT 
                                                    gu_categories.id AS category_id,
                                                    gu_categories.category_name,
                                                    gu_subcategories.id AS subcategory_id,
                                                    gu_subcategories.subcategory_name
                                                FROM gu_subcategories
                                                JOIN gu_categories ON gu_categories.id = gu_subcategories.category_id
                                                WHERE gu_subcategories.id = ?", "i", [$subcategoryId]);

$categoryId = $catAndSubcategoryData['category_id'];
$categoryName = $catAndSubcategoryData['category_name'];
$subcategoryId = $catAndSubcategoryData['subcategory_id'];
$subcategoryName = $catAndSubcategoryData['subcategory_name'];

$posts = PreparedSelectStmt($conn, "SELECT * FROM gu_posts WHERE category_id = ? AND subcategory_id = ? ORDER BY gu_posts.latest_post DESC", "ii", [$categoryId, $subcategoryId]);

if (isset($posts['id'])) {
    $posts = [$posts];
}
?>

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
            <a href="<?php echo $baseUrl ?>/forum.php">Categories</a>
            <span>/</span>
            <h1 class="title title--h1"><?php echo $subcategoryName; ?></h1>
        </div>
        <!-- Subcategory Header End -->

        <!-- Create Thread Button Start -->
        <?php if (isset($_SESSION['user'])) { ?>
            <a class="button button__post" href="<?php echo $baseUrl; ?>/components/post-form.php?subcategory_id=<?php echo $subcategoryId; ?>&post_name=post">Create a New Thread</a>
        <?php } ?>
        <!-- Create Thread Button End -->

        <?php if (!empty($posts)) { ?>
            <!-- For Each Post Start -->
            <?php foreach ($posts as $el) { ?>
                <?php $post = PreparedSelectStmt(
                    $conn,
                    "SELECT
                        gu_posts.id,
                        gu_subcategories.id AS subcategory_id, 
                        gu_subcategories.subcategory_name, 
                        gu_members.username, 
                        gu_posts.post_name, 
                        gu_posts.post_content,
                        gu_posts.created_at,
                        gu_posts.latest_post
                    FROM gu_posts
                    JOIN gu_subcategories ON gu_subcategories.id = gu_posts.subcategory_id
                    JOIN gu_members ON gu_members.id = gu_posts.member_id 
                    WHERE gu_posts.id = ?",
                    "i",
                    [$el['id']]
                );
                ?>

                <!-- Including Post(s) Start -->
                <section class="post">
                    <?php $postName = $post['post_name']; ?>
                    <?php require("./components/post/name.php"); ?>

                    <div class="post__footer">
                        <?php
                        $rows_per_page = 2;
                        $records = $conn->query("SELECT * FROM gu_replies WHERE post_id = $post[id]");
                        $num_of_rows = $records->num_rows;
                        $pages = ceil($num_of_rows / $rows_per_page);
                        ?>

                        <div class="pagination">
                            <?php
                            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $start = max(2, $currentPage - 2);
                            $end = min($pages - 1, $currentPage + 2); ?>

                            <a href="<?php echo $baseUrl; ?>/thread.php?id=<?php echo $post['id']; ?>&page=1">1</a>

                            <?php if ($start > 2) { ?>
                                <span>...</span>
                            <?php } ?>

                            <?php for ($i = $start; $i <= $end; $i++) { ?>
                                <a href="<?php echo $baseUrl; ?>/thread.php?id=<?php echo $post['id']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            <?php } ?>

                            <?php if ($end < $pages - 1) { ?>
                                <span>...</span>
                            <?php } ?>

                            <?php if ($pages > 1) { ?>
                                <a href="<?php echo $baseUrl; ?>/thread.php?id=<?php echo $post['id']; ?>&page=<?php echo $pages; ?>"><?php echo $pages; ?></a>
                            <?php } ?>
                        </div>

                        <p>Last Post: <?php echo CreatedAt($post['latest_post']); ?></p>
                    </div>
                </section>
                <!-- Including Post(s) End -->
            <?php } ?>
            <!-- For Each Post End -->
        <?php } else { ?>
            <p>No posts to show.</p>
        <?php } ?>
    </section>
    <!-- Subcategory End -->
</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->