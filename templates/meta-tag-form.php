<div class="meta-tags-seo">
    <form id="metaForm">
        <label><?php esc_html_e( 'Page Title:', 'meta-tags-seo' ); ?></label>
        <input type="text" id="pageTitle" readonly>

        <label><?php esc_html_e( 'Meta Description:', 'meta-tags-seo' ); ?></label>
        <textarea id="metaDescription"></textarea>

        <label><?php esc_html_e( 'Page URL:', 'meta-tags-seo' ); ?></label>
        <input type="text" id="url" readonly>

        <label><?php esc_html_e( 'Featured Image URL:', 'meta-tags-seo' ); ?></label>
        <input type="text" id="mtg_meta_image">

        <label><?php esc_html_e( 'Open Graph Type:', 'meta-tags-seo' ); ?></label>
        <select id="mtg_og_type">
            <option value="website"><?php esc_html_e( 'Website', 'meta-tags-seo' ); ?></option>
            <option value="article"><?php esc_html_e( 'Article', 'meta-tags-seo' ); ?></option>
        </select>

        <label><?php esc_html_e( 'Twitter Card Type:', 'meta-tags-seo' ); ?></label>
        <select id="mtg_twitter_card">
            <option value="summary"><?php esc_html_e( 'Summary Card', 'meta-tags-seo' ); ?></option>
            <option value="summary_large_image"><?php esc_html_e( 'Large Summary Card', 'meta-tags-seo' ); ?></option>
        </select>

        <button type="button" onclick="generateMetaTags()"><?php esc_html_e( 'Generate Meta Tags', 'meta-tags-seo' ); ?></button>
    </form>
    <textarea id="output" readonly></textarea>
    <button type="button" onclick="copyToClipboard()"><?php esc_html_e( 'Copy', 'meta-tags-seo' ); ?></button>
</div>
