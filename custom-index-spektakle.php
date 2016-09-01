<?php
/*
Template Name: Custom Index Spektakle
*/
    get_header();

    // get data
    $mypod = pods('spektakl');
    $params = array(
        'title ASC',
        'orderby'=>'archiwalne.meta_value'
    );
    $mypod->find($params);

    setlocale(LC_TIME, 'pl_PL');
    $pretty_date_format = '%d %B %G';
    function pretty_date($date_format, $date_string) {
        return utf8_encode(strftime($date_format, strtotime($date_string)));
    }
?>

    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">
        <h1>Spektakle</h1>

        <?php $prev_archiwalne = null; ?>
        <?php while($mypod->fetch()) : ?>
            <?php
                // set variables
                $permalink= $mypod->field('permalink');
                $pod_tytul= $mypod->field('tytul');

                $pod_rezyser= $mypod->field('rezyser');
                $has_rezyser= $pod_rezyser != '';

                $pod_scenariusz= $mypod->field('scenariusz');
                $has_scenariusz= $pod_scenariusz != '';

                $pod_czas_trwania= $mypod->field('czas-trwania');
                $pod_data_premiery= $mypod->field('data-premiery');
                $data_premiery_pretty = pretty_date($pretty_date_format, $pod_data_premiery);

                $pod_aktorzy= $mypod->field('aktorzy');
                $pod_archiwalne= $mypod->field('archiwalne');
                $pod_zdjecie= $mypod->field('zdjecie');
                $pod_zdjecie_thumb = wp_get_attachment_image_src(
                    $pod_zdjecie['ID'],
                    'thumbnail'
                );
                $has_zdjecie = $pod_zdjecie_thumb[0] != '';
            ?>

            <?php
                // display subtitle of archiwalne group
                if ($prev_archiwalne == null || $prev_archiwalne != 0 && $pod_archiwalne == 0) {
                    echo "<h2>Aktualne</h2>";
                } elseif ($prev_archiwalne == null || $prev_archiwalne != 1 && $pod_archiwalne == 1) {
                    echo "<h2>Archiwalne</h2>";
                }
            ?>

            <article class="<?php if($has_zdjecie): ?>has-photo<?php endif; ?>">
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

                <!-- title -->
                <h1>
                    <a href="<?php echo $permalink; ?>">
                        <?php echo $pod_tytul; ?>
                        <?php echo $pod_nazwisko; ?>
                    </a>
                </h1>

                <!-- meta -->
                <ul>
                    <?php if($has_rezyser): ?>
                        <li>
                            <strong>Reżyser:</strong>
                            <?php echo $pod_rezyser; ?>
                        </li>
                    <?php endif; ?>
                    <?php if($has_scenariusz): ?>
                        <li>
                            <strong>Scenariusz:</strong>
                            <?php echo $pod_scenariusz; ?>
                        </li>
                    <?php endif; ?>
                    <?php if($pod_czas_trwania > 0): ?>
                    <li>
                        <strong>Czas trwania:</strong>
                        <?php echo $pod_czas_trwania; ?>
                        <span>minut</span>
                    </li>
                    <?php endif; ?>
                    <li>
                        <strong>Data premiery:</strong>
                        <?php echo $data_premiery_pretty; ?>
                    </li>
                </ul>

                <!-- all actors -->
                <?php if(!empty($pod_aktorzy) && is_array($pod_aktorzy)): ?>
                    <strong>Występują:</strong>
                    <ul>
                    <?php
                        foreach($pod_aktorzy as $pod_aktor) {
                            $imie = get_post_meta($pod_aktor['ID'], 'imie', true);
                            $nazwisko = get_post_meta($pod_aktor['ID'], 'nazwisko', true);
                    ?>
                        <li>
                            <a href="<?php echo $pod_aktor['guid']; ?>">
                                <?php echo $imie; ?>
                                <?php echo $nazwisko; ?>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                <?php endif; ?>
            </article>

            <br><br>

            <?php
                // keep archiwalne value for if check
                $prev_archiwalne = $pod_archiwalne;
            ?>
        <?php endwhile; ?>
    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
