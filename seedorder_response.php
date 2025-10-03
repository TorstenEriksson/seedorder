<?php

    namespace sta;

    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    require __DIR__ . '/vendor/autoload.php';

    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        die();
    }
    $input = $_POST;
    $last_val_col = 108;
    $full_name = $input["Namn"];
    $fname = explode(" ", $full_name);
    $fname = $fname[0];
    $member_nr = $input["Medlemsnummer"];

    $today = date("Ymd");
    $path = realpath("../seedorders");
    $filename = $path . "/fro" . $today . ".sod";
    $seedorder = [];
    $config = new Config();
    $email = new Email($config);

    // Setup twig
    $loader = new FilesystemLoader(__DIR__ . '/templates');
    $twig = new Environment($loader);

    $page_title = $config->getSetting('ORG_NAME');

    // Assemble input data into a string, formatted according to downstream requirements
    $msg = "Namn=" . $input["Namn"] .
        "&Gata=" . $input["Gata"] .
        "&Postnr=" . $input["Postnr"] .
        "&Ort=" . $input["Ort"] .
        "&Telefon=" . $input["Telefon"] .
        "&Epost=" . $input["Epost"] .
        "&Medlemsnummer=" . $input["Medlemsnummer"] .
        "&Fyll_upp=" . $input["Fyll_upp"] .
        "&Auto_fyll=" . $input["Auto_fyll"];
    for ($i = 1; $i <= $last_val_col; $i++) {
        $msg .= "&Val+$i=" . $input["Val_$i"];
        if ($input["Val_$i"]) {
            $seedorder[] = $input["Val_$i"];
        }
    }
    $msg = str_replace(' ', '+', $msg);
    if ($config->getSetting('CONVERT_TO_LATIN1')) {
        $msg = iconv('utf-8', 'iso-8859-1', $msg); // *** Double check if this is necessary ***
    }

    // Save a seed order in today's file (outside webroot)
    if (($full_name) && ($member_nr) && (count($seedorder) > 0)) {
        if (!$file = fopen($filename, "a")) {
            die("Unable to open file \"$filename\"");
        }
        fwrite($file, $msg . "\n");
        fclose($file);

        // Send an email response
        $my_template = 'seedorder_confirmation_email.html.twig';
        if ($input["Epost"]) {
            // Setup template data for this email
            $template_data = [
                'page_title' => $page_title,
                'name' => $fname,
                'seeds' => $seedorder,
                'total' => count($seedorder),
                'fee' => $config->getSetting('ORG_FEE'),
            ];
            // Render the html
            $body = $twig->render($my_template, $template_data);
            $email->send( // Ignore any send errors
                [$config->getSetting('ORG_SENDER_EMAIL'), $config->getSetting('ORG_SENDER_NAME')],
                $config->getSetting('ORG_CONFIRMATION_SUBJECT'),
                $body,
                [[$input["Epost"], $full_name]],
            );
        }

        // Show a response
        $my_template = 'seedorder_confirmation.html.twig';
        $template_data = [
            'page_title' => $page_title,
            'logo_image' => $config->getSetting('ORG_LOGO_IMG'),
            'header' => $config->getSetting('ORG_HEADER'),
            'fname' => $fname,
            'seeds' => $seedorder,
            'total' => count($seedorder),
            'fee' => $config->getSetting('ORG_FEE'),
            'org_url' => $config->getSetting('ORG_URL'),
            'org_name' => $config->getSetting('ORG_NAME'),
        ];
        echo $twig->render($my_template, $template_data);

        /*
        // Send an email
        $msg .= "\n" . $svarstext;
        if (!empty($input["Epost"])) {
            $email_address = filter_var($input["Epost"], FILTER_VALIDATE_EMAIL);
            if ($email_address) {
                include_once('class.phpmailer.php');
                $mail = new PHPMailer();
                $mail->IsMail(); // telling the class to use PHP mail transport
                $mail->IsHTML(FALSE);
                $mail->CharSet = 'iso-8859-1';
                $mail->SetFrom('fro@tradgardsamatorerna.nu', 'Trädgårdsamatörernas fröförmedling'); // Set sender
                $mail->Subject = 'Bekräftelse på fröbeställning';
                $mail->Body = $msg;
                $mail->AddAddress($email_address, "");
                $mail->Send();
            }
        }
        */
    } else {
        die ("<p class=\"intro_gra\">Fel uppstod vid beställning! Skicka gärna in beställningen på annat sätt.</p>");
    }

