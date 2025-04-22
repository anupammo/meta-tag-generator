<?php
function mtg_add_admin_menu() {
    add_options_page(
        'Meta Tag Generator Settings',
        'Meta Tag Generator',
        'manage_options',
        'meta-tag-generator',
        'mtg_settings_page'
    );
}
add_action('admin_menu', 'mtg_add_admin_menu');

function mtg_settings_page() {
    ?>
    <div class="wrap">
        <h1>Meta Tag Generator Settings</h1>
        <hr>
        <form method="post" action="options.php">
            <?php
            settings_fields('mtg_settings_group');
            do_settings_sections('meta-tag-generator');
            submit_button();
            ?>
        </form>
        <hr>
        <p id="credit">Developer : <a href="http://anupammondal.in" target="_blank">Anupam Mondal</a></p>
    </div>
    <?php
}

function mtg_register_settings() {
    register_setting('mtg_settings_group', 'mtg_enabled');
    register_setting('mtg_settings_group', 'mtg_default_og_type');
    register_setting('mtg_settings_group', 'mtg_default_twitter_card');

    add_settings_section('mtg_main_section', 'Main Settings', null, 'meta-tag-generator');

    add_settings_field('mtg_enabled', 'Enable Meta Tag Injection:', 'mtg_enabled_callback', 'meta-tag-generator', 'mtg_main_section');
    add_settings_field('mtg_og_type', 'Default Open Graph Type:', 'mtg_og_type_callback', 'meta-tag-generator', 'mtg_main_section');
    add_settings_field('mtg_twitter_card', 'Default Twitter Card Type:', 'mtg_twitter_card_callback', 'meta-tag-generator', 'mtg_main_section');
}
add_action('admin_init', 'mtg_register_settings');

function mtg_enabled_callback() {
    $enabled = get_option('mtg_enabled', 'yes');
    echo '<input type="checkbox" name="mtg_enabled" value="yes"' . checked($enabled, 'yes', false) . '>';
}

function mtg_og_type_callback() {
    $value = get_option('mtg_default_og_type', 'website');
    echo '<select name="mtg_default_og_type">
            <option value="website" '.selected($value, 'website', false).'>Website</option>
            <option value="article" '.selected($value, 'article', false).'>Article</option>
          </select>';
}

function mtg_twitter_card_callback() {
    $value = get_option('mtg_default_twitter_card', 'summary_large_image');
    echo '<select name="mtg_default_twitter_card">
            <option value="summary" '.selected($value, 'summary', false).'>Summary Card</option>
            <option value="summary_large_image" '.selected($value, 'summary_large_image', false).'>Large Summary Card</option>
          </select>';
}
?>
