<?php get_header(); ?>

<main>

    <?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

    <?php get_template_part('template-parts/content'); ?>

    <?php endwhile; ?>

    <?php else : ?>

    <?php get_template_part('template-parts/content', 'none'); ?>

    <?php endif; ?>

</main>


<?php
    $taxonomies = get_taxonomies();

    foreach ($taxonomies as $taxonomy) {
        global $wpdb;
        if (
            $taxonomy !== 'category' && $taxonomy !== 'post_tag' && $taxonomy !== 'nav_menu' && $taxonomy !== 'link_category' && $taxonomy !== 'post_format'
        ) {
            $prefix = $wpdb->prefix;
            $sql = "SELECT * FROM " . $prefix . "posts WHERE `post_type` = '" . $taxonomy . "'";
            $results = $wpdb->get_results($sql);

            $pt = get_post_type_object($taxonomy);
            $count_posts = wp_count_posts($taxonomy);
            $total_posts = $count_posts->publish;

            if ($total_posts) {
                echo '<h1>This is Category "' . $pt->labels->singular_name . '" from "' . $pt->labels->name . '" > Taxonomy</h1>
                <p>' . $pt->description . '</p>';


                echo '<ul class="category">';
                foreach ($results as $result) {
                    $datas = (array)$result;
                    if (($datas['ID']) && $datas["post_status"] == 'publish') {



                        $datas = (array)$result;
                        if (($datas['ID']) && $datas["post_status"] == 'publish') {
                            //var_dump((array)$result);
                            echo '<li><a href="' . get_permalink($datas['ID']) . '">' . $datas['post_title'] . '</a></li>';
                        }
                    }
                }
                echo '</ul>';
            }
        }
    }
?>

<?php get_footer(); ?>