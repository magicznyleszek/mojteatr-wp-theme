<?php
    setlocale(LC_TIME, 'pl_PL.UTF-8');
    $pretty_date_format = '%d %b %G %H:%M';
    function pretty_date($date_format, $date_string) {
        return strftime($date_format, strtotime($date_string));
    }

    $data_poczatek_miesiaca = date('Y-m-01');
    $termin_pods = pods('termin', array(
        'orderby'=>'data-wystawienia ASC',
        'where'=> 'DATE(data-wystawienia.meta_value) >= "'.$data_poczatek_miesiaca.'"',
        'limit'=> -1 // all
    ));
?>

<script type='text/javascript'>
window.mojteatr = {};
<?php
    $terminy_array = [];
    if ($termin_pods->total() > 0) {
        while ( $termin_pods->fetch() ) {
            $data_wystawienia = $termin_pods->field('data-wystawienia');
            $data_wystawienia_pretty = pretty_date($pretty_date_format, $data_wystawienia);

            $komentarz = $termin_pods->field('komentarz');

            $spektakl = $termin_pods->field('spektakl');
            $termin_title = null;
            $termin_url = null;
            if ($spektakl) {
                $spektakl_pod_id = $spektakl['pod_item_id'];
                $spektakl_pod = pods('spektakl', $spektakl_pod_id);
                $termin_title = $spektakl_pod->display('tytul');
                $termin_url = get_permalink($spektakl_pod_id);
            } else {
                // non standard spektakl
                $termin_title = $termin_pods->field('nie_spektakl_tytul');
                $termin_url = $termin_pods->field('nie_spektakl_url');
            }

            $terminy_array[] = [
                'date' => $data_wystawienia,
                'datePretty' => $data_wystawienia_pretty,
                'comment' => $komentarz,
                'title' => $termin_title,
                'url' => $termin_url,
            ];
        }
    }
?>
window.mojteatr.terminy = <?php echo json_encode($terminy_array) ?>;
</script>

<section i-o-section="main bordered" id="terminy-clndr">
    Ładowanie kalendarza…
</section>
