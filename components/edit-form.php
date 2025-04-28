<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/../includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<?php
if (isset($member['admin']) || isset($member['moderator']) || $member['username'] === $_GET['username']) {

    if ($_GET['name'] === "post") {
        $id = $_GET['id'];
        $tableName = "gu_posts";
        $contentName = "post_content";
    } elseif ($_GET['name'] === "reply") {
        $id = $_GET['id'];
        $tableName = "gu_replies";
        $contentName = "reply_content";
    } elseif ($_GET['name'] === "sub-reply") {
        $id = $_GET['id'];
        $tableName = "gu_sub_replies";
        $contentName = "sub_reply_content";
    }

    $post = PreparedSelectStmt($conn, "SELECT * FROM $tableName WHERE id = ?", "i", [$id]);

    if (isset($_POST['edit-post'])) {
        $content = $_POST['post-content'];

        if (isset($_POST['post-name'])) {
            $postName = $_POST['post-name'];

            $stmt = $conn->prepare("UPDATE $tableName SET post_name = ?, $contentName = ? WHERE id = ?");
            $stmt->bind_param("ssi", $postName, $content, $id);
        } else {
            $stmt = $conn->prepare("UPDATE $tableName SET $contentName = ? WHERE id = ?");
            $stmt->bind_param("si", $content, $id);
        }
        $stmt->execute();
        $stmt->close();

        setStatus("Post Successfully Updated");

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

            <?php if ($_GET['name'] === 'post') { ?>
                <div class="form__field">
                    <label for="post-name" class="form__label">Post Title:</label>
                    <input class="form__input" type="text" name="post-name" id="post-name" value="<?php echo $post['post_name']; ?>" ;>
                </div>
            <?php } ?>

            <div class=" form__buttons" id="tooltip-controls">
                <a id="bold-button"><i class="ri-bold"></i></a>
                <a id="italic-button"><i class="ri-italic"></i></a>
                <a id="underline-button"><i class="ri-underline"></i></a>
                <a id="link-button"><i class="ri-link"></i></a>
            </div>

            <div class="form__editor" id="editor">
                <?php echo $post[$contentName]; ?>
            </div>

            <div class="form__field">
                <label style="display: none;" for="post-content" class="form__label">Post Content:</label>
                <textarea style="display: none;" name="post-content" id="post-content"></textarea>
            </div>

            <script type="module" src="<?php echo $baseUrl ?>/js/quill.js"></script>

            <div class="form__button">
                <button type="submit" name="edit-post">Edit</button>
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