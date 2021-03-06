<?php get_header(); ?>

    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article class="post" id="post-<?php the_ID(); ?>">
            <h1 i-o-section><?php the_title(); ?></h1>

            <div i-o-section i-o-postContent>
                <?php the_content(); ?>
            </div>
        </article>

        <!-- <?php comments_template(); ?> -->

        <?php endwhile; endif; ?>

    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
