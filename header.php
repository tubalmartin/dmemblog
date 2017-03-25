<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="site-header">

        <div class="site-name-wrapper">
          <span class="icons">
            <i class="fa fa-bars" id="primary-menu-opener"></i>
            <i class="fa fa-close" id="primary-menu-closer"></i>
          </span>
          <span class="site-name">De menú en menú</span>
          <span class="site-name-legend">Gastro &bull; Travel</span>
          <span class="site-author">por <a href="<?php echo esc_url( get_permalink(7051) ) ?>">Cristina R. Bareño</a></span>
          <span class="social-icons">
              <a href="https://www.instagram.com/demenuenmenu/">
                  <i class="fa fa-instagram"></i>
              </a>
              <a href="https://twitter.com/demenuenmenu?lang=es">
                  <i class="fa fa-twitter"></i>
              </a>
          </span>
        </div>

        <?php if (has_nav_menu('primary')): ?>
            <?php wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => 'nav',
                'container_id' => 'primary-menu-wrapper',
                'container_class' => 'primary-menu-wrapper',
                'menu_class' => 'primary-menu',
                'before' => '<span class="item-link">',
                'after' => '</span>'
            )); ?>
        <?php endif; ?>

    </header>

