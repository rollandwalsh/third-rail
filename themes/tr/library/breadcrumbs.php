<?php
function the_breadcrumb() {
    global $post;
    echo '<ul class="breadcrumbs">';
    if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo 'Home';
        echo '</a></li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li> ');
            if (is_single()) {
                echo '</li><li class="current">';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $ancReversed = array_reverse($anc);
                $title = get_the_title();
                foreach ( $ancReversed as $ancestor ) {
                  echo '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> ';
                }
                echo '<li class="current">'.$title.'</li>';
            } else {
                echo '<li class="current">'.get_the_title().'</li>';
            }
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo'<li class="current">Archive for '; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo'<li class="current">Archive for '; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo'<li class="current">Archive for '; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo'<li class="current">Author Archive'; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo '<li class="current">Blog Archives'; echo'</li>';}
    elseif (is_search()) {echo'<li class="current">Search Results'; echo'</li>';}
    echo '</ul>';
}
?>