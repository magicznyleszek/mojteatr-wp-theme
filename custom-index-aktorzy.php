<?php
/*
Template Name: Custom Index Aktorzy
*/
    get_header();

    // get data
    $mypod = pods('aktor');
    $params = array(
        'nazwisko ASC',
        'orderby'=>array('wyrozniony.meta_value' => 'DESC', 'nazwisko' => 'ASC')
    );
    $mypod->find($params);
?>
    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">
        <h1 i-o-section="main">Aktorzy</h1>

        <?php while($mypod->fetch()) : ?>
            <?php
                // set variables
                $permalink= $mypod->field('permalink');

                $pod_imie= $mypod->field('imie');
                $pod_nazwisko= $mypod->field('nazwisko');
                $full_name = $pod_imie . ' ' . $pod_nazwisko;

                $full_name_abbr = $pod_imie[0].$pod_nazwisko[0];

                $pod_spektakle= $mypod->field('spektakle');

                $pod_zdjecie= $mypod->field('zdjecie');
                $pod_zdjecie_thumb = wp_get_attachment_image_src(
                    $pod_zdjecie['ID'],
                    'thumbnail'
                );
                $has_zdjecie = $pod_zdjecie_thumb[0] != '';
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

                <table i-o-summary-meta><tbody>
                    <!-- all spektakle list -->
                    <?php
                        if(!empty($pod_spektakle) && is_array($pod_spektakle)):
                            $all_spektakle_links = '';
                            $is_first = true;
                            foreach($pod_spektakle as $pod_spektakl) {
                                $tytul = get_post_meta($pod_spektakl['ID'], 'tytul', true);
                                $url = $pod_aktor['guid'];

                                if (!$is_first) {
                                    $all_spektakle_links .= ', ';
                                } else {
                                    $is_first = false;
                                }

                                $all_spektakle_links .= '<a href="'.$url.'">'.$tytul.'</a>';
                            }
                    ?>
                    <tr>
                        <th>Spektakle:</th>
                        <td><?php echo $all_spektakle_links; ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody></table>
            </article>
        <?php endwhile; ?>
    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
