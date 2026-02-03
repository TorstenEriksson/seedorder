<?php

    namespace sta;

    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    require __DIR__ . '/vendor/autoload.php';

    $config = new Config();
    $today = date("Y-m-d");

    // Setup twig
    $loader = new FilesystemLoader(__DIR__ . '/templates');
    $twig = new Environment($loader);

    $my_template = 'seedorder.html.twig';
    $ordering_now = ($today >= $config->getSetting('ORG_ORDERING_START') && $today <= $config->getSetting('ORG_ORDERING_GRACE_DATE')) ? 1 : 0;
    if ($ordering_now == 0) {
        $ordering_now = ($today >= $config->getSetting('ORG_SECOND_START') && $today <= $config->getSetting('ORG_SECOND_END')) ? 2 : 0;
    }
    $template_data = [
        'page_title' => $config->getSetting('ORG_NAME'),
        'logo_image' => $config->getSetting('ORG_LOGO_IMG'),
        'header' => $config->getSetting('ORG_HEADER'),
        'ordering' => $ordering_now,
        'start_date' => $config->getSetting('ORG_ORDERING_START'),
        'end_date' => $config->getSetting('ORG_ORDERING_END'),
        'end_grace' => $config->getSetting('ORG_ORDERING_GRACE_DATE'),
        'second_start' => $config->getSetting('ORG_SECOND_START'),
        'second_end' => $config->getSetting('ORG_SECOND_END'),
    ];
    echo $twig->render($my_template, $template_data);
