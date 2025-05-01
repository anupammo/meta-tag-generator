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

// Remove meta data associated with posts
global $wpdb;
$wpdb->query( "DELETE FROM $wpdb->postmeta WHERE meta_key LIKE '_mtg_%'" );
?>
