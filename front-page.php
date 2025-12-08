<?php get_header(); ?>

<div class="container mt-5">

    <!-- HERO SECTION -->
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <h1>Welcome to Our Website</h1>
            <p class="lead">Find latest properties and portfolio items here.</p>
        </div>
    </div>

    <!-- PROPERTY SECTION -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="mb-3">Latest Properties</h2>
        </div>

        <?php 
        $args = array(
            'post_type' => 'property',
            'posts_per_page' => 3,
            'order' => 'DESC',
        );
        $property_query = new WP_Query($args);

        if($property_query->have_posts()):
            while($property_query->have_posts()): $property_query->the_post();
        ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <?php the_post_thumbnail('medium', ['class'=>'card-img-top']); ?>
                <div class="card-body">
                    <h4 class="card-title"><?php the_title(); ?></h4>

                    <p><strong>Price:</strong> 
                        <?php echo get_post_meta(get_the_ID(), 'webaura_property_price', true); ?>
                    </p>

                    <a class="btn btn-primary" href="<?php the_permalink(); ?>">View Details</a>
                </div>
            </div>
        </div>

        <?php 
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>


    <!-- PORTFOLIO SECTION -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="mb-3">Latest Portfolio</h2>
        </div>

        <?php 
        $args2 = array(
            'post_type' => 'portfolio',
            'posts_per_page' => 3,
            'order' => 'DESC',
        );
        $port_query = new WP_Query($args2);

        if($port_query->have_posts()):
            while($port_query->have_posts()): $port_query->the_post();
        ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <?php the_post_thumbnail('medium', ['class'=>'card-img-top']); ?>
                <div class="card-body">
                    <h4 class="card-title"><?php the_title(); ?></h4>
                    <p><?php the_excerpt(); ?></p>

                    <a class="btn btn-primary" href="<?php the_permalink(); ?>">View Portfolio</a>
                </div>
            </div>
        </div>

        <?php 
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>

</div>

<?php get_footer(); ?>
