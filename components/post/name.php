<?php if (!empty($postName)) { ?>
    <a class="post__name" href="<?php echo $baseUrl ?>/thread.php?id=<?php echo $post['id']; ?>">
        <?php echo $postName; ?>
    </a>
<?php } ?>