         <?php $createdAt = CreatedAt($post['created_at']); ?>

         <!-- Post Container Start -->
         <section class="post__container">

             <div class="post__wrapper">
                 <!-- Post Name Start -->
                 <?php if (!empty($postName)) { ?>
                     <a href="<?php echo $baseUrl ?>/thread.php?id=<?php echo $post['id']; ?>">
                         <span class="post__name"><?php echo $postName; ?></span>
                     </a>
                 <?php } ?>
                 <!-- Post Name End -->

                 <!-- Author Start -->
                 <p class="author">
                     Created by: <a href="#"><?php echo $post['username']; ?></a>
                     <span>&sdot; <?php echo $createdAt; ?></span>
                 </p>
                 <!-- Author End -->
             </div>

             <!-- Clickable Post Start -->
             <a class="post__clickable" href="<?php echo $baseUrl ?>/thread.php?id=<?php echo $post['id']; ?>">

                 <!-- Post Text Start -->
                 <div>
                     <p class="text">
                         <?php echo $post['post_content']; ?>
                     </p>
                 </div>
                 <!-- Post Text End -->

                 <!-- Post Footer Start -->
                 <div class="post__footer">
                     <div>
                         <i class="ri-chat-4-line"></i> <span>433</span>
                     </div>
                     <div>
                         <i class="ri-group-line"></i> <span>12</span>
                     </div>
                 </div>
                 <!-- Post Footer End -->
             </a>
             <!-- Clickable Post End -->
         </section>
         <!-- Post Container End -->