<?php

// Include default.php
include_once('inc/default.php');

// Inlcude enqueues.php
include_once('inc/enqueues.php');


// Inlcude header_customizer.php
include_once('inc/header_customizer.php');

// Inlcude header_customizer.php
include_once('inc/footer_customizer.php');


// Excerpt caharacter limit  
// function webaura_excerpt_more($more){
//     return '<a href="'. get_permalink(get_the_ID()) . '">Read More </a>';
// }
// add_filter('excerpt_more', 'webaura_excerpt_more'); 

// function webaura_excerpt_length($length){
//     return 10;
// }
// add_filter('excerpt_length', 'webaura_excerpt_length', 999);




// Custom Excerpt Read More Button
function webaura_excerpt_more($more){
    return '<div class="read-more-btn-area"> <a class="read-more-btn" href="' . get_permalink() . '">Read More</a></div>';
}
add_filter('excerpt_more', 'webaura_excerpt_more');


// Custom Excerpt Length
function webaura_excerpt_length($length){
    return 20; // number of words
}
add_filter('excerpt_length', 'webaura_excerpt_length', 999);
