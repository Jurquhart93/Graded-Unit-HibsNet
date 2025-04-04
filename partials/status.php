<?php
if (isset($_SESSION['status'])) { ?>
    <div class="status">
        <p><?php echo $_SESSION['status']; ?></p>
    </div>
    <?php unset($_SESSION['status']); ?>
<?php } ?>