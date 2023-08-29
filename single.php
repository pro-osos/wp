<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage os_theme
 * @since Os Theme 1.0
 */

get_header();
$post_id = get_the_ID();
echo getPostViews($post_id);
setPostViews($post_id);
/* Start the Loop */
while ( have_posts() ) :
	the_post();
	//setPostViews($post->ID);
?>
	<h2 class="page-heading"><?php the_title(); ?></h2>
        <div id="post-container">
          <section id="blogpost">
            <div class="card">
              <div class="card-meta-blogpost">
              posted by <?php the_author(); ?> On <?php the_time('F j, Y') ?>
              <?php if(get_post_type()=='post') {?>
                In <a href="#"> <?php echo get_the_category_list(',')?></a>
              <div class="card-image">
              <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="Card Image">
              </div>
              <?php }?>
              <?php if(get_post_type()=='Stories') {?>
              In <?php echo get_the_term_list( $post->ID, 'Stories_category', '', ',', '' );
                ?>


              <?php }?>
              



              </div>
              
              <div class="card-description">

              <h3>
              <?php the_content(); ?></h3>
              </div>
            </div>
			</section>
		</div>


<?php
	if ( is_attachment() ) {
		// Parent post navigation.
		the_post_navigation(
			array(
				/* translators: %s: Parent post link. */
				'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'ostheme' ), '%title' ),
			)
		);
	}

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

	
	$ostheme_next_label     = esc_html__( 'Next post', 'os_theme' );
	$ostheme_previous_label = esc_html__( 'Previous post', 'os_theme' );

	the_post_navigation(
		array(
			'next_text' => '<p class="meta-nav">' . $ostheme_next_label . '</p><p class="post-title">%title</p>',
			'prev_text' => '<p class="meta-nav">'  . $ostheme_previous_label . '</p><p class="post-title">%title</p>',
		)
	);
endwhile; // End of the loop.

get_footer();
