<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check if ACF is active
 */
function aruix_is_acf_active() {
    return function_exists('get_field');
}


/**
 * Admin Notice for Required Plugins
 */
function aruix_required_plugins_notice() {

    if (aruix_is_acf_active()) {
        return;
    }

    $install_url = admin_url('plugin-install.php?s=advanced+custom+fields&tab=search&type=term');

    ?>
    <div class="notice notice-error">
        <p>
            <strong>Aruix Theme:</strong> Advanced Custom Fields plugin is required.
            <a href="<?php echo esc_url($install_url); ?>">
                Install Plugin
            </a>
        </p>
    </div>
    <?php
}

add_action('admin_notices', 'aruix_required_plugins_notice');