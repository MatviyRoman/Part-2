<?php


//add style
function style()
{
    //bootstrap
    wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), '4.5.2', 'all');
    wp_enqueue_style('bootstrap');

    //ionicons
    wp_register_style('ionicons', 'http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), '2.0.1', 'all');
    wp_enqueue_style('ionicons');
}

add_action('wp_enqueue_scripts', 'style');


//add scripts
function scripts()
{
    //jquery
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', false, '3.5.1');
    wp_enqueue_script('jquery');

    //Bootstrap js
    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array(), '4.5.2', true);
    wp_enqueue_script('bootstrap-bundle', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array(), '4.5.2', true);
}
add_action('wp_enqueue_scripts', 'scripts');


//shortcode
function linkcode($value)
{
    if (is_page()) {
        if ($value['url']) {
            if (!$value['title']) {
                $value['title'] = 'Download File';
            }
            $value = shortcode_atts(array(
                'url' => $value['url'],
                'title' => $value['title'],
            ), $value);

            return '<a href="' . $value['url'] . '" title="' . quotemeta($value['title']) . '">' . quotemeta($value['title']) . '</a>';
        }
    }

    return false;
}
add_shortcode('link_dwn', 'linkcode');



//Pages return error 404
add_filter('pre_handle_404', 'myhook_disable_page', 10, 2);
function myhook_disable_page($flag, $wp_query)
{
    global $wp_query;
    $url = $_SERVER["REQUEST_URI"];
    $country = strpos($url, 'country');

    if (is_author() || is_category() || is_tag() || is_archive() || $country) {
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        return false;
    }
    return $flag;
}