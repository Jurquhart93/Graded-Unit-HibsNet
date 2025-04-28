<div class="author">
    <i class="ri-user-shared-line user-icon"></i>

    <?php if (!empty($subReply)) { ?>
        <a href="<?php echo $baseUrl; ?>/profile.php?id=<?php echo $subReply['member_id']; ?>"><?php echo $subReply['username']; ?></a>
        <span>&sdot; <?php echo CreatedAt($subReply['created_at']); ?> &sdot;</span>

        <?php if (isset($member['admin']) || isset($member['moderator']) || isset($member['username']) === $subReply['username']) { ?>
            <a href="<?php echo $baseUrl; ?>/components/edit-form.php?id=<?php echo $subReply['id']; ?>&name=sub-reply&username=<?php echo $member['username']; ?>"><i class="ri-edit-line"></i></a>
        <?php } ?>
    <?php } elseif (!empty($reply)) { ?>
        <a href="<?php echo $baseUrl; ?>/profile.php?id=<?php echo $reply['member_id']; ?>"><?php echo $reply['username']; ?></a>
        <span>&sdot; <?php echo CreatedAt($reply['created_at']); ?> &sdot;</span>

        <?php if (isset($member['admin']) || isset($member['moderator']) || isset($member['username']) === $reply['username']) { ?>
            <a href="<?php echo $baseUrl; ?>/components/edit-form.php?id=<?php echo $reply['id']; ?>&name=reply&username=<?php echo $member['username']; ?>"><i class="ri-edit-line"></i></a>
        <?php } ?>
    <?php } elseif (!empty($post)) { ?>
        <a href="<?php echo $baseUrl; ?>/profile.php?id=<?php echo $post['member_id']; ?>"><?php echo $post['username']; ?></a>
        <span>&sdot; <?php echo CreatedAt($post['created_at']); ?> &sdot;</span>

        <?php if (isset($member['admin']) || isset($member['moderator']) || isset($member['username']) === $post['username']) { ?>
            <a href="<?php echo $baseUrl; ?>/components/edit-form.php?id=<?php echo $post['id']; ?>&name=post&username=<?php echo $member['username']; ?>"><i class="ri-edit-line"></i></a>
        <?php } ?>
    <?php } ?>


    <div class="warning-container">
        <!-- More Icon Start -->
        <i class="ri-flag-line report" data-open-warning-box></i>
        <!-- More Icon End -->

        <dialog data-warning-box class="dialog">
            <!-- CLOSE WARNING BOX -->
            <div data-close-warning-box class="dialog__header">
                <h3>Are you sure?</h3>
                <i class="ri-close-large-fill"></i>
            </div>

            <hr>

            <section>
                <p>Are you sure you want to report this post?</p>
                <!-- FORM TO DELETE FILM -->
                <form method="POST" class="form">
                    <div class="form__button">
                        <?php if (!empty($subReply)) { ?>
                            <button name="report-sub_reply" value="<?php echo e($subReply['id']); ?>">Report</button>
                        <?php } elseif (!empty($reply)) { ?>
                            <button name="report-reply" value="<?php echo e($reply['id']); ?>">Report</button>
                        <?php } elseif (!empty($post)) { ?>
                            <button name="report-post" value="<?php echo e($post['id']); ?>">Report</button>
                        <?php } ?>
                    </div>
                </form>
            </section>
        </dialog>
    </div>
</div>