<div class="meta-tag-generator">
    <form id="metaForm">
        <label><?php esc_html_e( 'Page Title:', 'meta-tag-generator' ); ?></label>
        <input type="text" id="pageTitle" readonly>

        <label><?php esc_html_e( 'Meta Description:', 'meta-tag-generator' ); ?></label>
        <textarea id="metaDescription"></textarea>

        <label><?php esc_html_e( 'Page URL:', 'meta-tag-generator' ); ?></label>
        <input type="text" id="url" readonly>

        <label><?php esc_html_e( 'Featured Image URL:', 'meta-tag-generator' ); ?></label>
        <input type="text" id="mtg_meta_image">

        <label><?php esc_html_e( 'Open Graph Type:', 'meta-tag-generator' ); ?></label>
        <select id="mtg_og_type">
            <option value="website"><?php esc_html_e( 'Website', 'meta-tag-generator' ); ?></option>
            <option value="article"><?php esc_html_e( 'Article', 'meta-tag-generator' ); ?></option>
        </select>

        <label><?php esc_html_e( 'Twitter Card Type:', 'meta-tag-generator' ); ?></label>
        <select id="mtg_twitter_card">
            <option value="summary"><?php esc_html_e( 'Summary Card', 'meta-tag-generator' ); ?></option>
            <option value="summary_large_image"><?php esc_html_e( 'Large Summary Card', 'meta-tag-generator' ); ?></option>
        </select>

        <button type="button" onclick="generateMetaTags()"><?php esc_html_e( 'Generate Meta Tags', 'meta-tag-generator' ); ?></button>
    </form>
    <textarea id="output" readonly></textarea>
    <button type="button" onclick="copyToClipboard()"><?php esc_html_e( 'Copy', 'meta-tag-generator' ); ?></button>
</div>
