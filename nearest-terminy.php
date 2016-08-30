<?php
    $NEAREST_TERMINY_ENABLED = false;

    // get data
    $mypod = pods('termin');
    $data_dzis = date('Y-m-d');
    $params = array(
        'data-wystawienia DESC',
        'where'=> 'DATE(data-wystawienia.meta_value) >= "'.$data_dzis.'"',
        'limit'=> 2
    );
    $mypod->find($params);

    $date_formatter = new IntlDateFormatter('pl_PL', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
    $date_formatter->setPattern('d MMM y HH:mm');
?>

<?php
    // display only if there is something to show
    if ($mypod->total() > 0 && $NEAREST_TERMINY_ENABLED):
?>
    <section>
        <h1>Najbliższe terminy spektakli</h1>

        <table>
            <thead>
                <tr>
                    <td>Data</td>
                    <td>Spektakl</td>
                </tr>
            </thead>
            <tbody>
                <?php while($mypod->fetch()) : ?>
                    <?php
                        // set variables
                        $pod_data_wystawienia= $mypod->field('data-wystawienia');
                        $data_wystawienia_pretty = $date_formatter->format(date_create($pod_data_wystawienia));

                        $pod_komentarz= $mypod->field('komentarz');

                        // find spektakl data and it's tytul value
                        $pod_spektakl= $mypod->field('spektakl');
                        $spektakl_pod_id = $pod_spektakl['pod_item_id'];
                        $spektakl_pod = pods('spektakl', $spektakl_pod_id);
                        $spektakl_tytul = $spektakl_pod->display('tytul');
                        $spektakl_permalink = get_permalink($spektakl_pod_id);
                    ?>
                    <tr>
                        <td>
                            <?php echo $data_wystawienia_pretty; ?>
                        </td>
                        <td>
                            <a href="<?php echo $spektakl_permalink ?>">
                                <?php echo $spektakl_tytul; ?>
                            </a>
                            <?php if ($pod_komentarz != ''): ?>
                                <small><?php echo $pod_komentarz; ?></small>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
<?php endif; ?>
