<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<?php
$memberId = $_GET['id'];

$memberDetails = PreparedSelectStmt($conn, "SELECT * FROM gu_members WHERE id = ?", "i", [$memberId]);

$memberPosts = PreparedSelectStmt($conn, "SELECT
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
                                WHERE gu_posts.member_id = ?
                                ORDER BY gu_posts.created_at LIMIT 2", "i", [$memberId]);

if (isset($memberPosts['id'])) {
    $memberPosts = [$memberPosts];
}

$memberReplies = PreparedSelectStmt($conn, "SELECT
                                    gu_posts.id,
                                    gu_subcategories.id AS subcategory_id, 
                                    gu_subcategories.subcategory_name, 
                                    gu_members.username,
                                    gu_replies.member_id, 
                                    gu_posts.post_name, 
                                    gu_replies.reply_content AS post_content,
                                    gu_posts.created_at
                                FROM gu_posts
                                JOIN gu_subcategories ON gu_subcategories.id = gu_posts.subcategory_id
                                JOIN gu_members ON gu_members.id = gu_posts.member_id 
                                JOIN gu_replies ON gu_replies.post_id = gu_posts.id
                                WHERE gu_posts.member_id = ?
                                ORDER BY gu_posts.created_at LIMIT 2", "i", [$memberId]);

if (isset($memberReplies['id'])) {
    $memberReplies = [$memberReplies];
}

$memberSubReplies = PreparedSelectStmt($conn, "SELECT
                                    gu_posts.id,
                                    gu_subcategories.id AS subcategory_id, 
                                    gu_subcategories.subcategory_name, 
                                    gu_members.username,
                                    gu_posts.post_name, 
                                    gu_sub_replies.member_id, 
                                    gu_sub_replies.sub_reply_content AS post_content,
                                    gu_posts.created_at
                                FROM gu_posts
                                JOIN gu_subcategories ON gu_subcategories.id = gu_posts.subcategory_id
                                JOIN gu_members ON gu_members.id = gu_posts.member_id 
                                JOIN gu_replies ON gu_replies.post_id = gu_posts.id
                                JOIN gu_sub_replies ON gu_replies.id = gu_sub_replies.reply_id
                                WHERE gu_posts.member_id = ?
                                ORDER BY gu_posts.created_at LIMIT 2", "i", [$memberId]);

if (isset($memberSubReplies['id'])) {
    $memberSubReplies = [$memberSubReplies];
}

if (isset($_POST['member'])) {
    $privateMember = 1;

    $stmt = $conn->prepare("UPDATE gu_members SET private_member = ? WHERE id = ?");
    $stmt->bind_param("ii", $privateMember, $memberId);
    $stmt->execute();
    $stmt->close();

    setStatus("Successfully became a Private Member");
    header("Location: " . $baseUrl . "/profile.php?id=" . $memberId);
}

if (isset($_POST['make-moderator'])) {
    $moderator = 1;

    $stmt = $conn->prepare("UPDATE gu_members SET moderator = ? WHERE id = ?");
    $stmt->bind_param("ii", $moderator, $memberId);
    $stmt->execute();
    $stmt->close();

    setStatus("Successfully assigned Moderator Priviliges");
    header("Location: " . $baseUrl . "/profile.php?id=" . $memberId);
}

if (isset($_POST['remove-moderator'])) {
    $moderator = 0;

    $stmt = $conn->prepare("UPDATE gu_members SET moderator = ? WHERE id = ?");
    $stmt->bind_param("ii", $moderator, $memberId);
    $stmt->execute();
    $stmt->close();

    setStatus("Successfully un-assigned Moderator Priviliges");
    header("Location: " . $baseUrl . "/profile.php?id=" . $memberId);
}

if (isset($_POST['make-admin'])) {
    $admin = 1;

    $stmt = $conn->prepare("UPDATE gu_members SET admin = ? WHERE id = ?");
    $stmt->bind_param("ii", $admin, $memberId);
    $stmt->execute();
    $stmt->close();

    setStatus("Successfully assigned admin Priviliges");
    header("Location: " . $baseUrl . "/profile.php?id=" . $memberId);
}

if (isset($_POST['remove-admin'])) {
    $admin = 0;

    $stmt = $conn->prepare("UPDATE gu_members SET admin = ? WHERE id = ?");
    $stmt->bind_param("ii", $admin, $memberId);
    $stmt->execute();
    $stmt->close();

    setStatus("Successfully un-assigned admin Priviliges");
    header("Location: " . $baseUrl . "/profile.php?id=" . $memberId);
}
?>

<!-- Setting Page Title Start -->
<?php $pageTitle = "Profile"; ?>
<!-- Setting Page Title Start -->

<!-- Including Header Start -->
<?php include_once(__DIR__ . "/partials/header.php"); ?>
<!-- Including Header End -->

<!-- Main Content Start -->
<main class="main">
    <!-- Profile Start -->
    <section class="profile container">
        <h1 class="title title--h1"><?php echo ucfirst($memberDetails['username']); ?>'s Profile</h1>

        <!-- Priviliges Start -->
        <div class="profile__priviliges">
            <!-- Checking If Logged-In User Is An Admin Start -->
            <?php if ($member['admin'] && !$memberDetails['admin'] || !$memberDetails['moderator']) { ?>
                <div>
                    <!-- Checking If Member Is A Moderator or Not Start -->
                    <?php if (!$memberDetails['moderator']) { ?>
                        <form method="POST">
                            <div class="form__button">
                                <button name="make-moderator" id="make-moderator">Make Moderator</button>
                            </div>
                        </form>
                    <?php } elseif ($memberDetails['moderator']) { ?>
                        <form method="POST">
                            <div class="form__button">
                                <button name="remove-moderator" id="remove-moderator">Remove as Moderator</button>
                            </div>
                        </form>
                    <?php } ?>
                    <!-- Checking If Member Is A Moderator or Not End -->
                </div>

                <div>
                    <!-- Checking If Member Is An Admin or Not Start -->
                    <?php if (!$memberDetails['admin']) { ?>
                        <form method="POST">
                            <div class="form__button">
                                <button name="make-admin" id="make-admin">Make Admin</button>
                            </div>
                        </form>
                    <?php } elseif ($memberDetails['admin']) { ?>
                        <form method="POST">
                            <div class="form__button">
                                <button name="remove-admin" id="remove-admin">Remove as Admin</button>
                            </div>
                        </form>
                    <?php } ?>
                    <!-- Checking If Member Is An Admin or Not End -->
                </div>
            <?php } ?>
            <!-- Checking If Logged-In User Is An Admin End -->

            <!-- Checking If Member Is Not A Member Start -->
            <?php if (!$member['private_member'] &&  $member['id'] == $memberDetails['id']) { ?>
                <!-- Becoming A Member Start -->
                <div>
                    <form method="POST">
                        <div class="form__button">
                            <button name="member" id="become-a-member">Become a Member</button>
                        </div>
                    </form>
                </div>
                <!-- Becoming A Member End -->
            <?php } ?>
            <!-- Checking If Member Is Not A Member End -->
        </div>
        <!-- Priviliges End -->

        <!-- Recent Posts Start -->
        <div class="profile__wrapper">
            <h2 class="title title--h2">Recent Posts</h2>
            <?php if (!empty($memberPosts)) { ?>
                <?php foreach ($memberPosts as $post) { ?>
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
            <?php } else { ?>
                <p>No recent posts.</p>
            <?php } ?>
        </div>
        <!-- Recent Posts End -->

        <!-- Recent Replies Start -->
        <div class="profile__wrapper">
            <h3 class="title title--h2">Recent Replies</h3>
            <?php if (!empty($memberReplies)) { ?>
                <?php foreach ($memberReplies as $post) { ?>
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
            <?php } else { ?>
                <p>No recent replies.</p>
            <?php } ?>
        </div>
        <!-- Recent Replies End -->

        <!-- Recent Sub Replies Start -->
        <div class="profile__wrapper">
            <h4 class="title title--h2">Recent Sub Replies</h4>
            <?php if (!empty($memberSubReplies)) { ?>
                <?php foreach ($memberSubReplies as $post) { ?>
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
            <?php } else { ?>
                <p>No recent sub replies.</p>
            <?php } ?>
        </div>
        <!-- Recent Sub Replies End -->
    </section>
    <!-- Profile End -->
</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->