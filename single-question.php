<?php get_header(); ?>

<div class="container">

    <h1><?php the_title(); ?></h1>

    <?php
    $questions = get_post_meta(get_the_ID(), '_questions', true);

    if (!empty($questions)) :
        foreach ($questions as $q) :
    ?>
        <div class="question-frontend-item">
            <h4><?php echo esc_html($q['question']); ?></h4>

            <?php if ($q['type'] === 'text'): ?>
                <p><?php echo esc_html($q['answer']); ?></p>
            <?php else: ?>
                <ul>
                    <?php foreach ($q['options'] as $opt): ?>
                        <li><?php echo esc_html($opt); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php
        endforeach;
    else :
        echo '<p>No questions found.</p>';
    endif;
    ?>

</div>

<?php get_footer(); ?>
