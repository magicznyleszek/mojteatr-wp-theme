<?php get_header(); ?>

    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">
        <?php if (have_posts()) : ?>
             <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

             <?php /* If this is a category archive */ if (is_category()) { ?>
                <!--<h1 i-o-section>Archive for the &bdquo;<?php single_cat_title(); ?>&rdquo; Category</h1>-->

            <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                <h1 i-o-section>Posty otagowane jako &bdquo;<?php single_tag_title(); ?>&rdquo;</h1>

            <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                <h1 i-o-section>Archiwum: <?php the_time('F jS, Y'); ?></h1>

            <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                <h1 i-o-section>Archiwum: <?php the_time('F, Y'); ?></h1>

            <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                <h1 i-o-section>Archiwum: <?php the_time('Y'); ?></h1>

            <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                <h1 i-o-section>Archiwum autora</h1>

            <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                <h1 i-o-section>Archiwum</h1>

            <?php } ?>

            <?php include (TEMPLATEPATH . '/partials/nav_pagination.php' ); ?>

            <?php while (have_posts()) : the_post(); ?>
                <article i-o-section <?php post_class() ?>>
                    <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>

                    <div>
                        <?php the_excerpt(); ?>
                    </div>

                    <small><?php the_tags("Tagi: "," &middot; "," &nbsp; "); ?></small>
                </article>
            <?php endwhile; ?>

            <?php include (TEMPLATEPATH . '/partials/nav_pagination.php' ); ?>

    <?php else : ?>

        <h1 i-o-section>Brak elementów do wyświetlenia.</h1>

    <?php endif; ?>

    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
