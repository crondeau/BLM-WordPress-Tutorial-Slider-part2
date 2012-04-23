<?php get_header(); ?>
<div id="main">
	<section id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post();
			$args = array(
			   'post_type' => 'attachment',
			   'numberposts' => -1,
			   'orderby'=> 'menu_order',
			   'order' => 'ASC',
			   'post_mime_type' => 'image',
			   'post_parent' => $post->ID
			  ); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
			
			<aside class="slides">
				<div id="slideshow">
					<div class="slides_container">
					<?php
				  	$attachments = get_posts( $args );
				     	if ( $attachments ) {
				        	foreach ( $attachments as $attachment ) {
								echo wp_get_attachment_image( $attachment->ID , 'full' );
				      		}
				   		}?>
					</div>
				</div>
			<nav class="post-navigation">
				<div class="nav-previous"><?php previous_post_link( '&laquo; %link' ); ?></div>
				<div class="nav-next"><?php next_post_link( '%link &raquo;' ); ?></div>
			</nav>
		</aside>			

	
	  <?php endwhile; endif; ?>
	</section>
</div><!-- end of main div -->
<?php get_footer(); ?>