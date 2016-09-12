<?php
/*
Template Name: Custom Index Aktorzy
*/
    get_header();

    // get data
    $mypod = pods('aktor');
    $params = array(
        'orderby' => array(
            'wyrozniony DESC',
            'nazwisko ASC'
        )
    );
    $mypod->find($params);
?>
    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">
        <!-- <h1 i-o-section="main">Aktorzy</h1> -->

        <?php while($mypod->fetch()) : ?>
            <?php
                // set variables
                $permalink = $mypod->field('permalink');
                $wyrozniony = $mypod->field('wyrozniony');

                $pod_imie = $mypod->field('imie');
                $pod_nazwisko = $mypod->field('nazwisko');
                $full_name = $pod_imie . ' ' . $pod_nazwisko;

                $full_name_abbr = $pod_imie[0].$pod_nazwisko[0];

                $pod_spektakle = $mypod->field('spektakle');

                $pod_zdjecie = $mypod->field('zdjecie');
                $pod_zdjecie_thumb = wp_get_attachment_image_src(
                    $pod_zdjecie['ID'],
                    'thumbnail'
                );
                $has_zdjecie = $pod_zdjecie_thumb[0] != '';
            ?>
            <article i-o-summary i-o-section="main">
                <!-- Aktor wyrozniony: <?php echo $wyrozniony; ?> -->
                <!-- photo -->
                <a href="<?php echo $permalink; ?>" i-o-summary-photo>
                    <?php if($has_zdjecie): ?>
                    <img
                        src="<?php echo $pod_zdjecie_thumb[0]; ?>"
                        title="<?php echo $pod_zdjecie['post_title']; ?>"
                        alt="<?php echo $pod_zdjecie['post_name']; ?>"
                    >
                    <?php else: ?>
                    <span><?php echo $full_name_abbr; ?></span>
                    <?php endif; ?>
                </a>

                <!-- full name -->
                <div i-o-summary-title>
                    <a
                        href="<?php echo $permalink; ?>"
                        title="<?php echo $full_name; ?>"
                    >
                        <?php echo $full_name; ?>
                    </a>
                </div>

                <?php if(!empty($pod_spektakle) && is_array($pod_spektakle)): ?>
                <!-- all spektakle list -->
                <section i-o-section="main">
                    <div i-o-summary-meta-label>Spektakle:</div>
                    <?php
                        foreach($pod_spektakle as $pod_spektakl) {
                            $spektakl_tytul = get_post_meta($pod_spektakl['ID'], 'tytul', true);
                            $spektakl_url = $pod_spektakl['guid'];
                    ?>
                        <div>
                            <a href="<?php echo $spektakl_url; ?>">
                                <?php echo $spektakl_tytul; ?>
                            </a>
                        </div>
                    <?php } ?>
                </section>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
