<?php $createdAt = CreatedAt($subReply['created_at']); ?>

<!-- Sub Reply Start -->
<div class="sub-reply__container">
    <div class="connector">
        <div class="connector--straight"></div>
        <div class="connector--double"></div>
        <div class="connector--straight"></div>
    </div>

    <!-- Reply Start -->
    <div class="post post__sub">
        <!-- Post Text Start -->
        <div>
            <?php echo $subReply['sub_reply_content']; ?>
        </div>
        <!-- Post Text End -->

        <!-- Author Start -->
        <p class="author">
            Created by: <a href="#"><?php echo e($subReply['username']); ?></a>
            <span>&sdot; <?php echo e($createdAt) ?></span>
        </p>
        <!-- Author End -->
    </div>
    <!-- Reply Start -->
</div>
<!-- Sub Reply Container End -->