<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

<?php
    /** @var $oHead flyingpiranhas\mvc\views\head\interfaces\HeadInterface */
    $oHead = $this->oHead;
?>

<head>
    <meta charset="utf-8">

    <meta name="keywords" content="My keywords"/>
    <meta name="description" content="My description"/>
    <meta property="og:type" content="website"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="author" content="Bruno Skvorc <bruno@skvorc.me>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-57x57-precomposed.png">
    <link rel="shortcut icon" href="/favicon.png">

    <?php $oHead->renderTitle(); ?>

    <?php
    $oHead
        ->appendStylesheet('/assets/css/bootstrap.css')
        ->appendStylesheet('/assets/css/bootstrap-stickyFooter.css')
        ->appendStylesheet('/assets/css/bootstrap-responsive.css')
        ->appendScript('/assets/js/vendor/bootstrap.min.js')
        ->appendScript('/assets/js/plugins.js')
        ->appendScript('/assets/js/main.js')
        ->renderStylesheet();



    ?>

    <script src="assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>

<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
    improve your experience.</p>
<![endif]-->


<?php $this->renderView(); ?>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

<?php $oHead->renderScript(); ?>

<script>
    var _gaq = [
        ['_setAccount', 'UA-XXXXX-X'],
        ['_trackPageview']
    ];
    (function (d, t) {
        var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
        g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g, s)
    }(document, 'script'));
</script>
</body>

</html>
