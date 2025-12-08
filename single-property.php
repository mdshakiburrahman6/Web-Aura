<?php get_header(); ?>

<div class="container my-5">
    <div class="row">

        <!-- LEFT: Property Details -->
        <div class="col-md-8">

            <?php 
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); 
            ?>

            <div class="property-single card shadow-sm p-4">

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

        <!-- RIGHT: Meta Info Sidebar -->
        <div class="col-md-4">

            <div class="card shadow-sm p-4 sticky-top" style="top: 90px;">
                <h4 class="mb-3">Property Details</h4>

                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        <strong>Price:</strong> 
                        <?php echo get_post_meta(get_the_ID(), 'webaura_property_price', true); ?>
                    </li>

                    <li class="list-group-item">
                        <strong>Phone:</strong> 
                        <?php echo get_post_meta(get_the_ID(), 'webaura_property_phone', true); ?>
                    </li>

                    <li class="list-group-item">
                        <strong>Email:</strong> 
                        <?php echo get_post_meta(get_the_ID(), 'webaura_property_email', true); ?>
                    </li>

                </ul>

                <div class="mt-3 text-center">
                    <a href="tel:<?php echo get_post_meta(get_the_ID(), 'webaura_property_phone', true); ?>" 
                        class="btn btn-primary btn-block mb-2">
                        Call Now
                    </a>

                    <a href="mailto:<?php echo get_post_meta(get_the_ID(), 'webaura_property_email', true); ?>" 
                        class="btn btn-outline-secondary btn-block">
                        Send Email
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>

<?php get_footer(); ?>
