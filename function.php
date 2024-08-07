<?php
/*
* Revert old widget wordpress
*/
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

/*
 * Validate phone number in contact form 7
 */
add_filter('wpcf7_validate_tel', 'cf7_validate_vietnam_phone', 10, 2);
add_filter('wpcf7_validate_tel*', 'cf7_validate_vietnam_phone', 10, 2);

function cf7_validate_vietnam_phone($result, $tag) {
    $name = $tag->name;
    $regex = '/(?:\+84|0084|0)[235789][0-9]{1,2}[0-9]{7}(?:[^\d]+|$)/iD';
    if (isset($_POST[$name]) && '' !== $_POST[$name] && !preg_match($regex, $_POST[$name], $match)) {
        $result->invalidate($name, wpcf7_get_message($name));
    }
    return $result;
}
