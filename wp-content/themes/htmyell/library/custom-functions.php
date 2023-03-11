<?php

/* Edit defaul oEmbed functionality to add foundation classes */
function add_video_embed_note($html, $url, $attr) {
    $parse = parse_url($url);
    $url = $parse['host'];
    $videoClass = strtolower(str_ireplace(array('www.', '.com'), '', $url));

    $html = '<div class="flex-video widescreen '. $videoClass .'">' . $html . '</div>';
    return $html;
}
add_filter('embed_oembed_html', 'add_video_embed_note', 10, 3);