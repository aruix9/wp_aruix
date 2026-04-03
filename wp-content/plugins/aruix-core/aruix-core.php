<?php
/**
 * Plugin Name: Aruix Core
 * Description: Core functionality for Aruix
 * Version: 1.0
 */

// Prevent direct access to this file for security.
if (!defined('ABSPATH')) {
    exit;
}

// Register custom post types used by the theme.
function aruix_register_post_types() {
    // Register a custom post type called 'project' for portfolio items.
    register_post_type('project', array(
        'labels' => array(
            'name' => 'Projects', // Label for the collection of items.
            'singular_name' => 'Project', // Label for one item.
        ),
        'public' => true, // Show on frontend and in admin.
        'has_archive' => true, // Enable archive page for projects.
        'menu_icon' => 'dashicons-portfolio', // Admin menu icon.
        'supports' => array('title', 'editor', 'thumbnail'), // Supported post features.
        'show_in_rest' => true, // Enable Gutenberg editor support.
    ));
}

// Run this code on init to register post types after WordPress has loaded.
add_action('init', 'aruix_register_post_types');