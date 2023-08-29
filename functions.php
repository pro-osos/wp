<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage os_theme
 * @since Os Theme 1.0
 */



if ( ! function_exists( 'os_theme_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Os Theme 1.0
	 *
	 * @return void
	 */
	function os_theme_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'ostheme' ),
				'footer'  => esc_html__( 'Secondary menu', 'ostheme' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
			
		);
		

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		
		

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'ostheme' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'ostheme' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'ostheme' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'ostheme' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'ostheme' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'ostheme' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'ostheme' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'ostheme' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'ostheme' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'ostheme' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'ostheme' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'ostheme' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'ostheme' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'ostheme' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		

		

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for link color control.
		add_theme_support( 'link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );

		// Remove feed icon link from legacy RSS widget.
		add_filter( 'rss_widget_feed_link', '__return_empty_string' );
	}
}
add_action( 'after_setup_theme', 'os_theme_setup' );

/**
 * Registers widget area.
 *
 * @since Os Theme 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function os_theme_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'ostheme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'ostheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'os_theme_widgets_init' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Os Theme 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function os_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'os_theme_content_width', 750 );
}
add_action( 'after_setup_theme', 'os_theme_content_width', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Os Theme 1.0
 *
 * @global bool       $is_IE
 * @global WP_Scripts $wp_scripts
 *
 * @return void
 */
function os_theme_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'os-theme-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'os-theme-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
		//wp_enqueue_style( 'os-theme-style', get_template_directory_uri() . '/assets/sass/style.css', array(), wp_get_theme()->get( 'Version' ) );
		wp_enqueue_style( 'bootstrap', '//unpkg.com/bootstrap@5.3.1/dist/css/bootstrap.min.css' );
	}
	wp_enqueue_script( 'bootstrap', '//unpkg.com/bootstrap@5.3.0/dist/js/bootstrap.min.js' );

	// RTL styles.
	wp_style_add_data( 'os-theme-style', 'rtl', 'replace' );

	// Print styles.
	wp_enqueue_style( 'os-theme-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'os-theme-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'os-theme-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_add_inline_script(
		'os-theme-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'os-theme-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'os-theme-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'os-theme-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'os-theme-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'os-theme-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'os_theme_scripts' );

/**
 * Enqueues block editor script.
 *
 * @since Os Theme 1.0
 *
 * @return void
 */
function ostheme_block_editor_script() {

	wp_enqueue_script( 'ostheme-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'ostheme_block_editor_script' );

/**
 * Fixes skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Os Theme 1.0
 * @deprecated Os Theme 1.9 Removed from wp_print_footer_scripts action.
 *
 * @link https://git.io/vWdr2
 */
function os_theme_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	} else {
		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
		</script>
		<?php
	}
}

/**
 * Enqueues non-latin language styles.
 *
 * @since Os Theme 1.0
 *
 * @return void
 */




// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';





/**
 * Enqueues scripts for the customizer preview.
 *
 * @since Os Theme 1.0
 *
 * @return void
 */
function ostheme_customize_preview_init() {
	wp_enqueue_script(
		'ostheme-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_script(
		'ostheme-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'ostheme-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'ostheme_customize_preview_init' );

/**
 * Enqueues scripts for the customizer.
 *
 * @since Os Theme 1.0
 *
 * @return void
 */
function ostheme_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'ostheme-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'ostheme_customize_controls_enqueue_scripts' );

/**
 * Calculates classes for the main <html> element.
 *
 * @since Os Theme 1.0
 *
 * @return void
 */
function ostheme_the_html_classes() {
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since Os Theme 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters( 'ostheme_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Adds "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Os Theme 1.0
 *
 * @return void
 */
function ostheme_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'ostheme_add_ie_class' );

if ( ! function_exists( 'wp_get_list_item_separator' ) ) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator() {
		/* translators: Used between list items, there is a space after the comma. */
		return __( ', ', 'ostheme' );
	}
endif;

function add_custom_ads_image_meta_box() {
    add_meta_box(
        'custom_ads_image_meta_box',
        'Ads Image',
        'render_custom_ads_image_meta_box',
        'page', // Change this to the desired post type if necessary
        'normal',
        'high'
    );
}

function add_custom_ad_image_meta_box() {
    add_meta_box(
        'custom_ad_image_meta_box',
        'Ad Image',
        'render_custom_ad_image_meta_box',
        'page', // Change this to the desired post type if necessary
        'normal',
        'high'
    );
}

function render_custom_ad_image_meta_box($post) {
    $custom_ad_image = get_post_meta($post->ID, 'custom_ad_image', true);
    wp_nonce_field(basename(__FILE__), 'custom_ad_image_nonce');
    ?>
    <p>
        <label for="custom_ad_image">Upload Ad Image:</label>
        <br>
        <input type="text" name="custom_ad_image" id="custom_ad_image" class="widefat" value="<?php echo esc_attr($custom_ad_image); ?>">
        <br>
        <input type="button" class="button button-secondary" value="Upload Image" id="custom_ad_image_button">
    </p>
    <script>
        jQuery(document).ready(function($) {
            $('#custom_ad_image_button').click(function() {
                var mediaUploader;
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Ad Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: false
                });
                mediaUploader.on('select', function() {
                    attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#custom_ad_image').val(attachment.url);
                });
                mediaUploader.open();
            });
        });
    </script>
    <?php
}

add_action('add_meta_boxes', 'add_custom_ad_image_meta_box');
function save_custom_ad_image_meta($post_id) {
    if (!isset($_POST['custom_ad_image_nonce']) || !wp_verify_nonce($_POST['custom_ad_image_nonce'], basename(__FILE__))) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['custom_ad_image'])) {
        $custom_ad_image = sanitize_text_field($_POST['custom_ad_image']);
        update_post_meta($post_id, 'custom_ad_image', $custom_ad_image);
    }
}

add_action('save_post', 'save_custom_ad_image_meta');

// Stories post type
function stories_post_type() {
    
    register_post_type( 'Stories', array(
        'rewrite'=> array('slug'=>'Stories'),
        'labels'=> array('name'=>'Stories',
        'singular_name'=> 'Storiess',
        'add_new_item'=> 'Add New Story',
        'edit_item'=> 'Edite Stories'),
        'menu_icon' => 'dashicons-clipboard',
        'public'=>true,
        'has_archive'=>true,
        'supports' => array(
            'title','thumbnail','editor','excerpt','comments'
            )
        ) 
    ); 
}
  add_action( 'init', 'stories_post_type' );

  require get_template_directory() . '/inc/setting-page.php';
  require get_template_directory() . '/inc/main_post.php';


// function to display number of posts.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// Add it to a column in WP-Admin
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Views');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}

  ?>