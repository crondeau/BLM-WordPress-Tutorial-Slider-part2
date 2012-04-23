<?php get_header(); ?>
<div id="main">
	<section id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
	<?php endwhile; endif; ?>
	</section>
</div>
<?php get_footer(); ?>