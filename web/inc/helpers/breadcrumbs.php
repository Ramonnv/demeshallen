<?php

function fairbase_breadcrumbs() {
    if (is_front_page()) return;

    echo '<div class="fairbase-breadcrumbs">';

    global $post;

    $home_url = get_home_url();
    $breadcrumb_class = 'breadcrumb';

    echo '<ul class="' . esc_attr($breadcrumb_class) . '">';
    echo '<li><a href="' . esc_url($home_url) . '">' . esc_html(get_bloginfo()) . '</a></li>';

    // WooCommerce Shop Page
    if (function_exists('is_shop') && is_shop()) {
        $shop_page_id = wc_get_page_id('shop');
        echo '<li>' . esc_html(get_the_title($shop_page_id)) . '</li>';

    // Single Product
    } elseif (function_exists('is_product') && is_product()) {
        $shop_page_id = wc_get_page_id('shop');
        echo '<li><a href="' . get_permalink($shop_page_id) . '">' . esc_html(get_the_title($shop_page_id)) . '</a></li>';

        $terms = get_the_terms($post->ID, 'product_cat');
        if ($terms && !is_wp_error($terms)) {
            $term = array_shift($terms);
            $ancestors = get_ancestors($term->term_id, 'product_cat');
            $ancestors = array_reverse($ancestors);

            foreach ($ancestors as $ancestor_id) {
                $ancestor = get_term($ancestor_id, 'product_cat');
                echo '<li><a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a></li>';
            }

            echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
        }

        echo '<li>' . esc_html(get_the_title()) . '</li>';

    // Product Category
    } elseif (is_tax('product_cat')) {
        $term = get_queried_object();

        $ancestors = get_ancestors($term->term_id, 'product_cat');
        $ancestors = array_reverse($ancestors);

        $shop_page_id = wc_get_page_id('shop');
        echo '<li><a href="' . get_permalink($shop_page_id) . '">' . esc_html(get_the_title($shop_page_id)) . '</a></li>';

        foreach ($ancestors as $ancestor_id) {
            $ancestor = get_term($ancestor_id, 'product_cat');
            echo '<li><a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a></li>';
        }

        echo '<li>' . esc_html($term->name) . '</li>';

    // Product Tag
    } elseif (is_tax('product_tag')) {
        $term = get_queried_object();
        $shop_page_id = wc_get_page_id('shop');
        echo '<li><a href="' . get_permalink($shop_page_id) . '">' . esc_html(get_the_title($shop_page_id)) . '</a></li>';
        echo '<li>' . esc_html($term->name) . '</li>';

    // Blog Post
    } elseif (is_single()) {
        $post_type = get_post_type_object(get_post_type());
        if ($post_type && $post_type->has_archive) {
            echo '<li><a href="' . esc_url(get_post_type_archive_link($post_type->name)) . '">' . esc_html($post_type->labels->name) . '</a></li>';
        }

        $categories = get_the_category();
        if ($categories && !is_wp_error($categories)) {
            $cat = $categories[0];
            $parents = get_category_parents($cat, true, '</li><li>');
            if ($parents) echo '<li>' . $parents . '</li>';
        }

        echo '<li>' . esc_html(get_the_title()) . '</li>';

    // Static Page with Ancestors
    } elseif (is_page() && $post->post_parent) {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        foreach ($ancestors as $ancestor_id) {
            echo '<li><a href="' . esc_url(get_permalink($ancestor_id)) . '">' . esc_html(get_the_title($ancestor_id)) . '</a></li>';
        }
        echo '<li>' . esc_html(get_the_title()) . '</li>';

    // Static Page
    } elseif (is_page()) {
        echo '<li>' . esc_html(get_the_title()) . '</li>';

    // Blog Listing
    } elseif (is_home()) {
        echo '<li>' . esc_html(get_the_title(get_option('page_for_posts'))) . '</li>';

    // Category Archive
    } elseif (is_category()) {
        echo '<li>' . esc_html(single_cat_title('', false)) . '</li>';

    // Tag Archive
    } elseif (is_tag()) {
        echo '<li>' . esc_html(single_tag_title('', false)) . '</li>';

    // Search Results
    } elseif (is_search()) {
        echo '<li>Search results for "' . esc_html(get_search_query()) . '"</li>';

    // 404 Page
    } elseif (is_404()) {
        echo '<li>404 Not Found</li>';

    // Generic Archive
    } elseif (is_archive()) {
        echo '<li>' . post_type_archive_title('', false) . '</li>';
    }

    echo '</ul>';
    echo '</div>';
}
