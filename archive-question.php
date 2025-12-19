<?php get_header(); ?>

<div class="container">
    <h1>All Questions</h1>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

            <article class="question-archive-item">
                <h2>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
            </article>

        <?php endwhile; ?>
    <?php else : ?>
        <p>No questions found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
