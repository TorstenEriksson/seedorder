<?php

    namespace sta;

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;

    class Email
    {
        const DIVIDING_PATTERN = "/[\s,;]+/";

        public function __construct(
            private readonly Config $config,
        )
        {}

        /**
         * Send an email by using phpmailer
         * parameters:
         * $from = [email-address, string-name-of-sender]
         * $subject = string
         * $body = string
         * $to = [[email-address, string-name-of-adressee]]
         * $attachment = file-name-string (including path)
         * $is_html = true or false
         *
         * Returns true or false depending on success
         */
        public function send(array $from, string $subject, string $body, array $to, string $attachment = '', bool $is_html = true): bool
        {
            $mail = new PHPMailer(true);
            $use_smtp = (bool)$this->config->getSetting('ORG_USE_SMTP');
            try {
                // Email service settings
                if ($use_smtp) {
                    $mail->isSMTP();                                    // Send using SMTP
                    $mail->Host       = $this->config->getSetting('MY_SMTP_HOSTNAME'); // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                           // Enable SMTP authentication
                    $mail->Username   = $this->config->getSetting('MY_SMTP_USER'); // SMTP username
                    $mail->Password   = $this->config->getSetting('MY_SMTP_PASSWD'); // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port       = 465;
                    $mail->SetFrom($from[0], $from[1]); // Set sender
                } else {
                    $mail->IsMail(); // Send using PHP mail transport
                    $mail->SetFrom($from[0], $from[1]); // Set sender
                }
                // Setup mail
                $mail->isHTML($is_html);
                $mail->CharSet = PHPMailer::CHARSET_UTF8;
                $mail->Subject = $subject;
                $mail->Body = $body;
                if ($is_html) {
                    $altbody = html_entity_decode($body);
                    $mail->AltBody = strip_tags($altbody);
                }
                foreach ($to as $to_address) {
                    $epostadresser = $this->separate($to_address[0]);
                    foreach ($epostadresser as $epa) {
                        if ($this->checkEmailAddr($epa)) {
                            $mail->addAddress($epa, $to_address[1]);
                        }
                    }
                }
                if ($attachment) {
                    if (file_exists($attachment)) {
                        $mail->addAttachment($attachment, '', 'base64', 'application/pdf');
                    }
                    else {
                        return FALSE;
                    }
                }
                // Send mail
                if ($mail->Send()) {
                    return TRUE;
                }
            }
            catch (Exception $e) {
                $to_whom = implode(';', $to);
                $this->logEmailError($to_whom, $mail->ErrorInfo); // Mailer Error: {$mail->ErrorInfo}";
                // Is this a good idea?
                return FALSE;
            }
            return FALSE;
        }

        /**
         * Very basic email address check
         */
        private function checkEmailAddr(string $email): bool
        {
            $snabelaPos = strpos($email, '@');
            if ($snabelaPos === false) {
                return false;
            }
            if (strpos($email, '.', $snabelaPos+1) === false) {
                return false;
            }
            if (strpbrk($email, ' ,') !== false) {
                return false;
            }
            return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
        }

        /**
         * Separate email addresses into array if written on the same line
         */
        private function separate(string $email): array
        {
            return preg_split(self::DIVIDING_PATTERN , $email, -1, PREG_SPLIT_NO_EMPTY);
        }

        /**
         * Save a log message if email was not sent
         */
        private function logEmailError(string $email, string $info): void
        {
            $path = realpath("../" . $this->config->getSetting('ORG_EMAIL_LOG_DIR'));
            if (!file_exists($path)) {
                mkdir($path);
            }
            $filename = $path . date('Y-m-d') . ".log";
            if ($file = fopen($filename, "a")) {
                fwrite($file, "$email: $info\n");
                fclose($file);
            }
        }

    }