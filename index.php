<!-- Include header -->
<?php get_header(); ?>

    <main>
        <!-- <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-area">
                            <?php echo do_shortcode(get_the_content()); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <section class="blog-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="blogs">
                            <?php if (have_posts()) : 
                                while(have_posts()): the_post( );
                            ?>

                            
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
                        
                        
                            <?php endwhile;
                                else : _e('No post found');
                                endif;
                            ?>
                        </div>

                        <div class="pagination-area">
                            <div class="pagination-area">
                                <?php webaura_bootstrap_pagination(); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<!-- Include Footer -->
<?php get_footer(); ?>


