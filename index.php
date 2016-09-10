<?php get_header(); ?>
    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">
        <?php include(TEMPLATEPATH . '/nearest-terminy.php' ); ?>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                <h1 i-o-section>
                    <a
                        href="<?php the_permalink() ?>"
                        title="<?php the_title(); ?>"
                    >
                        <?php the_title(); ?>
                    </a>
                </h1>

                <div i-o-section i-o-postContent>
                    <?php the_content(); ?>
                </div>

                <small>
                    <?php the_tags("Tagi: "," &middot; "," &nbsp; "); ?>
                </small>
            </article>
        <?php endwhile; ?>
        <?php else : ?>
            <h2>Nie znaleziono</h2>
        <?php endif; ?>

        <?php include (TEMPLATEPATH . '/partials/nav_pagination.php' ); ?>
    </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
