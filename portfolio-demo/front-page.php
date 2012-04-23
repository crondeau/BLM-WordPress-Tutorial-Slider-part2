<?php get_header(); ?>
<section id="featured-slider">
	<div id="slides">
		<div class="slides_container">
			
			<?php 
				$loop = new WP_Query( array( 'post_type' => 'feature', 'posts_per_page' => -1, 'orderby'=> 'ASC' ) ); 
			?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

				<div class="slide">
					<?php $url = get_post_meta($post->ID, "url", true);/*If the custom field has a link, add a link to image */
					if($url!='') { 
						echo '<a href="'.$url.'">';
						echo the_post_thumbnail('full');
						echo '</a>';
					} else { /* If the custom field is empty, just display the image */
						echo the_post_thumbnail('full');
					} ?>
					<div class="caption">
						<h5><?php the_title(); ?></h5>	
						<?php the_content(); ?>
					</div>
				</div>

			<?php endwhile; ?>		
			<?php wp_reset_query(); ?>

		</div>
		<a href="#" class="prev">prev</a>
		<a href="#" class="next">next</a>
	</div>
</section>
<div id="main">
	<section id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<?php the_content(); ?>
		</article>
		<?php endwhile; endif; ?>
	</section>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>