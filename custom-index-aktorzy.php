<?php
/*
Template Name: Custom Index Aktorzy
*/
    get_header();

    // get data
    $mypod = pods('aktor');
    $mypod->find('nazwisko ASC');
?>

    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">
        <h1>Aktorzy</h1>

        <?php while($mypod->fetch()) : ?>

            <?php
                // set variables
                $permalink= $mypod->field('permalink');

                $pod_imie= $mypod->field('imie');
                $pod_nazwisko= $mypod->field('nazwisko');
                $full_name = $pod_imie . ' ' . $pod_nazwisko;

                $pod_spektakle= $mypod->field('spektakle');

                $pod_zdjecie= $mypod->field('zdjecie');
                $pod_zdjecie_thumb = wp_get_attachment_image_src(
                    $pod_zdjecie['ID'],
                    'thumbnail'
                );
                $has_zdjecie = $pod_zdjecie_thumb[0] != '';
            ?>
            <article>
                <!-- photo -->
                <?php if($has_zdjecie): ?>
                <a href="<?php echo $permalink; ?>">
                    <img
                        src="<?php echo $pod_zdjecie_thumb[0]; ?>"
                        title="<?php echo $pod_zdjecie['post_title']; ?>"
                        alt="<?php echo $pod_zdjecie['post_name']; ?>"
                    >
                </a>
                <?php endif; ?>

                <!-- full name -->
                <h1>
                    <a
                        href="<?php echo $permalink; ?>"
                        title="<?php echo $full_name; ?>"
                    >
                        <?php echo $full_name; ?>
                    </a>
                </h1>

                <!-- all spectacles -->
                <?php if(!empty($pod_spektakle) && is_array($pod_spektakle)): ?>
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
        <?php endwhile; ?>
    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
