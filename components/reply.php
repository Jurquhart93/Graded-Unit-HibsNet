<?php $subReplies = GetSubReplies($conn, $reply['id']); ?>

<!-- Reply Start -->
<div class="post reply">
    <?php echo $reply['reply_content']; ?>

    <p class="author">
        Reply by: <a href="#"><?php echo $reply['username']; ?></a>
        <span>&sdot; <?php echo CreatedAt($reply['created_at']); ?></span>
    </p>

    <?php if (!empty($subReplies)) { ?>
        <a class="view-reply"><span>View Replies</span> <i class="ri-corner-right-down-line"></i></a>
    <?php } else { ?>
        <a class="view-reply"><span>Reply</span> <i class="ri-corner-right-down-line"></i></a>
    <?php } ?>

    <div class="sub-reply">
        <?php foreach ($subReplies as $subReply) { ?>
            <?php echo $subReply['sub_reply_content']; ?>

            <p class="author">
                Reply by: <a href="#"><?php echo $subReply['username']; ?></a>
                <span>&sdot; <?php echo CreatedAt($subReply['created_at']); ?></span>
            </p>
        <?php } ?>

        <?php if (isset($_SESSION['user'])) { ?>
            <a class="button button__post" href="<?php echo $baseUrl; ?>/components/post-form.php?reply_id=<?php echo $reply['id']; ?>&post_name=post-sub-reply">Add a Sub-Reply</a>
        <?php } ?>
    </div>
</div>
<!-- Reply End -->