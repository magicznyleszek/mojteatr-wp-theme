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

    setlocale(LC_TIME, 'pl_PL.UTF-8');
    $pretty_date_format = '%d %B %G';
    function pretty_date($date_format, $date_string) {
        return strftime($date_format, strtotime($date_string));
    }
?>

    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">
        <!-- <h1>Spektakle</h1> -->

        <?php $prev_archiwalne = null; ?>
        <?php while($mypod->fetch()) : ?>
            <?php
                // set variables
                $permalink= $mypod->field('permalink');
                $pod_tytul= $mypod->field('tytul');

                $tytul_words = explode(' ', $pod_tytul);
                $tytul_abbr = '';
                $count = 0;
                foreach ($tytul_words as $word) {
                    if ($count < 3) {
                        $tytul_abbr .= $word[0];
                    }
                    ++$count;
                }

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
                    echo "<h2 i-o-headerBordered>Aktualne</h2>";
                } elseif ($prev_archiwalne == null || $prev_archiwalne != 1 && $pod_archiwalne == 1) {
                    echo "<h2 i-o-headerBordered>Archiwalne</h2>";
                }
            ?>

            <article i-o-summary i-o-section="main">
                <!-- photo -->
                <a href="<?php echo $permalink; ?>" i-o-summary-photo>
                    <?php if($has_zdjecie): ?>
                    <img
                        src="<?php echo $pod_zdjecie_thumb[0]; ?>"
                        title="<?php echo $pod_zdjecie['post_title']; ?>"
                        alt="<?php echo $pod_zdjecie['post_name']; ?>"
                    >
                    <?php else: ?>
                    <span><?php echo $tytul_abbr; ?></span>
                    <?php endif; ?>
                </a>

                <!-- title -->
                <div i-o-summary-title>
                    <a href="<?php echo $permalink; ?>">
                        <?php echo $pod_tytul; ?>
                    </a>
                </div>

                <!-- meta -->
                <table i-o-summary-meta><tbody>
                    <?php if($has_rezyser): ?>
                    <tr>
                        <th>Reżyseria:</th>
                        <td><?php echo $pod_rezyser; ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if($has_scenariusz): ?>
                    <tr i-o-summary-meta>
                        <th>Scenariusz:</th>
                        <td><?php echo $pod_scenariusz; ?></td>
                    </tr>
                    <?php endif; ?>


                    <?php if($pod_czas_trwania > 0): ?>
                    <tr>
                        <th>Czas:</th>
                        <td><?php echo $pod_czas_trwania.'&nbsp;minut'; ?></td>
                    </tr>
                    <?php endif; ?>

                    <tr>
                        <th>Premiera:</th>
                        <td><?php echo $data_premiery_pretty; ?></td>
                    </tr>

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
                        <th>Występują:</th>
                        <td><?php echo $all_aktorzy_links; ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody></table>
            </article>

            <?php
                // keep archiwalne value for if check
                $prev_archiwalne = $pod_archiwalne;
            ?>
        <?php endwhile; ?>
    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
