<?php get_header(); ?>

    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">

        <?php if (have_posts()) : ?>

             <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

             <?php /* If this is a category archive */ if (is_category()) { ?>
                <!--<h2>Archive for the &bdquo;<?php single_cat_title(); ?>&rdquo; Category</h2>-->

            <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                <h2>Posty otagowane jako &bdquo;<?php single_tag_title(); ?>&rdquo;</h2>

            <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                <h2>Archive for <?php the_time('F jS, Y'); ?></h2>

            <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                <h2>Archive for <?php the_time('F, Y'); ?></h2>

            <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                <h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>

            <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                <h2 class="pagetitle">Author Archive</h2>

            <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                <h2 class="pagetitle">Blog Archives</h2>

            <?php } ?>

            <?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

            <?php while (have_posts()) : the_post(); ?>

                <article <?php post_class() ?>>

                    <h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

                    <div class="entry">
                        <?php the_content(); ?>
                    </div>

                    <div class="postmetadata"><?php the_tags("Tagi: "," &middot; "," &nbsp; "); ?> <!-- Dodane <?php echo str_replace(array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"), array("stycznia", "lutego", "marca", "kwietnia", "maja", "czerwca", "lipca", "sierpnia", "września", "października", "listopada", "grudnia"), get_the_date()); ?> o <?php the_time() ?> --></div>

                </article>

            <?php endwhile; ?>

            <?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

    <?php else : ?>

        <h2>Brak elementów do wyświetlenia.</h2>

    <?php endif; ?>

    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
