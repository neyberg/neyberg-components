<?php
    /**
     * Plugin Name: Neyberg components
     * Plugin URI: neyberg.com
     * Description: Collection of reusable content templates that gives opportunity easily expand pages, cover more information, enhance its functionality.
     * Version:  1.0
     * Author: Neyberg
     * Author URI: neyberg.com
     * License:  GPL2
     */

// Custom post type function
    function rod_components() {

        register_post_type( 'accordion',
            // CPT Options
            array(
                'labels' => array(
                    'name' => esc_html( 'Accordions' ),
                    'singular_name' => esc_html( 'Accordion' ),
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array( 'rodacordions' => 'acordionsitems' ),
                'menu_position' => 5,
                'supports' => array(),
                'show_ui' => true,
                'show_in_menu' => 'componentpage',
                'publicly_queryable' => false,
                'supports' => array( 'title' ),
                'show_in_nav_menus' => false,
            )
        );

        register_post_type( 'imagegrid',
            // CPT Options
            array(
                'labels' => array(
                    'name' => esc_html( 'Image grids' ),
                    'singular_name' => esc_html( 'Image grid' ),
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array( 'rodimagegrids' => 'imagegridsitems' ),
                'menu_position' => 5,
                'supports' => array(),
                'show_ui' => true,
                'show_in_menu' => 'componentpage',
                'publicly_queryable' => false,
                'supports' => array( 'title' ),
                'show_in_nav_menus' => false,
            )
        );

        register_post_type( 'sequence',
            // CPT Options
            array(
                'labels' => array(
                    'name' => esc_html( 'Sequences' ),
                    'singular_name' => esc_html( 'Sequence' ),
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array( 'rodsequences' => 'sequencesitems' ),
                'menu_position' => 5,
                'supports' => array(),
                'show_ui' => true,
                'show_in_menu' => 'componentpage',
                'publicly_queryable' => false,
                'supports' => array( 'title' ),
                'show_in_nav_menus' => false,
            )
        );

        register_post_type( 'tab',
            // CPT Options
            array(
                'labels' => array(
                    'name' => esc_html( 'Tabs' ),
                    'singular_name' => esc_html( 'Tab' ),
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array( 'rodtabs' => 'tabsitems' ),
                'menu_position' => 5,
                'supports' => array(),
                'show_ui' => true,
                'show_in_menu' => 'componentpage',
                'publicly_queryable' => false,
                'supports' => array( 'title' ),
                'show_in_nav_menus' => false,
            )
        );
    }

// Hooking up our function to theme setup
    add_action( 'init', 'rod_components', 20 );

// include metabox for this custom post type
    include( plugin_dir_path( __FILE__ ) . 'init-components-metabox.php' );

// Shotcode for components

    include( plugin_dir_path( __FILE__ ) . 'shortcode_accordion.php' );
    include( plugin_dir_path( __FILE__ ) . 'shortcode_imagegrid.php' );
    include( plugin_dir_path( __FILE__ ) . 'shortcode_sequence.php' );
    include( plugin_dir_path( __FILE__ ) . 'shortcode_tab.php' );

// Customize column settings

    function true_id( $args )
    {
        $args['post_page_id'] = 'Shortcode';
        return $args;
    }

    function true_custom( $column, $id ) {
        if ( $column === 'post_page_id' ) { ?>
            <input type="text" onfocus="this.select();" readonly="readonly"
                   value="<?php echo '[' . get_post_type( $id ) . ' id=\'' . $id . '\']' ?>">
        <?php }
    }

    if ( ! function_exists( 'custom_manage_posts_column' ) ) {
        function custom_manage_posts_column( $columns ) {
            unset( $columns['date'] );
            return $columns;
        }
    }

    add_filter( 'manage_accordion_posts_columns', 'true_id', 5 );
    add_filter( 'manage_accordion_posts_columns', 'custom_manage_posts_column', 5 );
    add_action( 'manage_accordion_posts_custom_column', 'true_custom', 5, 2 );
    add_filter( 'manage_imagegrid_posts_columns', 'true_id', 5 );
    add_filter( 'manage_imagegrid_posts_columns', 'custom_manage_posts_column', 5 );
    add_action( 'manage_imagegrid_posts_custom_column', 'true_custom', 5, 2 );
    add_filter( 'manage_sequence_posts_columns', 'true_id', 5 );
    add_filter( 'manage_sequence_posts_columns', 'custom_manage_posts_column', 5 );
    add_action( 'manage_sequence_posts_custom_column', 'true_custom', 5, 2 );
    add_filter( 'manage_tab_posts_columns', 'true_id', 5 );
    add_filter( 'manage_tab_posts_columns', 'custom_manage_posts_column', 5 );
    add_action( 'manage_tab_posts_custom_column', 'true_custom', 5, 2 );

// Main components page

    add_action( 'admin_menu', 'components_menu_page', 1 );
    function components_menu_page()
    {
        add_menu_page(
            'Components', 'Components', 'manage_options', 'componentpage', 'component_page_menu', 'dashicons-paperclip', 6
        );
    }

    function component_page_menu()
    {
        include( plugin_dir_path( __FILE__ ) . 'component_main.php' );
    }
