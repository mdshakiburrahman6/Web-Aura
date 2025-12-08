<?php get_header(); ?>

<main>
    <section class="page-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php 
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post(); 
                    ?>

                    <h1 class="page-title"><?php the_title(); ?></h1>

                    <div class="page-content">
                        <?php the_content(); ?>
                    </div>

                    <?php 
                        endwhile;
                    endif; 
                    ?>

                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
