<?php

// Register a function to enqueue theme styles/scripts when WordPress is loading assets
function aruix_enqueue_assets() {
    // Enqueue the main stylesheet for the theme using a unique handle
    wp_enqueue_style(
        'aruix-style', // Unique handle for the stylesheet
        get_stylesheet_uri() // URL to the theme's style.css file
    );
}

// Attach aruix_enqueue_assets() to the 'wp_enqueue_scripts' action hook
// so it runs at the correct time during page load
add_action('wp_enqueue_scripts', 'aruix_enqueue_assets');

function aruix_theme_setup() {
    // Enable WordPress to manage the document title automatically via <title>
    add_theme_support('title-tag');

    // Enable featured image support for post and page thumbnails
    add_theme_support('post-thumbnails');

    // Enable HTML5 output for forms, comments, galleries, and captions
    add_theme_support('html5', array(
        'search-form',   // HTML5 markup to be used for search form
        'comment-form',  // HTML5 markup for comment form
        'comment-list',  // HTML5 markup for comment list
        'gallery',       // HTML5 markup for galleries
        'caption',       // HTML5 markup for captions
    ));
}

// Hook theme setup function to 'after_setup_theme'. Runs once after theme initialization.
add_action('after_setup_theme', 'aruix_theme_setup');

function aruix_register_menus() {
    // Register a named menu location for the theme.
    register_nav_menus(array(
        'primary' => 'Primary Menu', // key is location slug, value is human-readable label
    ));
}

// Hook menu registration function to 'after_setup_theme'. Ensures menus are available in admin.
add_action('after_setup_theme', 'aruix_register_menus');

function aruix_register_post_types() {
    // Register a custom post type called 'project' for portfolio items
    register_post_type('project', array(
        'labels' => array(
            'name' => 'Projects', // Plural name for admin menu
            'singular_name' => 'Project', // Singular name for single items
        ),
        'public' => true, // Make post type visible in admin and frontend
        'has_archive' => true, // Enable archive page for projects
        'menu_icon' => 'dashicons-portfolio', // Icon in admin menu
        'supports' => array('title', 'editor', 'thumbnail'), // Enabled features for posts
    ));

}

// Hook post type registration to 'init'. Runs after WordPress has finished loading.
add_action('init', 'aruix_register_post_types');