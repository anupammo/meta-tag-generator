<?php
/**
 * Settings file for Meta Tags Generator Admin.
 */

function mtg_add_admin_menu() {
    add_options_page(
        esc_html__( 'Meta Tags Generator Settings', 'meta-tags-seo' ),
        esc_html__( 'Meta Tags Generator', 'meta-tags-seo' ),
        'manage_options',
        'meta-tags-seo',
        'mtg_settings_page'
    );
}
add_action( 'admin_menu', 'mtg_add_admin_menu' );

function mtg_settings_page() { ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Meta Tags Generator Settings', 'meta-tags-seo' ); ?></h1>
        <hr>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'mtg_settings_group' );
            do_settings_sections( 'meta-tags-seo' );
            submit_button();
            ?>
        </form>
        <hr>
        <p id="credit">
            <?php esc_html_e( 'Developer : ', 'meta-tags-seo' ); ?>
            <a href="<?php echo esc_url( 'http://anupammondal.in' ); ?>" target="_blank">
                <?php esc_html_e( 'Anupam Mondal', 'meta-tags-seo' ); ?>
            </a>
        </p>
    </div>
<?php }

function mtg_register_settings() {
    // Register settings with static sanitization callbacks.
    register_setting( 'mtg_settings_group', 'mtg_enabled', array(
        'sanitize_callback' => 'mtg_sanitize_enabled'
    ) );
    register_setting( 'mtg_settings_group', 'mtg_default_og_type', array(
        'sanitize_callback' => 'mtg_sanitize_default_og_type'
    ) );
    register_setting( 'mtg_settings_group', 'mtg_default_twitter_card', array(
        'sanitize_callback' => 'mtg_sanitize_default_twitter_card'
    ) );

    add_settings_section( 'mtg_main_section', esc_html__( 'Main Settings', 'meta-tags-seo' ), '__return_null', 'meta-tags-seo' );

    add_settings_field( 'mtg_enabled', esc_html__( 'Enable Meta Tags:', 'meta-tags-seo' ), 'mtg_enabled_callback', 'meta-tags-seo', 'mtg_main_section' );
    add_settings_field( 'mtg_og_type', esc_html__( 'Open Graph Type:', 'meta-tags-seo' ), 'mtg_og_type_callback', 'meta-tags-seo', 'mtg_main_section' );
    add_settings_field( 'mtg_twitter_card', esc_html__( 'Twitter Card Type:', 'meta-tags-seo' ), 'mtg_twitter_card_callback', 'meta-tags-seo', 'mtg_main_section' );
}
add_action( 'admin_init', 'mtg_register_settings' );

function mtg_enabled_callback() {
    $enabled = get_option( 'mtg_enabled', 'yes' );
    echo '<input type="checkbox" name="mtg_enabled" value="yes" ' . checked( $enabled, 'yes', false ) . '>';
}

function mtg_og_type_callback() {
    $value = get_option( 'mtg_default_og_type', 'website' );
    ?>
    <select name="mtg_default_og_type" class="frm-select">
        <option value="website" <?php selected( $value, 'website', false ); ?>>
            <?php esc_html_e( 'Website', 'meta-tags-seo' ); ?>
        </option>
        <option value="article" <?php selected( $value, 'article', false ); ?>>
            <?php esc_html_e( 'Article', 'meta-tags-seo' ); ?>
        </option>
    </select>
    <?php
}

function mtg_twitter_card_callback() {
    $value = get_option( 'mtg_default_twitter_card', 'summary_large_image' );
    ?>
    <select name="mtg_default_twitter_card" class="frm-select">
        <option value="summary" <?php selected( $value, 'summary', false ); ?>>
            <?php esc_html_e( 'Summary Card', 'meta-tags-seo' ); ?>
        </option>
        <option value="summary_large_image" <?php selected( $value, 'summary_large_image', false ); ?>>
            <?php esc_html_e( 'Large Summary Card', 'meta-tags-seo' ); ?>
        </option>
    </select>
    <?php
}

/**
 * Sanitizes the 'mtg_enabled' setting.
 *
 * @param string $input The input value.
 * @return string Sanitized value.
 */
function mtg_sanitize_enabled( $input ) {
    return sanitize_text_field( $input );
}

/**
 * Sanitizes the 'mtg_default_og_type' setting.
 *
 * @param string $input The input value.
 * @return string Sanitized value.
 */
function mtg_sanitize_default_og_type( $input ) {
    return sanitize_text_field( $input );
}

/**
 * Sanitizes the 'mtg_default_twitter_card' setting.
 *
 * @param string $input The input value.
 * @return string Sanitized value.
 */
function mtg_sanitize_default_twitter_card( $input ) {
    return sanitize_text_field( $input );
}
?>
