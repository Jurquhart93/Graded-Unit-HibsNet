<!-- PHP To Retrieve The Categories and SubCategories Start -->
<?php
$categories = GetCategories($conn);
?>
<!-- PHP To Retrieve The Categories and SubCategories End -->

<!-- Category Start -->
<?php foreach ($categories as $category) { ?>

    <?php

    $subCategories = GetSubcategories($conn, $category['id'])

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
            <div class="category__options">
                <!-- Category Option Start -->
                <div class="category__option">
                    <i class="ri-corner-down-right-line"></i>
                    <a href="<?php echo $baseUrl ?>/subcategory.php?subcategory_id=<?php echo $subCategory['id']; ?>"><?php echo $subCategory['subcategory_name']; ?></a>
                </div>
                <!-- Category Option End -->
            </div>
        <?php } ?>
        <!-- Category Options End -->
    </div>
<?php } ?>
<!-- Category End -->