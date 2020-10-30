<?php if ( is_home() && current_user_can('publish_posts') ) : ?>

    <h2>Ready to publish your first post?</h2>
    <p>
        <a href="<?php echo esc_url( admin_url('post-new.php') ); ?>">
            Get started here
        </a>.
    </p>

    <?= get_search_form() ?>

<?php elseif ( is_search() ) : ?>

    <h2>Sorry we couldn't find any matches.</h2>
    <p>Please try again with some different keywords.</p>

    <?= get_search_form() ?>

<?php else : ?>

    <h2>It seems we can&rsquo;t find what you&rsquo;re looking for.</h2>
    <p>Perhaps searching can help.</p>

    <?= get_search_form() ?>

<?php endif; ?>
