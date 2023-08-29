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



	//get_template_part( 'template-parts/content/content-page' );
?>



<div class="grid-container">
    <?php
$counts=2;
$count=1;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'meta_query' => array(
        array(
            'key' => 'custom_checkbox',
            'value' => 'on',
        ),
        
    ),
);
$checked_posts = new WP_Query($args);
while ($checked_posts->have_posts()) {
        //all details;
        $checked_posts->the_post();
        $post_title = $checked_posts->post_title;
        $post_url_img = get_the_post_thumbnail_url($checked_posts->ID);
        //$post_url= the_permalink($post->ID);
        $categories = get_the_category($checked_posts->ID);
        $category_url = get_category_link( $categories[0]->term_id );
        $category_title = $categories[0]->name;
        $post_content = $checked_posts->post_content;
?>

    <div class="item<?php echo $counts; $counts=$counts+1;?>" style="background-image: url('<?php echo $post_url_img; ?>');background-position: center;
            background-repeat: no-repeat; background-size: cover;position: relative; ">
        <?php if($counts!=6){?>
        

        <?php 
                
                ?>
        <div class="card-body">
           
                
                    <?php if($count==2){
								
								?>
                    <a id="btn_feature" href="<?php echo ( $category_url) ; ?>"
                        role="button"><?php  echo  $category_title; ?></a>
                    <?php
							}else{$count=$count+1;
                            ?>
                    <a id="btn_blue" href="<?php echo ( $category_url ); ?>"
                        role="button"><?php  echo  $category_title; ?></a>

                    <?php }?>

                

            
            <a href="<?php echo the_permalink(); ?>" class="list-group-item ">
                <p id="card-text"><?php echo the_title();?>
                </p>
            </a>
        </div>
        <?php }?>
    </div>


    <?php
   wp_reset_postdata();         
    }?>
</div>
<hr>
<div class="row">
    <h2>Egy News</h2>
</div>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php
    $args = array(
        'post_type' => 'Post',
        'post_status' => 'publish', 
        'posts_per_page' =>-1,
    );
	$news=1;
    $allposts = get_posts($args);
    foreach ($allposts as $fpost) {
		if(count($allposts)==$news){break;}

    ?>
        <div class="<?php if ($news == 1) : ?>
        <?php echo "carousel-item active" ?>
        <?php else : ?>
        <?php echo "carousel-item" ?>
        <?php endif; ?>">
            <div class="row">

                <?php
            $args2 = array(
                'post_type' => 'post',
                'posts_per_page' => 4,
                'offset' => $news,
              );
              $posts = get_posts($args2);
              
              foreach ($posts as $post) :
              ?>
                <div class="col-md-3 ms-1 carousel-item2" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>');background-position: center;
  background-repeat: no-repeat; background-size: cover;position: relative;">





                    <div id="card-text">
                        <a href="<?php echo the_permalink(); ?>" class="list-group-item ">
                            <p><?php echo the_title();?>
                        </a>
                    </div>

                </div>

                <?php  $news++; endforeach; ?>
            </div>
        </div>

        <?php }?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <?php 
        $image_url = get_template_directory_uri() . '\assets\images\prev.svg';
        echo '<img id="arow" src="' . $image_url . '">';
        ?>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <?php 
        $image_url = get_template_directory_uri() . '\assets\images\next.svg';
        echo '<img id="arow" src="' . $image_url . '">';
        ?>
        
    </button>
</div>


<div class="row ms-1">
    <div class="col-md-8">

        <hr>
        <h2>Features</h2>

        <div class="row row-cols-sm-2">
            <?php
		$args = array(
        'post_type' => 'Post',
		'category_name' => 'features',
        'post_status' => 'publish', 
        'posts_per_page' =>2,
    );
    $blogpost = new WP_Query($args);
    while($blogpost -> have_posts()){
        $blogpost -> the_post();
		$categories = get_the_category(get_the_ID());
        $category_url = get_category_link( $categories[0]->term_id );
        $category_title = $categories[0]->name;

    ?>
            <div class="col" id="col_feature"style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>');">
                
                    

                    <div id="card-text">
                        
                            <div class="btn-group">
                                <a id="btn_feature" href="<?php echo $category_url; ?>"
                                    role="button"><?php echo $category_title; ?></a>
                            </div>
                            <a href="<?php echo the_permalink(); ?>" class="list-group-item ">
                                <p ><?php echo the_title();?></p>

                            </a>
                        
                    </div>
                
            </div>
            <?php 
		}
		
		wp_reset_query();
		?>


        </div>
    </div>
    <div class="col-md-4">

        <hr>
        <h2>top stories</h2>

        <div class="list-group list-group-flush border-bottom border-top border-start ">
            <?php
		$args = array(
        'post_type' => 'Post',    
       'meta_key' => 'post_views_count',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'posts_per_page' => 5,
    );
	$counts=1;
    $blogpost = new WP_Query($args);
    while($blogpost -> have_posts()){
        $blogpost -> the_post();
		

    ?>
            <a href="<?php echo the_permalink(); ?>" class="list-group-item list-group-item-action  py-3 lh-sm">
                <div class="d-flex w-100 align-items-center ">
                    <small><?php echo $counts ; $counts=$counts+1;?></small>
                    <strong class="mb-1"><?php the_title(); ?></strong>

                </div>

            </a>
            <?php 
		}
		
		wp_reset_query();
		?>


        </div>
    </div>
</div>




<?php

        
  
    


get_footer();