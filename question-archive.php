<?php get_header(); ?>

<div class="container my-5">
    <div class="row">

        <!-- LEFT: Property Details -->
        <div class="col-md-12">

            <?php 
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); 
            ?>

            <div class="blog-single card shadow-sm p-4">

                <!-- Featured Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="property-image mb-4 text-center">
                        <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
                    </div>
                <?php endif; ?>

                <!-- Title -->
                <h1 class="property-title mb-3"><?php the_title(); ?></h1>

                <!-- Content -->
                <div class="property-content mb-4">
                    <?php the_content(); ?>
                </div>

            </div>

            <?php endwhile; endif; ?>

        </div>


    </div>
</div>

<?php get_footer(); ?>
