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