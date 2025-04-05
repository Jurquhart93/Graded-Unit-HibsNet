<?php $subReplies = GetSubReplies($conn, $reply['id']); ?>

<!-- Reply Start -->
<div class="post reply">
    <div class="post__wrapper">
        <?php $username = $reply['username']; ?>
        <?php echo $reply['reply_content']; ?>
        <?php require(__DIR__ . "/post/author.php"); ?>
    </div>

    <?php if (!empty($subReplies)) { ?>
        <a class="view-reply"><span>View Replies</span> <i class="ri-corner-right-down-line"></i></a>
    <?php } else { ?>
        <a class="view-reply"><span>Reply</span> <i class="ri-corner-right-down-line"></i></a>
    <?php } ?>

    <div class="sub-reply">
        <?php foreach ($subReplies as $subReply) { ?>
            <div class="post__wrapper sub-reply__post">

                <?php $username = $subReply['username']; ?>
                <?php echo $subReply['sub_reply_content']; ?>
                <?php require(__DIR__ . "/post/author.php"); ?>
            </div>
        <?php } ?>

        <?php if (isset($_SESSION['user'])) { ?>
            <a class="button button__post" href="<?php echo $baseUrl; ?>/components/post-form.php?reply_id=<?php echo $reply['id']; ?>&post_name=post-sub-reply">Add a Sub-Reply</a>
        <?php } ?>
    </div>
</div>
<!-- Reply End -->