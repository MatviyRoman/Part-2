<?php get_header(); ?>

<main>
    <h1>
        title <?php single_post_title(); ?>
    </h1>

    <div>
        Content <?php the_content(); ?>
    </div>

    <div>
        <?php previous_post_link('%link', '< prev post', true); ?>
        |
        <?php next_post_link('%link', 'next post >', true); ?>
    </div>

    <div>
        <?php global $post;
        $cat = get_the_category($post->ID);
        $args = array(
            'category__in' => $cat[0],
            'post__not_in' => array($post->ID),
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'orderby' => 'rand',
            'no_found_rows' => true,
            'cache_results' => false
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {

        ?>
        <aside class="related-posts">
            <h3>
                <?php _e('Related Posts', 'tutsplus'); ?>
            </h3>
            <ul class="related-posts">
                <?php

                    while ($query->have_posts()) {
                        $query->the_post();
                    ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </li>
                <?php
                    }
                    ?>
            </ul>
        </aside>
        <?php

        }

        wp_reset_postdata();

        ?>
    </div>
</main>

<?php get_footer(); ?>