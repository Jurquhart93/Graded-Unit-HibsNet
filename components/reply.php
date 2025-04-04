<?php
$createdAt = CreatedAt($reply['created_at']);
$subReplies = GetSubReplies($conn, $reply['id']);
?>

<!-- Reply Start -->
<div class="reply">
    <div class="reply__header">
        <div class="author">
            Reply by: <a href="#"><?php echo $reply['username']; ?></a>
            <span>&sdot; <?php echo $createdAt; ?></span>
        </div>

        <!-- More Icon Start -->
        <i class="ri-more-2-line"></i>
        <!-- More Icon End -->
    </div>

    <!-- <div class="reply__body"> -->
    <?php echo $reply['reply_content']; ?>
    <!-- </div> -->

    <?php if (!empty($subReplies)) { ?>
        <div class="reply__footer">
            <a class="view-reply" id="view-reply">View Replies</a>
            <i class="ri-corner-right-down-line"></i>
        </div>

        <div class="sub-reply">
            <?php foreach ($subReplies as $subReply) { ?>
                <!-- Inlcuding Sub-Reply Start -->
                <?php require(__DIR__ . "/sub-reply.php"); ?>
                <!-- Inlcuding Sub-Reply End -->
            <?php } ?>

            <!-- Including Reply Form Start -->
            <a href="<?php echo $baseUrl; ?>/components/post-form.php?reply_id=<?php echo $reply['id']; ?>&post_name=post-sub-reply">Post</a>
            <!-- Including Reply Form End -->
        </div>
    <?php } else { ?>
        <div class="reply__footer">
            <a class="view-reply">Reply</a>
            <i class="ri-corner-right-down-line"></i>
        </div>

        <!-- Inlcuding Sub-Reply Start -->
        <div class="sub-reply">
            <!-- Including Reply Form Start -->
            <a href="<?php echo $baseUrl; ?>/components/post-form.php?reply_id=<?php echo $reply['id']; ?>&post_name=post-sub-reply">Post</a>
            <!-- Including Reply Form End -->
        </div>
        <!-- Inlcuding Sub-Reply End -->
    <?php } ?>

</div>
<!-- Reply End -->