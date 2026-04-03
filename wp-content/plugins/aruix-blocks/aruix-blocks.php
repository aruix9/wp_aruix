<?php
/**
 * Plugin Name: Aruix Blocks
 */

// Prevent direct access to the file for security.
if (!defined('ABSPATH')) exit;

// Register block scripts and block type on init.
function aruix_register_blocks() {
    // Register the block JS used in the editor.
    wp_register_script(
        'aruix-block-js', // Handle for the script.
        plugins_url('build/index.js', __FILE__), // URL to build/index.js in this plugin.
        array('wp-blocks', 'wp-element', 'wp-editor'), // Dependent WP packages.
        filemtime(plugin_dir_path(__FILE__) . 'build/index.js') // Cache-busting version based on file mod time.
    );

    // Register the frontend stylesheet for the block.
    wp_register_style(
        'aruix-block-style', // Handle for the frontend stylesheet.
        plugins_url('build/style-index.css', __FILE__), // URL to the compiled CSS file.
        array(), // No dependencies.
        filemtime(plugin_dir_path(__FILE__) . 'build/style-index.css') // Cache-busting version.
    );

    // Register the editor stylesheet for the block.
    wp_register_style(
        'aruix-block-editor-style', // Handle for the editor stylesheet.
        plugins_url('build/index.css', __FILE__), // URL to the editor CSS file.
        array(), // No dependencies.
        filemtime(plugin_dir_path(__FILE__) . 'build/index.css') // Cache-busting version.
    );
    
    // Register the block type and associate it with the registered script and render callback.
    register_block_type('aruix/latest-projects', array(
        'editor_script' => 'aruix-block-js', // Attach the registered editor JS.
        'style' => 'aruix-block-style', // Frontend stylesheet handle.
        'editor_style' => 'aruix-block-editor-style', // Editor stylesheet handle.
        'render_callback' => 'aruix_render_latest_projects', // Function to render block on frontend.
    ));
}

// Hook block registration into init action.
add_action('init', 'aruix_register_blocks');

// Render callback function for the latest-projects block.
function aruix_render_latest_projects($attributes) {
    // Determine how many projects to show based on block attributes, defaulting to 3 if not set.
    $count = isset($attributes['postsToShow']) ? $attributes['postsToShow'] : 3;
    $layout = isset($attributes['layout']) ? $attributes['layout'] : 'list';
    $args = array(
        'post_type' => 'project', // Query the 'project' custom post type.
        'posts_per_page' => $count, // Limit the number of posts returned by the query.
    );

    // Execute the custom query.
    $query = new WP_Query($args);

    // If no projects found, return a message.
    if (!$query->have_posts()) {
        return '<p>No projects found</p>';
    }

    // Start output buffering to capture HTML.
    ob_start();

    echo '<div class="aruix-projects ' . $layout . '">';
    // Loop through projects and display titles.
    while ($query->have_posts()) {
        $query->the_post();
        echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    }
    echo '</div>';
    // Reset post data after custom query.
    wp_reset_postdata();

    // Return the captured HTML.
    return ob_get_clean();
}