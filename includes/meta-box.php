<?php
/**
 * Register Meta Box for Meta Tag Generator.
 */

function mtg_add_meta_box() {
    add_meta_box(
        'mtg_meta_box',
        __( 'Meta Tag Generator', 'meta-tag-generator' ),
        'mtg_meta_box_callback',
        [ 'post', 'page' ],
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'mtg_add_meta_box' );

function mtg_meta_box_callback( $post ) {
    $pageTitle       = get_the_title( $post->ID );
    $metaDescription = get_post_meta( $post->ID, '_mtg_meta_description', true );
    $pageUrl         = get_permalink( $post->ID );
    $ogImage         = get_post_meta( $post->ID, '_mtg_meta_image', true ) ?: get_the_post_thumbnail_url( $post->ID, 'full' );
    $ogType          = get_post_meta( $post->ID, '_mtg_meta_ogtype', true ) ?: 'website';
    $twitterCard     = get_post_meta( $post->ID, '_mtg_meta_twitter_card', true ) ?: 'summary_large_image';
    ?>
    <div class="mtg-meta-box">
        <div class="frm">
            <label><?php esc_html_e( 'Page Title', 'meta-tag-generator' ); ?></label>
            <input type="text" name="mtg_title" value="<?php echo esc_attr( $pageTitle ); ?>" readonly>
        </div>
        <div class="frm">
            <label><?php esc_html_e( 'Meta Description', 'meta-tag-generator' ); ?></label>
            <textarea name="mtg_meta_description" maxlength="160"><?php echo esc_textarea( $metaDescription ); ?></textarea>
        </div>
        <div class="frm">
            <label><?php esc_html_e( 'Page URL', 'meta-tag-generator' ); ?></label>
            <input type="text" name="mtg_url" value="<?php echo esc_url( $pageUrl ); ?>" readonly>
        </div>
        <div class="frm">
            <label><?php esc_html_e( 'Featured Image URL', 'meta-tag-generator' ); ?></label>
            <input type="text" name="mtg_meta_image" value="<?php echo esc_url( $ogImage ); ?>" readonly>
        </div>
        <div class="frm">
            <label><?php esc_html_e( 'Open Graph Type', 'meta-tag-generator' ); ?></label>
            <select name="mtg_og_type">
                <option value="website" <?php selected( $ogType, 'website' ); ?>><?php esc_html_e( 'Website', 'meta-tag-generator' ); ?></option>
                <option value="article" <?php selected( $ogType, 'article' ); ?>><?php esc_html_e( 'Article', 'meta-tag-generator' ); ?></option>
            </select>
        </div>
        <div class="frm">
            <label><?php esc_html_e( 'Twitter Card Type', 'meta-tag-generator' ); ?></label>
            <select name="mtg_twitter_card">
                <option value="summary" <?php selected( $twitterCard, 'summary' ); ?>><?php esc_html_e( 'Summary Card', 'meta-tag-generator' ); ?></option>
                <option value="summary_large_image" <?php selected( $twitterCard, 'summary_large_image' ); ?>><?php esc_html_e( 'Large Summary Card', 'meta-tag-generator' ); ?></option>
            </select>
        </div>
        <div class="frm">
            <p id="credit">
                <?php esc_html_e( 'Developer :', 'meta-tag-generator' ); ?>
                <a href="<?php echo esc_url( 'https://anupammondal.in' ); ?>" target="_blank">
                    <?php esc_html_e( 'Anupam Mondal', 'meta-tag-generator' ); ?>
                </a>
            </p>
        </div>
    </div>
    <?php
}

function mtg_save_meta_tags( $post_id ) {
    if ( isset( $_POST['mtg_meta_description'] ) ) {
        update_post_meta( $post_id, '_mtg_meta_description', sanitize_text_field( wp_unslash( $_POST['mtg_meta_description'] ) ) );
    }
}
add_action( 'save_post', 'mtg_save_meta_tags' );
?>
