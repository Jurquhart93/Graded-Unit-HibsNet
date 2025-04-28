<?php
$subReply = null;

$subReplies = PreparedSelectStmt($conn, "SELECT 
                                    gu_sub_replies.id,
                                    gu_members.username,
                                    gu_sub_replies.member_id,
                                    gu_sub_replies.reply_id,
                                    gu_sub_replies.sub_reply_content,
                                    gu_sub_replies.created_at
                                FROM gu_sub_replies 
                                JOIN gu_members ON gu_members.id = gu_sub_replies.member_id
                                WHERE reply_id = ?", "i",  [$reply['id']]);

if (isset($subReplies['id'])) {
    $subReplies = [$subReplies];
}
?>

<!-- Reply Start -->
<div class="post reply">
    <div class="post__wrapper">
        <?php $username = $reply['username']; ?>
        <?php echo $reply['reply_content']; ?>
        <?php require(__DIR__ . "/post/author.php"); ?>
    </div>

    <div class="sub-reply">
        <!-- Checking if Sub Replies is empty or not Start -->
        <?php if (!empty($subReplies)) { ?>
            <!-- Include Each Sub Reply Start -->
            <?php foreach ($subReplies as $subReply) { ?>
                <div class="post__wrapper sub-reply__post">

                    <?php $username = $subReply['username']; ?>
                    <?php echo $subReply['sub_reply_content']; ?>
                    <?php require(__DIR__ . "/post/author.php"); ?>
                </div>
            <?php } ?>
            <!-- Include Each Sub Reply End -->
        <?php } ?>
        <!-- Checking if Sub Replies is empty or not End -->

        <?php if (isset($_SESSION['user'])) { ?>
            <a class="button button__post" href="<?php echo $baseUrl; ?>/components/post-form.php?reply_id=<?php echo $reply['id']; ?>&post_name=post-sub-reply">Add a Sub-Reply</a>
        <?php } ?>
    </div>

    <?php if (!empty($subReplies)) { ?>
        <a class="view-reply"><span>View Replies</span> <i class="ri-corner-right-down-line"></i></a>
    <?php } else { ?>
        <a class="view-reply"><span>Reply</span> <i class="ri-corner-right-down-line"></i></a>
    <?php } ?>
</div>
<!-- Reply End -->