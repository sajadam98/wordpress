<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package oStore
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="page-title">
<div class="page-title">
	<h1 class="recent-single-heading"><?php the_title(); ?></h1>
</div> 
<div class="entry-detail">
	<?php if(has_post_thumbnail()): ?>
      <div class="entry-photo">
        <figure><?php the_post_thumbnail(); ?></figure>
      </div>
    <?php endif; ?>
		<div class="content-text slingle-blog-content clearfix">
		<?php the_content(); ?>
		</div>
		<div class="entry-tags"> <span></span> <?php the_tags( 'Tags: ', ', ', '<br />' ); ?></div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ostore' ),
				'after'  => '</div>',
			) );
		?>
</div>
</div>