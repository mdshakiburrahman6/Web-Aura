<?php

// Custom Excerpt Read More Button
function webaura_excerpt_more($more){
    return '<div class="read-more-btn-area"> <a class="read-more-btn" href="' . get_permalink() . '">Read More</a></div>';
}
add_filter('excerpt_more', 'webaura_excerpt_more');


// Custom Excerpt Length
function webaura_excerpt_length($length){
    return 10; // number of words
}
add_filter('excerpt_length', 'webaura_excerpt_length', 999);

// Pagination
// function webaura_pagination(){
//     global $wp_query, $wp_rewrite;
//     $pages = '';
//     $max = $wp_query->max_num_pages;
//     if(!$current = get_query_var('paged')) $current = 1 ;
//     $args['base'] = str_replace(99999999999, '%#%', get_pagenum_link(99999999999));
//     $args['total'] = $max;

//     $args['current'] = $current;
//     $total = 1;
//     $args['prev_text'] = 'Prev';
//     $args['next_text'] = 'Next';

//     if($max > 1)
//         echo '<div class="pagination">';
//         if ($total == 1 && $max > 1) $pages = '<p class="pages"> Page ' . $current . '<span>of</span>'. $max .'</p> </div>';
//         echo $pages . '<div>' .  paginate_links($args);
//         if ($max > 1) echo '</div>';

// }

function webaura_bootstrap_pagination() {

    $args = array(
        'prev_text' => 'Prev',
        'next_text' => 'Next',
        'type'      => 'array'  // Important for looping
    );

    $pages = paginate_links($args);

    if (is_array($pages)) {
        echo '<nav>';
        echo '<ul class="pagination justify-content-center">';

        foreach ($pages as $page) {

            // Active page
            if (strpos($page, 'current') !== false) {
                echo '<li class="page-item active">' . str_replace('page-numbers', 'page-link', $page) . '</li>';
            }
            // Disabled (previous/next on edge)
            elseif (strpos($page, 'dots') !== false) {
                echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
            }
            // Normal page link
            else {
                echo '<li class="page-item">' . str_replace('page-numbers', 'page-link', $page) . '</li>';
            }
        }

        echo '</ul>';
        echo '</nav>';
    }
}

