<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article <?php post_class(); ?>>

	<header class="entry-header">
		<?php
			if ( 'post' === get_post_type() ):
				echo '<div class="entry-meta">';
					if ( is_single() ) :
						dmem_posted_on();
					else:
						echo dmem_time_link();
					endif;
					if (has_category('patrocinados')):
            echo '<span class="sponsored">Patrocinado</span>';
          endif;
				echo '</div><!-- .entry-meta -->';
			endif;

			if ( is_single() || 'page' === get_post_type() ):
				the_title( '<h1 class="entry-title">', '</h1>' );
			else:
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->



	<div class="entry-content">
		<?php
      if ('page' === get_post_type()):
        the_content();
      else:
        if ( is_single() ):
          the_content();
          wp_link_pages( array(
            'before'      => '<div class="page-links">' . __( 'Pages:', 'dmem' ),
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
          ) );
        else:
            if (has_post_thumbnail()):
              the_post_thumbnail();
            endif;
            the_excerpt();
        endif;
      endif;
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
