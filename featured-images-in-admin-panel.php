<?php
/**
 * Plugin Name: Featured Images in Admin Panel
 * Description: Adds a custom column to the posts and pages admin panel to display featured images.
 * Version: 1.3 
 * Author: Crunchify LLC
 */

// Add the custom image size
add_image_size('crunchify-admin-post-featured-image', 200, 120, false);

// Add the posts and pages columns filter
add_filter('manage_posts_columns', 'crunchify_add_post_admin_thumbnail_column', 2);
add_filter('manage_pages_columns', 'crunchify_add_post_admin_thumbnail_column', 2);

// Add the column
function crunchify_add_post_admin_thumbnail_column($columns)
{
    $columns['crunchify_thumb'] = __('Featured Image');
    return $columns;
}

// Let's manage Post and Page Admin Panel Columns
add_action('manage_posts_custom_column', 'crunchify_show_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'crunchify_show_post_thumbnail_column', 5, 2);

// Here we are grabbing featured-thumbnail size post thumbnail and displaying it
function crunchify_show_post_thumbnail_column($column_name, $post_id)
{
    if ($column_name === 'crunchify_thumb') {
        if (function_exists('the_post_thumbnail')) {
            echo the_post_thumbnail('crunchify-admin-post-featured-image');
        } else {
            echo 'hmm... your theme doesn\'t support featured image...';
        }
    }
}
