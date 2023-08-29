<?php
function mytheme_add_custom_fields() {
    add_meta_box(
        'mytheme_custom_checkbox',
        'Custom Checkbox',
        'mytheme_render_custom_checkbox',
        'post',
        'normal',
        'default'
    );
}

function mytheme_render_custom_checkbox($post) {
    $value = get_post_meta($post->ID, 'custom_checkbox', true);
    ?>
    <label for="custom-checkbox">
        <input type="checkbox" id="custom-checkbox" name="custom_checkbox" <?php checked($value, 'on'); ?> />
        Enable To show on main page
    </label>
    <?php
}

function mytheme_save_custom_checkbox($post_id) {
    if (isset($_POST['custom_checkbox'])) {
        update_post_meta($post_id, 'custom_checkbox', $_POST['custom_checkbox']);
    } else {
        delete_post_meta($post_id, 'custom_checkbox');
    }
}

add_action('add_meta_boxes', 'mytheme_add_custom_fields');
add_action('save_post', 'mytheme_save_custom_checkbox');
