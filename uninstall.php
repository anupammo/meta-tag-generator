<?php
/**
 * Uninstall Meta Tag Generator Plugin
 *
 * This file is executed when the plugin is deleted from WordPress Admin.
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit; // Prevent direct script access
}

// Remove stored options from wp_options table
delete_option( 'mtg_enabled' );
delete_option( 'mtg_default_og_type' );
delete_option( 'mtg_default_twitter_card' );

// Retrieve all posts that have the plugin's metadata
$meta_keys = array( '_mtg_meta_description', '_mtg_meta_image', '_mtg_meta_ogtype', '_mtg_meta_twitter_card' );

foreach ( $meta_keys as $meta_key ) {
    delete_post_meta_by_key( $meta_key );
}
?>
