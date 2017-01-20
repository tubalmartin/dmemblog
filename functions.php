<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dmem_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/dmem
     * If you're building a theme based on Twenty Seventeen, use a find and replace
     * to change 'dmem' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'dmem' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    //add_image_size( 'dmem-featured-image', 2000, 1200, true );

    //add_image_size( 'dmem-thumbnail-avatar', 100, 100, true );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
        'primary'    => __( 'Primary Menu', 'dmem' ),
        'social' => __( 'Social Links Menu', 'dmem' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    /*add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ) );*/

    // Add theme support for Custom Logo.
    /*add_theme_support( 'custom-logo', array(
        'width'       => 250,
        'height'      => 250,
        'flex-width'  => true,
    ) );*/

    // Add theme support for selective refresh for widgets.
    //add_theme_support( 'customize-selective-refresh-widgets' );

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, and column width.
      */
    //add_editor_style( array( 'assets/css/editor-style.css', dmem_fonts_url() ) );

}
add_action( 'after_setup_theme', 'dmem_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dmem_content_width() {

    $content_width = 700;

    if ( dmem_is_frontpage() ) {
        $content_width = 1120;
    }

    /**
     * Filter Twenty Seventeen content width of the theme.
     *
     * @since Twenty Seventeen 1.0
     *
     * @param $content_width integer
     */
    $GLOBALS['content_width'] = apply_filters( 'dmem_content_width', $content_width );
}
//add_action( 'after_setup_theme', 'dmem_content_width', 0 );

/**
 * Register custom fonts.
 */
function dmem_fonts_url() {
    $fonts_url = '';

    $font_families = array();

    $font_families[] = 'Homemade Apple';
    $font_families[] = 'EB Garamond';
    $font_families[] = 'Open Sans:400,400i,700,700i';

    $query_args = array(
        'family' => urlencode( implode( '|', $font_families ) ),
        'subset' => urlencode( 'latin,latin-ext' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function dmem_resource_hints( $urls, $relation_type ) {
    if ( wp_style_is( 'dmem-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
//add_filter( 'wp_resource_hints', 'dmem_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dmem_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'dmem' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'dmem' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 1', 'dmem' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Add widgets here to appear in your footer.', 'dmem' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 2', 'dmem' ),
        'id'            => 'sidebar-3',
        'description'   => __( 'Add widgets here to appear in your footer.', 'dmem' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
//add_action( 'widgets_init', 'dmem_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function dmem_excerpt_more( $link ) {
    $link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
        esc_url( get_permalink( get_the_ID() ) ),
        /* translators: %s: Name of current post */
        __( 'Continuar leyendo', 'dmem' )
    );
    return $link;
}
//add_filter( 'excerpt_more', 'dmem_excerpt_more' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function dmem_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
    }
}
add_action( 'wp_head', 'dmem_pingback_header' );

/**
 * Remove the migrate script from the list of jQuery dependencies.
 * @see: https://github.com/cedaro/dequeue-jquery-migrate/blob/develop/dequeue-jquery-migrate.php
 */
function dequeue_jquery_migrate( $scripts){
    if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
        $jquery_dependencies = $scripts->registered['jquery']->deps;
        $scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
    }
}
add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );

/**
 * Revv asset URI for cache busting
 */
function get_my_revved_asset_uri ( $filename, $fileext ) {
    $dot = '.';
    $lastModified = filemtime(get_template_directory() . '/'. $filename . $dot . $fileext);
    return get_template_directory_uri() . '/'. $filename . $dot . $lastModified  . $dot . $fileext;
}

/**
 * Enqueue scripts and styles.
 */
function dmem_scripts() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'dmem-fonts', dmem_fonts_url(), array(), null );

    // Theme stylesheet.
    wp_enqueue_style( 'dmem-style', get_my_revved_asset_uri('style', 'css'), array(), null );

    // Load the html5 shiv.
    //wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
    //wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    //wp_enqueue_script( 'dmem-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

    /*if ( has_nav_menu( 'top' ) ) {
        wp_enqueue_script( 'dmem-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), '1.0', true );
        $dmem_l10n['expand']         = __( 'Expand child menu', 'dmem' );
        $dmem_l10n['collapse']       = __( 'Collapse child menu', 'dmem' );
        $dmem_l10n['icon']           = dmem_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
    }*/

    wp_enqueue_script( 'dmem-js', get_my_revved_asset_uri('scripts', 'js'), array( 'jquery' ), null, true );

    //wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

    //wp_localize_script( 'dmem-skip-link-focus-fix', 'dmemScreenReaderText', $dmem_l10n );

    /*if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }*/
}
add_action( 'wp_enqueue_scripts', 'dmem_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function dmem_content_image_sizes_attr( $sizes, $size ) {
    $width = $size[0];

    if ( 740 <= $width ) {
        $sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
    }

    if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
        if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
            $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
        }
    }

    return $sizes;
}
//add_filter( 'wp_calculate_image_sizes', 'dmem_content_image_sizes_attr', 10, 2 );


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function dmem_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
    if ( is_archive() || is_search() || is_home() ) {
        $attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
    } else {
        $attr['sizes'] = '100vw';
    }

    return $attr;
}
//add_filter( 'wp_get_attachment_image_attributes', 'dmem_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function dmem_front_page_template( $template ) {
    return is_home() ? '' : $template;
}
//add_filter( 'frontpage_template',  'dmem_front_page_template' );

/**
 * Add sub-menu toggler icons if menu item has children.
 */
function dmem_dropdown_icon_to_menu_link( $item_output, $item, $depth, $args ) {
    if ( 'primary' === $args->theme_location ) {
        foreach ( $item->classes as $value ) {
            if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
                $item_output .= '<span class="sub-menu-toggler"><i class="fa fa-angle-up"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-down"></i></span>';
            }
        }
    }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'dmem_dropdown_icon_to_menu_link', 10, 4 );

/**
 * Limit number of post revisions
 */
function dmem_limit_revisions_to_keep( $num, $post ) {
    return 10;
}
add_filter( 'wp_revisions_to_keep', 'dmem_limit_revisions_to_keep', 10, 2 );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Remove image srcset: fastest method!
 */
function remove_image_srcset() {
    return [];
}
add_filter( 'wp_calculate_image_srcset_meta', 'remove_image_srcset' );

/*
 * Remove Generator meta
 */
add_filter( 'the_generator', '__return_null' );


