<?php get_header(); ?>

<?php include(TEMPLATEPATH . '/menu.php' ); ?>

<div id="center">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php
            // get the current slug
            global $post;
            // get pods object
            $mypod = pods( $post->post_type, $post->ID );
            $permalink= $mypod->field('permalink');

            $pod_imie= $mypod->field('imie');
            $pod_nazwisko= $mypod->field('nazwisko');
            $full_name = $pod_imie . ' ' . $pod_nazwisko;

            $pod_opis= $mypod->display('opis');

            $pod_spektakle= $mypod->field('spektakle');

            $pod_zdjecie= $mypod->field('zdjecie');
            $pod_zdjecie_large = wp_get_attachment_image_src(
                $pod_zdjecie['ID'],
                'large'
            );
            $has_zdjecie = $pod_zdjecie_large[0] != '';
        ?>

        <article
            id="post-<?php the_ID(); ?>"
            <?php post_class() ?>
        >
            <h1>
                <a
                    href="<?php echo $permalink; ?>"
                    title="<?php echo $full_name; ?>"
                >
                    <?php echo $full_name; ?>
                </a>
            </h1>

            <!-- photo -->
            <?php if($has_zdjecie): ?>
            <img
                src="<?php echo $pod_zdjecie_large[0]; ?>"
                title="<?php echo $pod_zdjecie['post_title']; ?>"
                alt="<?php echo $pod_zdjecie['post_name']; ?>"
            >
            <?php endif; ?>

            <!-- full description -->
            <?php echo $pod_opis; ?>

            <!-- all spectacles -->
            <?php if(!empty($pod_spektakle) && is_array($pod_spektakle)): ?>
                <h2>Spektakle:</h2>
                <?php foreach($pod_spektakle as $pod_spektakl) { ?>
                    <?php
                        $tytul = get_post_meta($pod_spektakl['ID'], 'tytul', true);
                    ?>
                    <a href="<?php echo $pod_spektakl['guid']; ?>">
                        <?php echo $tytul; ?>
                    </a>
                <?php } ?>
            <?php endif; ?>

        </article>

    <?php endwhile; endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
