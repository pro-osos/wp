<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage os_theme
 * @since Os Theme 1.0
 */


  get_header();?>



 <main>
         <h2 class="page-heading">All Blog</h2>
 
     <section>
     <?php
    // all post
     while(have_posts()){
         the_post();
 
 
     ?>
         <div class="card">
             <div class="card-image">
                 <a href="<?php echo the_permalink(); ?>">
                     <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="Card Image">
                 </a>
             </div>
             <div class="card-description">
                 <a href="<?php  the_permalink(); ?>">
                     <h3><?php the_title(); ?></h3>
                 </a>
                 <div class="card-meta">
                 posted by <?php the_author(); ?> On <?php the_time('F j, Y') ?>
                 In <a href="#"> <?php echo get_the_category_list(',')?></a>
                 </div>
                 <p>
                      <?php echo wp_trim_words(get_the_excerpt(),30);?>
                  </p>
                 <a href="<?php  the_permalink(); ?>" class="btn-readmore">Read More</a>
             </div>
         </div>
 
        <?php }
              wp_reset_query();
         ?>
     </section>
     <div class="pagination">
     <?php echo paginate_links(); ?>
     </div>
 </main>
 </body>
 
 <?php get_footer();?>
 



