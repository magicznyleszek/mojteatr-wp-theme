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

            $pod_tytul= $mypod->field('tytul');

            $pod_opis= $mypod->display('opis');

            $pod_spektakle= $mypod->field('spektakle');

            $pod_rezyser= $mypod->field('rezyser');
            $has_rezyser= $pod_rezyser != '';

            $pod_scenariusz= $mypod->field('scenariusz');
            $has_scenariusz= $pod_scenariusz != '';

            $pod_czas_trwania= $mypod->field('czas-trwania');
            $pod_data_premiery= $mypod->field('data-premiery');

            setlocale(LC_TIME, 'pl_PL.UTF-8');
            $pretty_date_format = '%d %B %G';
            function pretty_date($date_format, $date_string) {
                return strftime($date_format, strtotime($date_string));
            }
            $data_premiery_pretty = pretty_date($pretty_date_format, $pod_data_premiery);

            $pod_aktorzy= $mypod->field('aktorzy');

            $pod_archiwalne= $mypod->field('archiwalne');

            $pod_zdjecie= $mypod->field('zdjecie');
            $pod_zdjecie_large = wp_get_attachment_image_src(
                $pod_zdjecie['ID'],
                'large'
            );
            $has_zdjecie = $pod_zdjecie_large[0] != '';

            $pod_recenzje= array();
            $pod_recenzja_1_tytul= $mypod->field('recenzja-1-tytul');
            $pod_recenzja_1_url= $mypod->field('recenzja-1-url');
            if ($pod_recenzja_1_tytul != '' && $pod_recenzja_1_url != '') {
               $obj = new stdClass();
               $obj->title = $pod_recenzja_1_tytul;
               $obj->url = $pod_recenzja_1_url;
                array_push($pod_recenzje, $obj);
            }
            $pod_recenzja_2_tytul= $mypod->field('recenzja-2-tytul');
            $pod_recenzja_2_url= $mypod->field('recenzja-2-url');
            if ($pod_recenzja_2_tytul != '' && $pod_recenzja_2_url != '') {
               $obj = new stdClass();
               $obj->title = $pod_recenzja_2_tytul;
               $obj->url = $pod_recenzja_2_url;
                array_push($pod_recenzje, $obj);
            }
            $pod_recenzja_3_tytul= $mypod->field('recenzja-3-tytul');
            $pod_recenzja_3_url= $mypod->field('recenzja-3-url');
            if ($pod_recenzja_3_tytul != '' && $pod_recenzja_3_url != '') {
               $obj = new stdClass();
               $obj->title = $pod_recenzja_3_tytul;
               $obj->url = $pod_recenzja_3_url;
                array_push($pod_recenzje, $obj);
            }
            $pod_recenzja_4_tytul= $mypod->field('recenzja-4-tytul');
            $pod_recenzja_4_url= $mypod->field('recenzja-4-url');
            if ($pod_recenzja_4_tytul != '' && $pod_recenzja_4_url != '') {
               $obj = new stdClass();
               $obj->title = $pod_recenzja_4_tytul;
               $obj->url = $pod_recenzja_4_url;
                array_push($pod_recenzje, $obj);
            }

            $pod_galeria= $mypod->field('galeria');
        ?>

        <article
            id="post-<?php the_ID(); ?>"
            <?php post_class() ?>
        >
            <?php if ($pod_archiwalne == 1): ?>
                <div i-o-section>Archiwalny</div>
            <?php endif; ?>

            <h1 i-o-section="main">
                <a
                    href="<?php echo $permalink; ?>"
                    title="<?php echo $pod_tytul; ?>"
                >
                    <?php echo $pod_tytul; ?>
                </a>
            </h1>

            <!-- photo -->
            <?php if($has_zdjecie): ?>
            <section i-o-section>
                <img
                    i-o-picture
                    src="<?php echo $pod_zdjecie_large[0]; ?>"
                    title="<?php echo $pod_zdjecie['post_title']; ?>"
                    alt="<?php echo $pod_zdjecie['post_name']; ?>"
                >
            </section>
            <?php endif; ?>

            <!-- meta -->
            <section i-o-section="main">
                <table i-o-summary-meta><tbody>
                    <?php if($has_rezyser): ?>
                    <tr>
                        <th i-o-summary-meta-label>Reżyseria:</th>
                        <td><?php echo $pod_rezyser; ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if($has_scenariusz): ?>
                    <tr i-o-summary-meta>
                        <th i-o-summary-meta-label>Scenariusz:</th>
                        <td><?php echo $pod_scenariusz; ?></td>
                    </tr>
                    <?php endif; ?>


                    <?php if($pod_czas_trwania > 0): ?>
                    <tr>
                        <th i-o-summary-meta-label>Czas:</th>
                        <td><?php echo $pod_czas_trwania.'&nbsp;minut'; ?></td>
                    </tr>
                    <?php endif; ?>

                    <tr>
                        <th i-o-summary-meta-label>Premiera:</th>
                        <td><?php echo $data_premiery_pretty; ?></td>
                    </tr>

                    <!-- all aktorzy list -->
                    <?php
                        if(!empty($pod_aktorzy) && is_array($pod_aktorzy)):
                            $all_aktorzy_links = '';
                            $is_first = true;
                            foreach($pod_aktorzy as $pod_aktor) {
                                $imie = get_post_meta($pod_aktor['ID'], 'imie', true);
                                $nazwisko = get_post_meta($pod_aktor['ID'], 'nazwisko', true);
                                $full_name = $imie.'&nbsp;'.$nazwisko;
                                $url = $pod_aktor['guid'];

                                if (!$is_first) {
                                    $all_aktorzy_links .= ', ';
                                } else {
                                    $is_first = false;
                                }

                                $all_aktorzy_links .= '<a href="'.$url.'">'.$full_name.'</a>';
                            }
                    ?>
                    <tr>
                        <th i-o-summary-meta-label>Występują:</th>
                        <td><?php echo $all_aktorzy_links; ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if(!empty($pod_recenzje) && is_array($pod_recenzje)): ?>
                    <!-- reviews -->
                    <tr>
                        <th i-o-summary-meta-label>Recenzje:</th>

                        <td>
                        <?php foreach($pod_recenzje as $pod_recenzja) { ?>
                            <div>
                                <a href="<?php echo $pod_recenzja->url; ?>">
                                    <?php echo $pod_recenzja->title; ?>
                                </a>
                            </div>
                        <?php } ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody></table>
            </section>

            <!-- full description -->
            <section i-o-section="main">
                <?php echo $pod_opis; ?>
            </section>

            <?php if(!empty($pod_galeria) && is_array($pod_galeria)): ?>
            <!-- gallery -->
            <section i-o-section>
                <div class="gallery">
                <?php
                    foreach($pod_galeria as $pod_galeria_zdjecie) {
                        $pod_galeria_zdjecie_large = wp_get_attachment_image_src(
                            $pod_galeria_zdjecie['ID'],
                            'large'
                        );
                        $pod_galeria_zdjecie_med = wp_get_attachment_image_src(
                            $pod_galeria_zdjecie['ID'],
                            'medium'
                        );
                ?>
                    <a
                        i-o-pictureLink
                        href="<?php echo $pod_galeria_zdjecie_large[0]; ?>"
                    >
                        <img
                            src="<?php echo $pod_galeria_zdjecie_med[0]; ?>"
                            title="<?php echo $pod_galeria_zdjecie['post_title']; ?>"
                            alt="<?php echo $pod_galeria_zdjecie['post_name']; ?>"
                        >
                    </a>
                <?php } ?>
                </div>
            </section>
            <?php endif; ?>
        </article>
    <?php endwhile; endif; ?>
</div>

<?php get_sidebar(); ?>

<script type="text/javascript">
    baguetteBox.run('.gallery');
</script>

<?php get_footer(); ?>
