<?php get_header(); ?>

    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">

    <?php include(TEMPLATEPATH . '/nearest-terminy.php' ); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

            <h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

            <div class="entry">
                <?php the_content(); ?>
            </div>

            <div class="postmetadata"><?php the_tags("Tagi: "," &middot; "," &nbsp; "); ?></div>

        </article>

    <?php endwhile; ?>

    <?php else : ?>

        <h2>Not Found</h2>

    <?php endif; ?>

    <?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
