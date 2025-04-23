<?php
/**
 * Settings file for Meta Tag Generator Admin.
 */

function mtg_add_admin_menu() {
    add_options_page(
        esc_html__( 'Meta Tag Generator Settings', 'meta-tag-generator' ),
        esc_html__( 'Meta Tag Generator', 'meta-tag-generator' ),
        'manage_options',
        'meta-tag-generator',
        'mtg_settings_page'
    );
}
add_action( 'admin_menu', 'mtg_add_admin_menu' );

function mtg_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Meta Tag Generator Settings', 'meta-tag-generator' ); ?></h1>
        <hr>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'mtg_settings_group' );
            do_settings_sections( 'meta-tag-generator' );
            submit_button();
            ?>
        </form>
        <hr>
        <p id="credit">
            <?php echo esc_html__( 'Developer : ', 'meta-tag-generator' ); ?>
            <a href="<?php echo esc_url( 'http://anupammondal.in' ); ?>" target="_blank">
                <?php esc_html_e( 'Anupam Mondal', 'meta-tag-generator' ); ?>
            </a>
        </p>
    </div>
    <?php
}

function mtg_register_settings() {
    register_setting( 'mtg_settings_group', 'mtg_enabled' );
    register_setting( 'mtg_settings_group', 'mtg_default_og_type' );
    register_setting( 'mtg_settings_group', 'mtg_default_twitter_card' );

    add_settings_section( 'mtg_main_section', esc_html__( 'Main Settings', 'meta-tag-generator' ), null, 'meta-tag-generator' );

    add_settings_field(
        'mtg_enabled',
        esc_html__( 'Enable Meta Tag Injection:', 'meta-tag-generator' ),
        'mtg_enabled_callback',
        'meta-tag-generator',
        'mtg_main_section'
    );
    add_settings_field(
        'mtg_og_type',
        esc_html__( 'Default Open Graph Type:', 'meta-tag-generator' ),
        'mtg_og_type_callback',
        'meta-tag-generator',
        'mtg_main_section'
    );
    add_settings_field(
        'mtg_twitter_card',
        esc_html__( 'Default Twitter Card Type:', 'meta-tag-generator' ),
        'mtg_twitter_card_callback',
        'meta-tag-generator',
        'mtg_main_section'
    );
}
add_action( 'admin_init', 'mtg_register_settings' );

function mtg_enabled_callback() {
    $enabled = get_option( 'mtg_enabled', 'yes' );
    ?>
    <input type="checkbox" name="mtg_enabled" value="yes" <?php checked( $enabled, 'yes', false ); ?>>
    <?php
}

function mtg_og_type_callback() {
    $value = get_option( 'mtg_default_og_type', 'website' );
    ?>
    <select name="mtg_default_og_type">
        <option value="website" <?php selected( $value, 'website', false ); ?>>
            <?php esc_html_e( 'Website', 'meta-tag-generator' ); ?>
        </option>
        <option value="article" <?php selected( $value, 'article', false ); ?>>
            <?php esc_html_e( 'Article', 'meta-tag-generator' ); ?>
        </option>
    </select>
    <?php
}

function mtg_twitter_card_callback() {
    $value = get_option( 'mtg_default_twitter_card', 'summary_large_image' );
    ?>
    <select name="mtg_default_twitter_card">
        <option value="summary" <?php selected( $value, 'summary', false ); ?>>
            <?php esc_html_e( 'Summary Card', 'meta-tag-generator' ); ?>
        </option>
        <option value="summary_large_image" <?php selected( $value, 'summary_large_image', false ); ?>>
            <?php esc_html_e( 'Large Summary Card', 'meta-tag-generator' ); ?>
        </option>
    </select>
    <?php
}
?>
