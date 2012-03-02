<?php
add_action( 'after_setup_theme', 'blm_theme_setup' );
function blm_theme_setup() {

	global $content_width;
	/* Set the $content_width for things such as video embeds. */
	if ( !isset( $content_width ) )
	$content_width = 640;

	/* Add theme support for automatic feed links. */
	add_theme_support( 'automatic-feed-links' );

	/* Add theme support for post thumbnails (featured images). */
	add_theme_support( 'post-thumbnails');
}

/* Add your nav menus function to the 'init' action hook. */
add_action( 'init', 'blm_register_menus' );

/* Add custom actions. */
add_action( 'widgets_init', 'blm_register_sidebars' );

// Add menu features 
function blm_register_menus() {
	register_nav_menus(array('primary'=>__('Primary Menu'),));
}

function blm_register_sidebars() {
	register_sidebar(
		array(
			'id' => 'primary',
			'name' => __( 'Primary Sidebar', 'blm_basic' ),
			'description' => __( 'The following widgets will appear in the main sidebar div.', 'blm_basic' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
		)
	);
}

function blm_init_method() {

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'slides', get_template_directory_uri().'/js/slides.min.jquery.js', array( 'jquery' ) );
	
	}
add_action('wp_enqueue_scripts', 'blm_init_method');

// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);	


// Custom Post types for Feature project on home page 
	   add_action('init', 'create_feature');
	     function create_feature() {
	       $feature_args = array(
	          'labels' => array(
	           'name' => __( 'Feature Project' ),
	           'singular_name' => __( 'Feature Project' ),
	           'add_new' => __( 'Add New Feature Project' ),
	           'add_new_item' => __( 'Add New Feature Project' ),
	           'edit_item' => __( 'Edit Feature Project' ),
	           'new_item' => __( 'Add New Feature Project' ),
	           'view_item' => __( 'View Feature Project' ),
	           'search_items' => __( 'Search Feature Project' ),
	           'not_found' => __( 'No feature project found' ),
	           'not_found_in_trash' => __( 'No feature project found in trash' )
	         ),
	       'public' => true,
	       'show_ui' => true,
	       'capability_type' => 'post',
	       'hierarchical' => false,
	       'rewrite' => true,
	       'menu_position' => 20,
	       'supports' => array('title', 'editor', 'thumbnail')
	     );
	  register_post_type('feature',$feature_args);
	}
	add_filter("manage_feature_edit_columns", "feature_edit_columns");

	function feature_edit_columns($feature_columns){
	   $feature_columns = array(
	      "cb" => "<input type=\"checkbox\" />",
	      "title" => "Title",
	   );
	  return $feature_columns;
	}
	
	
	//Add Meta Boxes
	//http://wp.tutsplus.com/tutorials/plugins/how-to-create-custom-wordpress-writemeta-boxes/

	add_action( 'add_meta_boxes', 'cd_meta_box_add' );
	function cd_meta_box_add()
	{
		add_meta_box( 'my-meta-box-id', 'Link to Project', 'cd_meta_box_cb', 'feature', 'normal', 'high' );
	}

	function cd_meta_box_cb( $post )
	{
		$url = get_post_meta($post->ID, 'url', true);
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' ); ?>

		<p>
			<label for="url">Project url</label>
			<input type="text" name="url" id="url" value="<?php echo $url; ?>" style="width:350px" />
		</p>

		<?php	
	}
	
	add_action( 'save_post', 'cd_meta_box_save' );
	function cd_meta_box_save( $post_id )
	{
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post' ) ) return;

		// now we can actually save the data
		$allowed = array( 
			'a' => array( // on allow a tags
				'href' => array() // and those anchors can only have href attribute
			)
		);

		// Probably a good idea to make sure your data is set
		if( isset( $_POST['url'] ) )
			update_post_meta( $post_id, 'url', wp_kses( $_POST['url'], $allowed ) );
	}
?>