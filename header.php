<!DOCTYPE html>

<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <?php if (is_search()) { ?>
    <meta name="robots" content="noindex, nofollow" />
    <?php } ?>

    <title>
           <?php
              if (function_exists('is_tag') && is_tag()) {
                 single_tag_title("Archiwum taga: &quot;"); echo '&quot; - '; }
              elseif (is_archive()) {
                 wp_title(''); echo ' Archiwum - '; }
              elseif (is_search()) {
                 echo 'Wyszukiwanie: &quot;'.wp_specialchars($s).'&quot; - '; }
              elseif (!(is_404()) && (is_single()) || (is_page())) {
                 wp_title(''); echo ' - '; }
              elseif (is_404()) {
                 echo 'Nie znaleziono - '; }
              if (is_home()) {
                 bloginfo('name'); echo ' - '; bloginfo('description'); }
              else {
                  bloginfo('name'); }
              if ($paged>1) {
                 echo ' - page '. $paged; }
           ?>
    </title>

    <meta name="title" content="<?php
              if (function_exists('is_tag') && is_tag()) {
                 single_tag_title("Archiwum taga: &quot;"); echo '&quot; - '; }
              elseif (is_archive()) {
                 wp_title(''); echo ' Archiwum - '; }
              elseif (is_search()) {
                 echo 'Wyszukiwanie: &quot;'.wp_specialchars($s).'&quot; - '; }
              elseif (!(is_404()) && (is_single()) || (is_page())) {
                 wp_title(''); echo ' - '; }
              elseif (is_404()) {
                 echo 'Nie znaleziono - '; }
              if (is_home()) {
                 bloginfo('name'); echo ' - '; bloginfo('description'); }
              else {
                  bloginfo('name'); }
              if ($paged>1) {
                 echo ' - page '. $paged; }
           ?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <meta name="google-site-verification" content="">

    <meta name="author" content="Mój Teatr">
    <meta name="Copyright" content="Copyright Mój Teatr 2016. All Rights Reserved.">

    <!-- Dublin Core Metadata : http://dublincore.org/ -->
    <meta name="DC.title" content="Mój teatr">
    <meta name="DC.subject" content="Theatre from Poznań, Poland.">
    <meta name="DC.creator" content="Leszek Pietrzak">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css?v=4">

    <link rel="stylesheet" href="http://mojteatr.pl/webfontkit-stylesheet.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/libs/baguetteBox.min.css">

    <!-- all our JS is at the bottom of the page, except for Modernizr. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://ewejsciowki.pl/embedded_static/embedded.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/libs/baguetteBox.min.js"></script>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <div id="page-wrap">
        <header id="header">
            <a i-o-logo href="<?php echo get_option('home'); ?>/">
                <?php include(TEMPLATEPATH . '/symbols/moj-teatr-logo.svg' ); ?>
            </a>
        </header>
