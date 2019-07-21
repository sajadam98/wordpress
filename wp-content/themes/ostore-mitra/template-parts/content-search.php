<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package oStore
 */
?>
<li class="post-item wow fadeInUp">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="entry">
	<div class="row">
	<?php if(has_post_thumbnail()): ?>
		<div class="col-sm-4">
			<div class="entry-thumb image-hover2"> <a href="<?php the_permalink(); ?>">
			<figure><?php the_post_thumbnail(); ?></figure>
			</a> </div>
		</div>	
	<?php endif; ?>
	<?php if(has_post_thumbnail()): ?>
		<div class="col-md-8 ">
	<?php else: ?>
		<div class="col-md-12 ">
	<?php endif; ?>
	<?php 	the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		<div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; by: <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php echo esc_html(get_the_author()); ?></a></span> <span class="cat">  <span class="comment-count"> <a href=""><i class="fa fa-comment"></i>&nbsp;<?php printf( esc_html( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'ostore' ), esc_html(number_format_i18n( get_comments_number() ) ));	 ?></span></a> <span class="date"><i class="fa fa-calendar"></i>&nbsp; <?php the_date(get_option('date_format')); ?></span> </div>
		<div class="entry-excerpt"><?php the_excerpt(); ?></div>
		<div class="entry-more"> <a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e('Continus reading','ostore'); ?> &nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
		</div>
	</div>
	</article>
</li>