<?php

    namespace sta;

    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    require __DIR__ . '/vendor/autoload.php';

    $config = new Config();

    // Setup twig
    $loader = new FilesystemLoader(__DIR__ . '/templates');
    $twig = new Environment($loader);

    $my_template = 'seedorder.html.twig';
    $template_data = [
        'page_title' => $config->getSetting('ORG_NAME'),
        'logo_image' => $config->getSetting('ORG_LOGO_IMG'),
        'header' => $config->getSetting('ORG_HEADER'),
    ];
    echo $twig->render($my_template, $template_data);
