<?php
    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        die();
    }
    $input = $_POST;
    $name = $input["Namn"];
    $number = $input["Medlemsnummer"];
    $seed1 = $input["Val_1"];

    // Assemble input data into a string formatted according
    // to the downstream requirements
    $msg = "Namn=" . $input["Namn"] .
        "&Gata=" . $input["Gata"] .
        "&Postnr=" . $input["Postnr"] .
        "&Ort=" . $input["Ort"] .
        "&Telefon=" . $input["Telefon"] .
        "&Epost=" . $input["Epost"] .
        "&Medlemsnummer=" . $input["Medlemsnummer"] .
        "&Fyll_upp=" . $input["Fyll_upp"] .
        "&Auto_fyll=" . $input["Auto_fyll"];
    for ($i = 1; $i <= 108; $i++) {
        $msg .= "&Val+$i=" . $input["Val_$i"];
    }
    $msg = str_replace(' ', '+', $msg);
    $msg = iconv('utf-8', 'iso-8859-1', $msg);
    if ((!empty($name)) and (!empty($number)) and (!empty($seed1))) {
        $today = date("Ymd");
        $path = realpath("../seedorder");
        $filename = $path . "/fro" . $today . ".sod";
        if (!$file = fopen($filename, "a")) {
            die("Ett fel uppstod: Kunde inte öppna filen \"$filename\"");
        }
        fwrite($file, $msg . "\n");
        fclose($file);

        $scnt = 0;
        $emsg = array();
        $emsg[] = 'Vi har mottagit din beställning:';
        foreach ($_POST as $key => $value) {
            if (substr($key, 0, 4) == 'Val_' && empty($value) || $key == 'Skicka') {
                continue;
            } elseif (substr($key, 0, 4) == 'Val_') {
                $key = 'Frö';
                $scnt++;
            }
            $emsg[] = $key . ' = ' . $value;
        }
        $emsg[] = "Sammanlagt $scnt fröer beställda";
        $msg = implode("\n", $emsg);
        // Show a response
        $tmp = explode(' ', $name);
        $svarstext = 'Vid ordinarie beställning: betalning INNAN första fördelning, exp avgift 80 kronor.
Vid efterbeställning: inbetalningskort kommer med fröerna.
Betalning till STA Fröförmedling bankgiro 418-4446.
För betalning från andra länder är vårt BIC/IBAN följande
HANDSESS/SE 74 6000 0000 0005 6008 8752.

Tack för din beställning';
        echo "<p class=\"intro_gra\">Tack f&ouml;r din best&auml;llning, " . htmlentities($tmp[0]) . "</p>";
        echo '<p>' . nl2br(htmlentities($svarstext, ENT_COMPAT, 'iso-8859-1')) . '</p>';
        echo '<h2><a href="http://tradgardsamatorerna.nu">Tillbaka till Tr&auml;dg&aring;rdsamat&ouml;rernas webbplats</a></h2>';

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
    } else {
        echo "<p class=\"intro_gra\">Fel uppstod vid best&auml;llning! Skicka g&auml;rna in best&auml;llningen p&aring; annat s&auml;tt.</p>";
    }
