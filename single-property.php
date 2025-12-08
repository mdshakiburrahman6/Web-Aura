<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php 
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); 
            ?>

            <div class="property-single">

                <!-- Featured Image -->
                <div class="property-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>

                <!-- Title -->
                <h1 class="property-title"><?php the_title(); ?></h1>

                <!-- Meta Fields -->
                <div class="property-meta">

                    <p><strong>Price:</strong> 
                        <?php echo get_post_meta(get_the_ID(), 'webaura_property_price', true); ?>
                    </p>

                    <p><strong>Phone:</strong> 
                        <?php echo get_post_meta(get_the_ID(), 'webaura_property_phone', true); ?>
                    </p>

                    <p><strong>Email:</strong> 
                        <?php echo get_post_meta(get_the_ID(), 'webaura_property_email', true); ?>
                    </p>

                </div>

                <!-- Main Content -->
                <div class="property-content">
                    <?php the_content(); ?>
                </div>

            </div>

            <?php 
                endwhile;
            endif; 
            ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
