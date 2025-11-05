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
    $template_data = [
        'page_title' => $config->getSetting('ORG_NAME'),
        'logo_image' => $config->getSetting('ORG_LOGO_IMG'),
        'header' => $config->getSetting('ORG_HEADER'),
        'ordering' => ($today >= $config->getSetting('ORG_ORDERING_START') && $today <= $config->getSetting('ORG_ORDERING_END')) ? 1 : 0,
        'start_date' => $config->getSetting('ORG_ORDERING_START'),
        'end_date' => $config->getSetting('ORG_ORDERING_END'),
    ];
    echo $twig->render($my_template, $template_data);
