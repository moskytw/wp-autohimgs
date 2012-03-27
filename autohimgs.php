<?php
/*
Plugin Name: Auto Header Imgs
Plugin URI:
Description: Without additional settings, make theme to take the header images under <code>THEMEDIR/headers</code> as the default headers. The file whose postfix is <code>-thumbnail</code> will be treat as the thumbnail. <strong>Notice:</strong> It will clear the settings of default header images by theme.
Author: Mosky 
Version: 0.1
Author URI: http://mosky.tw/
*/

function clear_default_headers() {
     global $_wp_default_headers;
     $_wp_default_headers = array();
}

function fname2title($fname, $sep = '.') {
    $title = join('.', explode($sep, $fname, -1));
    $title = str_replace('-', ' ', $title);
    $title = ucwords( $title );
    return $title;
}

function scan_header_images() {
    $headers_dir = get_template_directory() . '/images/headers';
    $baseurl = '%s/images/headers/';

    $headers = array();
    $thumbnails = array();

    $files = scandir($headers_dir);
    foreach($files as $i => $fname) {
        if( substr($fname, 0, 1) == '.') continue;

        if( preg_match('/-thumbnail/', $fname) )
        {
            array_push( $thumbnails, $fname );
            continue;
        }

        $title = fname2title( $fname );
        $headers[ $title ] = array(
            'url' => $baseurl.$fname,
            'description' => $title
        );
    }

    foreach($thumbnails as $i => $fname) {
        $title = fname2title( $fname , '-');
        if( ! array_key_exists($title, $headers) ) continue;

        $headers[ $title ][ 'thumbnail_url' ] = $baseurl.$fname;
    }

    return $headers;
}


function auto_header_images()
{
    clear_default_headers();
    $headers = scan_header_images();
    register_default_headers( $headers );
}

add_action( 'after_setup_theme', 'auto_header_images' );
?>