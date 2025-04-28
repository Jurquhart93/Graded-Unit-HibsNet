<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/../includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<?php
if (isset($_SESSION['user'])) {

    $getPostName = $_GET['post_name'];

    if (isset($_POST[$getPostName])) {
        if ($_GET['subcategory_id']) {
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
        $latestPost = date("Y-m-d H:i:s");

        if ($getPostName === 'post') {
            $stmt = $conn->prepare("INSERT INTO gu_posts (category_id, subcategory_id, member_id, post_name, post_content, created_at, latest_post) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiissss", $categoryId, $subcategoryId, $memberId, $postName, $postContent, $createdAt, $latestPost);
        } elseif ($getPostName === 'post-reply') {
            $stmt = $conn->prepare("INSERT INTO gu_replies (member_id, post_id, reply_content, created_at) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $memberId, $postId, $postContent, $createdAt);

            $stmtTwo = $conn->prepare("UPDATE gu_posts SET latest_post = ? WHERE id = ?");
            $stmtTwo->bind_param("si", $createdAt, $postId);
        } elseif ($getPostName === 'post-sub-reply') {
            $stmt = $conn->prepare("INSERT INTO gu_sub_replies (member_id, reply_id, sub_reply_content, created_at) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $memberId, $replyId, $postContent, $createdAt);
        }

        $stmt->execute();
        $insertedId = $conn->insert_id;
        $stmt->close();

        if ($stmtTwo) {
            $stmtTwo->execute();
            $stmtTwo->close();
        }

        if ($getPostName === 'post') {
            $conn->close();

            setStatus("Successfully Added Post!");
            header("Location: " . $baseUrl . "/thread.php?id=" . $insertedId . "&page=1");
        } elseif ($getPostName === 'post-reply') {
            $insertedPostId = PreparedSelectStmt($conn, "SELECT gu_posts.id FROM gu_replies JOIN gu_posts ON gu_posts.id = gu_replies.post_id WHERE gu_replies.id = ?", "i", [$insertedId]);
            $conn->close();

            setStatus("Successfully Added Reply!");
            header("Location: " . $baseUrl . "/thread.php?id=" . $insertedPostId['id'] . "&page=1");
        } elseif ($getPostName === 'post-sub-reply') {
            $insertedPostId = PreparedSelectStmt($conn, "SELECT gu_posts.id FROM gu_sub_replies JOIN gu_replies ON gu_replies.id = gu_sub_replies.reply_id JOIN gu_posts ON gu_posts.id = gu_replies.post_id WHERE gu_sub_replies.id = ?", "i", [$insertedId]);
            $conn->close();

            setStatus("Successfully Added Sub Reply!");
            header("Location: " . $baseUrl . "/thread.php?id=" . $insertedPostId['id'] . "&page=1");
        }
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