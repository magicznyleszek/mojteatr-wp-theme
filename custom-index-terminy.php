<?php
/*
Template Name: Custom Index Terminy
*/
    get_header();

    // get data
    $mypod = pods('termin');
    $data_dzis = date('Y-m-d H:i:s');
    $params = array(
        'orderby' => 'data-wystawienia ASC',
        'limit' => -1
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
            <caption>Repertuar</caption>

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

                        // check if its a standard spektakl
                        if ($pod_spektakl) {
                            $spektakl_pod_id = $pod_spektakl['pod_item_id'];
                            $spektakl_pod = pods('spektakl', $spektakl_pod_id);
                            $termin_title = $spektakl_pod->display('tytul');
                            $termin_url = get_permalink($spektakl_pod_id);
                        } else {
                            $termin_title = $mypod->field('nie_spektakl_tytul');
                            $termin_url = $mypod->field('nie_spektakl_url');
                        }

                        $timestamp_termin = strtotime($pod_data_wystawienia);
                        $timestamp_dzis = strtotime($data_dzis);
                    ?>
                    <?php if ($timestamp_termin >= $timestamp_dzis): ?>
                    <tr>
                        <td i-o-termins-column="date">
                            <?php echo $data_wystawienia_pretty; ?>
                        </td>
                        <td i-o-termins-column="content">
                            <a href="<?php echo $termin_url ?>">
                                <?php echo $termin_title; ?>
                            </a>
                            <?php if ($pod_komentarz != ''): ?>
                                <span i-o-termins-comment>
                                    <?php echo $pod_komentarz; ?>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
