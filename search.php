<?php get_header(); ?>

    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">

    <?php if (have_posts()) : ?>

        <h1 i-o-section="main">Wyniki wyszukiwania</h1>

        <?php while (have_posts()) : the_post(); ?>

            <article i-o-section <?php post_class() ?> id="post-<?php the_ID(); ?>">
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

                <div>
                    <?php the_excerpt(); ?>
                </div>

                <small>
                    Dodane <?php echo str_replace(array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"), array("stycznia", "lutego", "marca", "kwietnia", "maja", "czerwca", "lipca", "sierpnia", "września", "października", "listopada", "grudnia"), get_the_date()); ?> o <?php the_time() ?>
                </small>
            </article>

        <?php endwhile; ?>

        <?php include (TEMPLATEPATH . '/partials/nav_pagination.php' ); ?>

    <?php else : ?>

        <h2>Nic nie znaleziono.</h2>

    <?php endif; ?>

    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
