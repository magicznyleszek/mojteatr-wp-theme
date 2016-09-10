<?php
/*
Template Name: Custom Index Terminy
*/
    get_header();

    // get data
    $mypod = pods('termin');
    $data_dzis = date('Y-m-d');
    $params = array(
        'data-wystawienia DESC',
        'where'=> 'DATE(data-wystawienia.meta_value) >= "'.$data_dzis.'"'
    );
    $mypod->find($params);

    setlocale(LC_TIME, 'pl_PL.UTF-8');
    $pretty_date_format = '%d %b %G %H:%M';
    function pretty_date($date_format, $date_string) {
        return strftime($date_format, strtotime($date_string));
    }
?>

    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">
        <!-- <h1 i-o-section="main">Aktualne terminy spektakli</h1> -->

        <table i-o-termins>
            <caption>Aktualne terminy spektakli</caption>

            <thead>
                <tr>
                    <td i-o-termins-column="date">Data</td>
                    <td i-o-termins-column="content">Spektakl</td>
                </tr>
            </thead>

            <tbody>
                <?php while($mypod->fetch()) : ?>
                    <?php
                        // set variables
                        $pod_data_wystawienia= $mypod->field('data-wystawienia');
                        $data_wystawienia_pretty = pretty_date($pretty_date_format, $pod_data_wystawienia);

                        $pod_komentarz= $mypod->field('komentarz');

                        // find spektakl data and it's tytul value
                        $pod_spektakl= $mypod->field('spektakl');
                        $spektakl_pod_id = $pod_spektakl['pod_item_id'];
                        $spektakl_pod = pods('spektakl', $spektakl_pod_id);
                        $spektakl_tytul = $spektakl_pod->display('tytul');
                        $spektakl_permalink = get_permalink($spektakl_pod_id);
                    ?>
                    <tr>
                        <td i-o-termins-column="date">
                            <?php echo $data_wystawienia_pretty; ?>
                        </td>
                        <td i-o-termins-column="content">
                            <a href="<?php echo $spektakl_permalink ?>">
                                <?php echo $spektakl_tytul; ?>
                            </a>
                            <?php if ($pod_komentarz != ''): ?>
                                <span i-o-termins-comment>
                                    <?php echo $pod_komentarz; ?>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
