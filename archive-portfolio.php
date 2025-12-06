<?php get_header( ); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <section class="blogs">
                    <?php 
                    query_posts( 'post_type=portfolio&post_status=publish&post_per_page=-1&order=ASC&paged='. get_query_var('post'));   // User -1 for 
                        if(have_posts()) : 
                            while (have_posts()) :
                                the_post();
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
                        else : _e( 'No post found' );
                        endif;
                    ?>

                </section>
        </div>
    </div>
</div>

<?php get_footer(); ?>