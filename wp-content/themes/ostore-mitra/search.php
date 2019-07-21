<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package oStore
 */
get_header(); ?>	
<!-- Main Container -->
<section class="blog_post bounceInUp animated">
	<div class="container"> 	
		<!-- row -->
		<div class="row">
		<!-- Center colunm-->
		<div class="center_column col-xs-12 col-sm-12 col-md-9" id="center_column">
		<header class="page-header">
			<h2 class="page-title">
			<?php printf( esc_html__( 'Search Results for: %s', 'ostore' ), '<span>' . esc_html(get_search_query()) . '</span>' ); ?></h2>
		</header><!-- .page-header -->
			<?php
			if ( have_posts() ) : ?>
				<ul class="blog-posts">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'search' ); ?>
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