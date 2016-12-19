<?php get_header(); ?>

<main class="site-content">

  <div class="container">
      <div class="row">
          <div class="col-xs-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
              <?php
              if ( have_posts() ) :

                  /* Start the Loop */
                  while ( have_posts() ) : the_post();

                      /*
                       * Include the Post-Format-specific template for the content.
                       * If you want to override this in a child theme, then include a file
                       * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                       */
                      get_template_part( 'template-parts/post/content', get_post_format() );

                  endwhile;

                  the_posts_pagination( array(
                      'mid_size' => 3,
                      'prev_text' => '<span><i class="fa fa-angle-left"></i>' . __( 'Anterior', 'dmem' ) . '</span>',
                      'next_text' => '<span>' . __( 'Siguiente', 'dmem' ) . '<i class="fa fa-angle-right"></i></span>'
                  ) );

              else :

                  get_template_part( 'template-parts/post/content', 'none' );

              endif;
              ?>
          </div>
      </div>
  </div>

</main>

<?php get_footer();
