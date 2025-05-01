<?php
/**
 * Plugin Name: Meta Tags SEO
 * Plugin URI: https://github.com/anupammo/meta-tags-seo
 * Description: A WordPress plugin to auto-fetch and edit meta tags with Open Graph, Twitter, and Schema Markup.
 * Requires at least: 6.3
 * Requires PHP: 7.4
 * Version: 1.2.0
 * Author: Anupam Mondal
 * Author URI: https://anupammondal.in
 * License: GPLv3
 * License URI: https://raw.githubusercontent.com/anupammo/meta-tags-seo/refs/heads/main/LICENSE
 * Text Domain: meta-tags-seo
 */

defined('ABSPATH') or die('No direct access allowed!');

// Include meta box and settings functions
require_once plugin_dir_path(__FILE__) . 'includes/meta-box.php';
require_once plugin_dir_path(__FILE__) . 'includes/settings.php';/**
* Plugin Activation: Set default settings
*/
function mtg_activate_plugin() {
   // Default settings for the plugin
   add_option('mtg_enabled', 'yes');
   add_option('mtg_default_og_type', 'website');
   add_option('mtg_default_twitter_card', 'summary_large_image');
}
register_activation_hook(__FILE__, 'mtg_activate_plugin');

/**
* Plugin Deactivation: Cleanup settings
*/
function mtg_deactivate_plugin() {
   // Remove options (optional cleanup)
   delete_option('mtg_enabled');
   delete_option('mtg_default_og_type');
   delete_option('mtg_default_twitter_card');
}
register_deactivation_hook(__FILE__, 'mtg_deactivate_plugin');

/**
* Enqueue Admin Styles
*/

function mtg_enqueue_admin_styles($hook) {
    if ($hook === 'post.php' || $hook === 'post-new.php') { // Load styles only in post/page editors
        wp_enqueue_style(
            'mtg-admin-css',
            plugin_dir_url(__FILE__) . 'assets/style.css',
            array(),         // Dependencies (none specified)
            '1.2.0'          // Version parameter added
        );
    }
}
add_action('admin_enqueue_scripts', 'mtg_enqueue_admin_styles');

// Inject meta tags into page headers
function mtg_add_meta_tags() {
    $enabled = get_option('mtg_enabled', 'yes'); // Default: Enabled
    if ($enabled !== 'yes') {
        return; // Do nothing if disabled
    }

    if (is_single() || is_page()) {
        global $post;
        $pageTitle = get_the_title($post->ID);
        $metaDescription = get_post_meta($post->ID, '_mtg_meta_description', true) ?: get_bloginfo('description');
        $pageUrl = get_permalink($post->ID);
        $ogImage = get_post_meta($post->ID, '_mtg_meta_image', true) ?: get_the_post_thumbnail_url($post->ID, 'full');
        $ogType = get_post_meta($post->ID, '_mtg_meta_ogtype', true) ?: get_option('mtg_default_og_type', 'website');
        $twitterCard = get_post_meta($post->ID, '_mtg_meta_twitter_card', true) ?: get_option('mtg_default_twitter_card', 'summary_large_image');

        echo "\n<!-- Primary Meta Tags -->\n";
        echo "<meta name='description' content='" . esc_attr($metaDescription) . "'>\n";
        
        echo "\n<!-- Open Graph / Facebook -->\n";
        echo "<meta property='og:type' content='" . esc_attr($ogType) . "'>\n";
        echo "<meta property='og:url' content='" . esc_url($pageUrl) . "'>\n";
        echo "<meta property='og:title' content='" . esc_attr($pageTitle) . "'>\n";
        echo "<meta property='og:description' content='" . esc_attr($metaDescription) . "'>\n";
        echo "<meta property='og:image' content='" . esc_url($ogImage) . "'>\n";
        
        echo "\n<!-- Twitter -->\n";
        echo "<meta property='twitter:card' content='" . esc_attr($twitterCard) . "'>\n";
        echo "<meta property='twitter:url' content='" . esc_url($pageUrl) . "'>\n";
        echo "<meta property='twitter:title' content='" . esc_attr($pageTitle) . "'>\n";
        echo "<meta property='twitter:description' content='" . esc_attr($metaDescription) . "'>\n";
        echo "<meta property='twitter:image' content='" . esc_url($ogImage) . "'>\n";

        echo "\n<!-- Schema Markup (JSON-LD) -->\n";
        $jsonLD = [
            "@context"    => "https://schema.org",
            "@type"       => $ogType === "article" ? "Article" : "WebPage",
            "name"        => $pageTitle,
            "url"         => $pageUrl,
            "description" => $metaDescription,
            "image"       => $ogImage
        ];
        // Use wp_json_encode to safely encode JSON for output.
        echo "<script type='application/ld+json'>" . wp_json_encode($jsonLD, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "</script>\n";
    }
}
add_action('wp_head', 'mtg_add_meta_tags');
?>
