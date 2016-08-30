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

    // automagically rewrite title for 'termin' pod
    function admin_footer_hook(){
        ?>
        <script type="text/javascript">
            if(jQuery('#post_type').val() === 'termin') {
                // get the title and make it appear disabled
                // can't disable via attribute, as it makes PHP omit the value
                jQTitle = jQuery('#title');
                jQTitle.css({'pointer-events': 'none', 'color': 'silver'});
                jQTitle.blur();

                // sets the title to the combined value
                var updateTitle = function () {
                    var dateField = jQuery('#pods-form-ui-pods-meta-data-wystawienia').val();
                    var titleField = jQuery('#pods-form-ui-pods-meta-spektakl option:selected').text();
                    jQTitle.val(dateField + ' -- ' + titleField);
                }

                // show message on the first go?
                titleVal = jQTitle.val();
                if (titleVal == '') {
                    // jQTitle.val('Tytuł generuje się automatycznie');
                    updateTitle();
                };

                // add an additional CSS class 'pods-auto-title'
                // in Pods Admin for all Pods Fields concerned with updateTitle:
                // - data-wystawienia
                // - spektakl
                jQuery('.pods-auto-title').change(updateTitle);
            }
        </script>
        <?php
    }
    add_action( 'admin_footer-post.php', 'admin_footer_hook' );
?>
