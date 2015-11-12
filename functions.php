<?php

new Fervor();

class Fervor {
    private $version;

    function __construct() {
        $theme = wp_get_theme();
        $this->version = $theme->Version;

        add_theme_support( 'menus' );
        add_theme_support( 'post-thumbnails' );

        add_action( 'init',                         array( $this, 'action_register_nav_menus' ) );
        add_action( 'init',                         array( $this, 'action_acf_add_options_page' ) );
        add_action( 'wp_enqueue_scripts',           array( $this, 'action_enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts',           array( $this, 'action_enqueue_styles' ) );

        add_filter( 'the_permalink',                array( $this, 'filter_the_permalink' ) );
        add_filter( 'body_class',                   array( $this, 'filter_body_class' ) );
        add_filter( 'primary_nav_menu_args',        array( $this, 'filter_primary_nav_menu_args' ) );
        add_filter( 'secondary_nav_menu_args',      array( $this, 'filter_secondary_nav_menu_args' ) );
    }

    function action_register_nav_menus() {
        register_nav_menus(
            array(
                'header' => 'Primary Navigation in Header',
                'footer' => 'Secondary Navigation in Footer',
            )
        );
    }

    function action_acf_add_options_page() {
        if ( function_exists( 'acf_add_options_page' ) ) {
            acf_add_options_page();
        }
    }

    function action_enqueue_scripts() {
        // Header
        wp_enqueue_script( 'head', get_stylesheet_directory_uri() . '/static/js/build/head.min.js', false, $this->version );

        // Footer
        wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/static/js/build/main.min.js', array( 'jquery' ), $this->version, true );

        $data = array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'template_directory_url' => get_stylesheet_directory_uri(),
        );

        wp_localize_script( 'main', 'Fervor', $data );
    }

    function action_enqueue_styles() {
        wp_enqueue_style( 'fonts', 'http://fonts.googleapis.com/css?family=Merriweather:300,400,700,300italic,400italic,700italic', false, $this->version );
        wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/static/css/main.css', false, $this->version );
    }

    function filter_the_permalink( $url ) {
        $permalink = get_field( 'permalink' );

        return $permalink ? $permalink : $url;
    }

    function filter_body_class( $classes ) {
        global $post;

        if ( isset( $post ) && is_singular() ) {
            $classes[] = $post->post_type . '-' . $post->post_name;
        }

        return $classes;
    }

    function filter_primary_nav_menu_args( $args ) {
        $args = wp_parse_args( $args, array(
            'theme_location'    => 'header',
            'container'         => false,
        ) );

        return $args;
    }

    function filter_secondary_nav_menu_args( $args ) {
        $args = wp_parse_args( $args, array(
            'theme_location'    => 'footer',
            'container'         => false,
        ) );

        return $args;
    }
}
