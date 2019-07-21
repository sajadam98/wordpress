<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package oStore
 */
get_header(); ?>
<!-- Main Container -->
<!-- Main Container -->
<section class="blog_post bounceInUp animated"><!-- Edted file -->
	<div class="container"> 	
		<!-- row -->
		<div class="row">
		<!-- Center colunm-->
		<div class="center_column col-xs-12 col-sm-12 col-md-9" id="center_column">
			<div class="page-title">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</div>
			<?php
			if ( have_posts() ) : ?>
			
				<ul class="blog-posts">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
				<?php endwhile; ?>
				
				</ul>
				<div class="">
				<?php the_posts_pagination( array(
						'mid_size' => 2,
						'prev_text' => __( '<', 'ostore' ),
						'next_text' => __( '>', 'ostore' ),
					) ); ?>
				</div>
			<?php else: ?>
				<?php get_template_part( 'template-parts/content','none'); ?>
			<?php endif; ?>
		</div>
			<?php get_sidebar(); ?>	
		</div>
		<!-- ./row--> 
	</div>
	</section>
	<!-- Main Container End -->		
<?php
get_footer(); 