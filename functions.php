<?php

function cec_add_roles() {
    $roles = [
        'free_reader' => 'Free Reader',
        'paid_reader' => 'Paid Reader',
        'premium_reader' => 'Premium Reader',
    ];

    foreach ($roles as $key => $value) {
        add_role($key, $value);
    }
}

function cec_add_role_metabox() {
    add_meta_box(
        'cec_restrict_by_role_metabox',
        'Restrict Content Based on Role',
        'cec_restrict_by_role_metabox_callback',
        'post',
        'side'
    );
}

function cec_enable_public_registration() {
    update_option('users_can_register', 1);
    update_option('default_role', 'free_reader');
}

function cec_restrict_by_role_metabox_callback($post) {

    $roles = ['free_reader', 'paid_reader', 'premium_reader'];

    $selected_role = get_post_meta($post->ID, '_cec_role', true);

    echo '<label for="cec_role">Allow access to role:</label>';
    echo '<select name="cec_role" id="cec_role">';
    foreach ($roles as $role) {
        echo '<option value="' . $role . '" ' . selected($selected_role, $role, false) . '>' . ucfirst(str_replace('_', ' ', $role)) . '</option>';
    }
    echo '</select>';
}

function cec_save_role_metabox($post_id) {
    if (array_key_exists('cec_role', $_POST)) {
        update_post_meta($post_id, '_cec_role', $_POST['cec_role']);
    }
}

function cec_exclude_premium_posts_from_list($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (!current_user_can('premium_reader')) {
            $meta_query = array(
                'relation' => 'OR',
                array(
                    'key' => '_cec_role',
                    'compare' => 'NOT EXISTS'
                ),
                array(
                    'key' => '_cec_role',
                    'value' => 'premium_reader',
                    'compare' => '!='
                )
            );

            $query->set('meta_query', $meta_query);
        }
    }
}

function cec_register_menus(){
    register_nav_menus(
        array(
            'primary-menu' => 'Primary Menu',
        )
    );
}

add_action('init', 'cec_enable_public_registration');
add_action('init', 'cec_register_menus');
add_action('after_setup_theme', 'cec_add_roles');
add_action('add_meta_boxes', 'cec_add_role_metabox');
add_action('save_post', 'cec_save_role_metabox');
add_action('pre_get_posts', 'cec_exclude_premium_posts_from_list');

function cec_restrict_content_by_role($content) {
    if (is_singular('post')) {
        $required_role = get_post_meta(get_the_ID(), '_cec_role', true);

        if ($required_role) {
            if (current_user_can('premium_reader')) {
                return $content;
            }

            if (current_user_can('paid_reader') && ($required_role === 'free_reader' || $required_role === 'paid_reader')) {
                return $content;
            }

            if (current_user_can('free_reader') && $required_role === 'free_reader') {
                return $content;
            }

            $post_content = get_post_field('post_content', get_the_ID());
            $post_content = strip_shortcodes($post_content);
            $post_content = wp_strip_all_tags($post_content);
            
            $excerpt_length = 55;
            $words = explode(' ', $post_content);
            if (count($words) > $excerpt_length) {
                $excerpt = implode(' ', array_slice($words, 0, $excerpt_length)) . '...';
            } else {
                $excerpt = implode(' ', $words);
            }

            $content = $excerpt . '<p class="text-center text-uppercase"> <a href="/#membership">upgrade your plan for full access</a>.</p>';
        }
    }
    return $content;
}

add_filter('the_content', 'cec_restrict_content_by_role');
