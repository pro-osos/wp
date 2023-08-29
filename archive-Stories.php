
<?php get_header();?>

        <h2 class="page-heading">All Storiess</h2>
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
                posted by <?php the_author(); ?> On <?php the_time('Y/m/d g:i:s A ') ?>


                  <?php if(get_post_type()=='Stories') {?>
                  In <?php echo get_the_term_list( $post->ID, 'Stories_category', '', ',', '' );
                    ?>

                    <?php }?>
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

</body>

<?php get_footer();?>
