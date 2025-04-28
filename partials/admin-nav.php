<aside class="aside">
    <ul class="aside__links">
        <?php if ($member['moderator'] || $member['admin']) { ?>
            <li class="aside__link">
                <a href="<?php echo $baseUrl; ?>/admin/"><i class="ri-dashboard-line"></i> Dashboard</a>
            </li>
        <?php } ?>
        <?php if ($member['admin']) { ?>
            <li class="aside__link">
                <a href="<?php echo $baseUrl; ?>/admin/members.php"><i class="ri-group-line"></i> Members</a>
            </li>
        <?php } ?>
        <?php if ($member['moderator'] || $member['admin']) { ?>
            <li class="aside__link">
                <a href="<?php echo $baseUrl; ?>/admin/reports.php"><i class="ri-file-chart-line"></i> Reports</a>
            </li>
        <?php } ?>
    </ul>
</aside>