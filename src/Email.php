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
            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;            // Enable verbose debug output *** for testing only ***
                $mail->isSMTP();                                    // Send using SMTP
                $mail->Host       = $this->config->getSetting('MY_SMTP_HOSTNAME'); // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                           // Enable SMTP authentication
                $mail->Username   = $this->config->getSetting('MY_SMTP_USER'); // SMTP username
                $mail->Password   = $this->config->getSetting('MY_SMTP_PASSWD'); // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                            // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                // Setup mail
                $mail->isHTML($is_html);
                $mail->CharSet = PHPMailer::CHARSET_UTF8;
                $mail->setFrom($this->config->getSetting('MY_SMTP_FROM'), $from[1]); // Set sender
                $mail->addReplyTo($from[0]); // Set replyto
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
                // Is this a good idea?
                return FALSE; // Mailer Error: {$mail->ErrorInfo}";
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

    }