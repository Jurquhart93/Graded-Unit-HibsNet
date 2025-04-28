<!-- PHP To Retrieve The Categories and SubCategories Start -->
<?php
$categories = PreparedSelectStmt($conn, "SELECT * FROM gu_categories");
?>
<!-- PHP To Retrieve The Categories and SubCategories End -->

<!-- Category Start -->
<?php foreach ($categories as $category) { ?>

    <?php

    $subCategories = PreparedSelectStmt($conn, "SELECT * FROM gu_subcategories WHERE category_id = ?", "i", [$category['id']]);

    ?>

    <div class="category">
        <!-- Category Header Start -->
        <div class="category__header">
            <i class="ri-football-line"></i>
            <span><?php echo $category['category_name']; ?></span>
        </div>
        <!-- Category Header End -->

        <!-- Category Options Start -->
        <?php foreach ($subCategories as $subCategory) { ?>
            <?php if ($subCategory['private']) { ?>
                <?php if (isset($member['admin']) || isset($member['moderator']) || isset($member['private_member'])) { ?>
                    <div class="category__options">
                        <!-- Category Option Start -->
                        <div class="category__option">
                            <i class="ri-corner-down-right-line"></i>
                            <div>
                                <a href="<?php echo $baseUrl ?>/subcategory.php?subcategory_id=<?php echo $subCategory['id']; ?>"><?php echo $subCategory['subcategory_name']; ?></a>
                                <strong>PRIVATE</strong>
                            </div>
                        </div>
                        <!-- Category Option End -->
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="category__options">
                    <!-- Category Option Start -->
                    <div class="category__option">
                        <i class="ri-corner-down-right-line"></i>
                        <a href="<?php echo $baseUrl ?>/subcategory.php?subcategory_id=<?php echo $subCategory['id']; ?>"><?php echo $subCategory['subcategory_name']; ?></a>
                    </div>
                    <!-- Category Option End -->
                </div>
            <?php } ?>
        <?php } ?>
        <!-- Category Options End -->
    </div>
<?php } ?>
<!-- Category End -->