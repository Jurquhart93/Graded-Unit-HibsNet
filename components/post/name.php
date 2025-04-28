<?php if (!empty($postName)) { ?>
    <a class="post__name" href="<?php echo $baseUrl ?>/thread.php?id=<?php echo $post['id']; ?>&page=1">
        <?php echo $postName; ?>
    </a>
<?php } ?>