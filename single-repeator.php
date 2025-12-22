<?php 
    /* Template Name: Single Repeator */

    get_header();
?>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="repeators-area">

                            <h1><?php the_title(); ?></h1>

                            <div class="repeator-single">
                                <?php 

                                    $repeators = get_post_meta(get_the_ID(), '_repeators', true);

                                    if(!empty($repeators)) :
                                        foreach($repeators as $rep) : ?>
                                            <p><strong><?php echo esc_html( $rep['question']); ?></strong></p>

                                            <!-- Text -->
                                            <?php if($rep['type'] === 'text') : ?>
                                                <p><?php echo esc_html( $rep['answer']); ?></p>
                                            <?php endif; ?>

                                            <!-- Editor -->
                                            <?php if($rep['type'] === 'editor') : ?>
                                                <p><?php echo wp_kses_post( $rep['answer']); ?></p>
                                            <?php endif; ?>

                                            <!-- Gallery -->
                                            <?php if ($rep['type'] === 'gallery'): ?>
                                                <div class="gallery">
                                                    <?php foreach ($rep['gallery'] as $img): ?>
                                                        <?php echo wp_get_attachment_image($img, 'medium'); ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>

                                            <!-- Radio -->
                                            <?php if ($rep['type'] === 'radio') : ?>

                                                <?php if (!empty($rep['options'])) : ?>
                                                    <ul class="repeator-radio-options">
                                                        <?php foreach ($rep['options'] as $opt) : ?>
                                                            <li><?php echo esc_html($opt); ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>

                                                <?php if (!empty($rep['image'])) : ?>
                                                    <div class="repeator-radio-image">
                                                        <?php echo wp_get_attachment_image($rep['image'], 'medium'); ?>
                                                    </div>
                                                <?php endif; ?>

                                            <?php endif; ?>


                                <?php  
                                        endforeach; 
                                    endif; 
                                ?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>