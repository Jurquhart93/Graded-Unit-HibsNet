<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<?php
$subcategoryId = $_GET['subcategory_id'];

$catAndSubcategoryData = GetCatAndSubcat($conn, $subcategoryId);

$categoryId = $catAndSubcategoryData['category_id'];
$categoryName = $catAndSubcategoryData['category_name'];
$subcategoryId = $catAndSubcategoryData['subcategory_id'];
$subcategoryName = $catAndSubcategoryData['subcategory_name'];

$posts = GetPosts($conn, $categoryId, $subcategoryId);
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

        <a href="<?php echo $baseUrl; ?>/components/post-form.php?subcategory_id=<?php echo $subcategoryId; ?>&post_name=post">Post</a>

        <!-- Subcategory Header Start -->
        <div class="subcategory__header">
            <div>
                <a href="<?php echo $baseUrl ?>/forum.php">Categories</a>
                <span>/</span>
                <h1><?php echo $subcategoryName; ?></h1>
            </div>

            <i class="ri-filter-line"></i>
        </div>
        <!-- Subcategory Header End -->

        <?php foreach ($posts as $post) { ?>
            <?php $post = GetPostById($conn, $post['id']); ?>

            <!-- Including Post(s) Start -->
            <section class="post">
                <?php $postName = $post['post_name']; ?>
                <?php include("./components/post-container.php"); ?>
            </section>
            <!-- Including Post(s) End -->
        <?php } ?>
    </section>
    <!-- Subcategory End -->
</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->