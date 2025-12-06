<?php

// Text Shortcode


function text_short(){
    return "This is a Short Code";
}
add_shortcode('text', 'text_short');



// Button shortcode
function button_short($atts, $content = null){
    $values = shortcode_atts( array(
        'url' => '#',
    ), $atts );
    return '<a class="btn_short" href="'. esc_attr( $values['url'] ) .'">' . $content . '</a>';
}
add_shortcode( 'btn_short', 'button_short');



// Protfolio page short code
function portfolio_shortcode($atts){
    ob_start();
    $query = new WP_Query(array(
        'post_type' => 'portfolio',
        'post_per_page' => 3,
        'order' => 'ASC',
        'orderby' => 'title',
    ));
    if($query->have_posts()){ ?>

        <!-- Port -->
          <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="blogs">
                        <?php 
                            while($query->have_posts()): $query->the_post();
                        ?> 

                            <!-- PORTFOLIO ITEMS -->
                            
                            <div class="single-blog">
                                    <div class="post_thumb">
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                                    </div>
                                    <div class="post_titles">
                                        <a href="<?php the_permalink(); ?>"><h3 class="post_title"><?php the_title(); ?></h3></a>
                                    </div>
                                    <div class="post_excerpt">
                                        <p><?php the_excerpt(); ?></p>
                                    </div>
                                </div>

                        <?php  endwhile; 
                            wp_reset_postdata(  );
                        ?>

                    </section>
                </div>
            </div>
          </div>
        <!-- Port -->

        <?php $my_veriable = ob_get_clean();
        return $my_veriable;
    }
}
add_shortcode('port_short', 'portfolio_shortcode');