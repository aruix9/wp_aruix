<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!defined('ARUIX_PATH')) {
    // ✅ DEFINE CONSTANTS FIRST
    define('ARUIX_VERSION', '1.0.0');
    define('ARUIX_PATH', get_template_directory());
    define('ARUIX_URI', get_template_directory_uri());
}

require_once ARUIX_PATH . '/inc/plugins.php';

// Show a front-end admin warning when the required ACF plugin is not active.
function aruix_frontend_plugin_warning() {
    // Only users with manage_options (administrators) see this message.
    if (!current_user_can('manage_options')) {
        return;
    }

    // If ACF is active, no warning is needed.
    if (aruix_is_acf_active()) {
        return;
    }

    // Print a visible red alert at the top of the page.
    echo '<div style="background:red;color:#fff;padding:10px;text-align:center;">
        ACF Plugin is NOT active. Theme may not work properly.
    </div>';
}

// Hook the warning into wp_body_open so it appears within <body> before main content.
add_action('wp_body_open', 'aruix_frontend_plugin_warning');

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