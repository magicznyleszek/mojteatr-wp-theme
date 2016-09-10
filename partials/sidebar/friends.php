<?php
    $menu_id = '7';
    $has_menu = false;

    $menu = wp_get_nav_menu_object($menu_id);
    if ($menu) {
        $has_menu = true;
        $menu_items = wp_get_nav_menu_items($menu);
    }
?>

<div i-o-section>
    <h4>Przyjaciele</h4>
    <?php
        if ($has_menu) {
            foreach ((array) $menu_items as $key => $menu_item) {
                $title = $menu_item->title;
                $url = $menu_item->url;
                echo "<a i-o-button href=\"".$url."\">".$title."</a>\n";
            }

        }
    ?>
</div>

<div i-o-section>
    <a i-o-button="double" href="<?php echo get_page_link(918); ?>">Partnerzy</a>
</div>
