<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/../includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<?php
if (isset($_SESSION['user'])) {

    $getPostName = $_GET['post_name'];

    if (isset($_POST[$getPostName])) {
        if ($_GET['subcategory_id']) {
            $subcategoryId = $_GET['subcategory_id'];

            $catAndSubcategoryData = GetCatAndSubcat($conn, $subcategoryId);

            $categoryId = $catAndSubcategoryData['category_id'];
            $subcategoryId = $catAndSubcategoryData['subcategory_id'];
        } elseif ($_GET['post_id']) {
            $postId = $_GET['post_id'];
        } elseif ($_GET['reply_id']) {
            $replyId = $_GET['reply_id'];
        }

        if (isset($_POST['post-name'])) {
            $postName = $_POST['post-name'];
        }

        $postContent = PurifyHtml($_POST['post-content']);
        $createdAt = date("Y-m-d H:i:s");

        if ($getPostName === 'post') {
            $stmt = $conn->prepare("INSERT INTO gu_posts (category_id, subcategory_id, member_id, post_name, post_content, created_at) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiisss", $categoryId, $subcategoryId, $memberId, $postName, $postContent, $createdAt);
        } elseif ($getPostName === 'post-reply') {
            $stmt = $conn->prepare("INSERT INTO gu_replies (member_id, post_id, reply_content, created_at) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $memberId, $postId, $postContent, $createdAt);
        } elseif ($getPostName === 'post-sub-reply') {
            $stmt = $conn->prepare("INSERT INTO gu_sub_replies (member_id, reply_id, sub_reply_content, created_at) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $memberId, $replyId, $postContent, $createdAt);
        }

        $stmt->execute();
        $stmt->close();
        $conn->close();

        setStatus("Successfully Added Post!");

        header("Location: " . $baseUrl . "/forum.php");
    }
} else {
    header("Location: " . $baseUrl . "/404.php");
}
?>

<!-- Setting Page Title Start -->
<?php $pageTitle = "Post"; ?>
<!-- Setting Page Title Start -->

<!-- Including Header Start -->
<?php include_once(__DIR__ . "/../partials/header.php"); ?>
<!-- Including Header End -->

<main class="main">
    <section class="container">
        <form method="POST" class="form" id="post-identifier">

            <?php if ($getPostName === 'post') { ?>
                <div class="form__field">
                    <label for="post-name" class="form__label">Post Title:</label>
                    <input class="form__input" type="text" name="post-name" id="post-name">
                </div>
            <?php } ?>

            <div class="form__buttons" id="tooltip-controls">
                <a id="bold-button"><i class="ri-bold"></i></a>
                <a id="italic-button"><i class="ri-italic"></i></a>
                <a id="underline-button"><i class="ri-underline"></i></a>
                <a id="link-button"><i class="ri-link"></i></a>
            </div>

            <div class="form__editor" id="editor"></div>

            <div class="form__field">
                <label style="display: none;" for="post-content" class="form__label">Post Content:</label>
                <textarea style="display: none;" name="post-content" id="post-content"></textarea>
            </div>

            <script type="module" src="<?php echo $baseUrl ?>/js/quill.js"></script>

            <div class="form__button">
                <button type="submit" name="<?php echo $getPostName; ?>">Post Reply</button>
            </div>
        </form>
    </section>

    <script>
        $("#post-identifier").on("submit", function() {
            $("#post-content").val($("#editor").html());
        });
    </script>
</main>

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/../partials/footer.php"); ?>
<!-- Including Footer End -->