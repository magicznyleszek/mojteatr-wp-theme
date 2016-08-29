<?php
/*
Template Name: Custom Index Terminy
*/
    get_header();
?>

    <?php include(TEMPLATEPATH . '/menu.php' ); ?>

    <div id="center">
        <h1>Terminy</h1>

        <?php
            // get data
            $mypod = pods('termin');
            $params = array(
                'data-wystawienia DESC'
            );
            $mypod->find($params);
        ?>

        <table>
            <thead>
                <tr>
                    <td>data</td>
                    <td>spektakl</td>
                </tr>
            </thead>
            <tbody>
                <?php while($mypod->fetch()) : ?>
                    <?php
                        // set variables
                        $pod_data_wystawienia= $mypod->field('data-wystawienia');
                        $pod_spektakl= $mypod->field('spektakl');
                        $pod_komentarz= $mypod->field('komentarz');
                    ?>
                    <tr>
                        <td>
                            <?php echo $pod_data_wystawienia; ?>
                        </td>
                        <td>
                            <?php echo $pod_spektakl; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
