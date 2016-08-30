<?php

    // Add RSS links to <head> section
    add_theme_support('automatic-feed-links');

    // Load jQuery
    if (!function_exists('core_mods')) {
        function core_mods() {
            wp_deregister_script('jquery');
            wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"), false);
            wp_enqueue_script('jquery');
        }
        core_mods();
    }

    // Clean up the <head>
    function removeHeadLinks() {
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

    if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'name' => 'Sidebar Widgets',
            'id'   => 'sidebar-widgets',
            'description'   => 'These are widgets for the sidebar.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        ));
    }

    add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.

    // makes termin title from data-wystawienia and spektakl->tytul
    function save_termin_title($data, $postarr) {
        $termin_slug = 'termin';
        $spektakl_slug = 'spektakl';
        $data_wystawienia_field_name = 'pods_meta_data-wystawienia';
        $spektakl_field_name = 'pods_meta_spektakl';
        $tytul_field_name = 'tytul';

        if ($data['post_type'] == $termin_slug) {
            // find spektakl data and it's tytul value
            $spektakl_pod_id = $postarr[$spektakl_field_name];
            $spektakl_pod = pods($spektakl_slug, $spektakl_pod_id);
            $spektakl_tytul = $spektakl_pod->display($tytul_field_name);

            $data_wystawienia = $postarr[$data_wystawienia_field_name];

            $data['post_title'] = $spektakl_tytul.' @ '.$data_wystawienia;
        }
        return $data;
    }

    // makes aktor title from imie and nazwisko
    function save_aktor_title($data, $postarr) {
        $aktor_slug = 'aktor';
        $imie_field_name = 'pods_meta_imie';
        $nazwisko_field_name = 'pods_meta_nazwisko';

        if ($data['post_type'] == $aktor_slug) {
            $imie = $postarr[$imie_field_name];
            $nazwisko = $postarr[$nazwisko_field_name];

            $data['post_title'] = $imie.' '.$nazwisko;
        }
        return $data;
    }

    // makes spektakl title from tytul
    function save_aktor_title($data, $postarr) {
        $spektakl_slug = 'spektakl';
        $tytul_field_name = 'pods_meta_tytul';

        if ($data['post_type'] == $spektakl_slug) {
            $data['post_title'] = $postarr[$tytul_field_name];
        }
        return $data;
    }
    add_filter('wp_insert_post_data', 'save_termin_title', '99', 2);
    add_filter('wp_insert_post_data', 'save_aktor_title', '99', 2);
?>
