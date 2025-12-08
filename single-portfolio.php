<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php 
                if ( have_posts() ) : while ( have_posts() ) : the_post();
            ?>

                <div class="single-portfolio">

                    <h1 class="portfolio-title"><?php the_title(); ?></h1>
                    
                    <div class="portfolio-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>

                    <div class="portfolio-content">
                        <?php the_content(); ?>
                    </div>

                    <div class="portfolio-meta">
                        <p><strong>Category:</strong> <?php the_terms(get_the_ID(), 'category'); ?></p>
                        <p><strong>Tags:</strong> <?php the_terms(get_the_ID(), 'tag'); ?></p>
                    </div>

                </div>

            <?php endwhile; endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
