<?php get_header(); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <div class="card shadow-lg border-0 rounded-4">
                    
                    <!-- Thumbnail -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <img src="<?php the_post_thumbnail_url('large'); ?>" 
                             class="card-img-top rounded-top-4" alt="<?php the_title(); ?>">
                    <?php endif; ?>

                    <div class="card-body p-5">

                        <!-- Title -->
                        <h1 class="fw-bold mb-3 text-primary"><?php the_title(); ?></h1>

                        <!-- Meta Info -->
                        <div class="d-flex gap-4 mb-4 text-muted">

                            <div>
                                <strong>Category:</strong>
                                <?php echo get_the_term_list(get_the_ID(), 'category', '<span>', ', ', '</span>'); ?>
                            </div>

                            <div>
                                <strong>Tags:</strong>
                                <?php echo get_the_term_list(get_the_ID(), 'post_tag', '<span>', ', ', '</span>'); ?>
                            </div>

                        </div>

                        <!-- Content -->
                        <div class="portfolio-content fs-5">
                            <?php the_content(); ?>
                        </div>

                    </div>
                </div>

            <?php endwhile; endif; ?>

            <!-- Back Button -->
            <div class="text-center mt-4">
                <a href="<?php echo site_url('/portfolio'); ?>" class="btn btn-primary btn-lg px-4">
                    ← Back to Portfolio
                </a>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>
