<?php
define('SMTP_INCLUDED', 1);
function server_parse($socket, $response)
{
    $server_response = '';
    while (substr($server_response, 3, 1) != ' ') {
        if (!($server_response = fgets($socket, 256))) {
            echo "Couldn't get mail server response codes";
        }
    }
    if (!(substr($server_response, 0, 3) == $response)) {
        echo "Ran into problems sending Mail. Response: $server_response";
    }
}
function smtpmail($mail_to, $subject, $message, $headers = '', $smtp_host, $smtp_username, $smtp_password, $admin_email)
{
    $message = preg_replace("/(?<!\r)\n/si", "\r\n", $message);
    if ($headers != "") {
        if (is_array($headers)) {
            if (sizeof($headers) > 1) {
                $headers = join("\r\n", $headers);
            } else {
                $headers = $headers[0];
            }
        }
        $headers      = chop($headers);
        $headers      = preg_replace("/(?<!\r)\n/si", "\r\n", $headers);
        $header_array = explode("\r\n", $headers);
        @reset($header_array);
        $headers = "";
        $cc      = '';
        $bcc     = '';
        while (list(, $header) = each($header_array)) {
            if (preg_match("/^cc:/si", $header)) {
                $cc = preg_replace("/^cc:(.*)/si", "\\1", $header);
            } else if (preg_match("/^bcc:/si", $header)) {
                $bcc    = preg_replace("/^bcc:(.*)/si", "\\1", $header);
                $header = "";
            }
            $headers .= $header . "\r\n";
        }
        $headers = chop($headers);
        $cc      = explode(",", $cc);
        $bcc     = explode(",", $bcc);
    }
    if (trim($mail_to) == "") {
        exit();
    }
    if (trim($subject) == "") {
        die("No email Subject specified");
    }
    $mail_to_array = explode(",", $mail_to);
    if (!$socket = fsockopen($smtp_host, 25, $errno, $errstr, 20)) {
        die("Could not connect to smtp host : $errno : $errstr");
    }
    server_parse($socket, "220");
    if (!empty($smtp_username) && !empty($smtp_password)) {
        fputs($socket, "EHLO " . $smtp_host . "\r\n");
        server_parse($socket, "250");
        fputs($socket, "AUTH LOGIN\r\n");
        server_parse($socket, "334");
        fputs($socket, base64_encode($smtp_username) . "\r\n");
        server_parse($socket, "334");
        fputs($socket, base64_encode($smtp_password) . "\r\n");
        server_parse($socket, "235");
    } else {
        fputs($socket, "HELO " . $smtp_host . "\r\n");
        server_parse($socket, "250");
    }
    fputs($socket, "MAIL FROM: <" . $admin_email . ">\r\n");
    server_parse($socket, "250");
    $to_header = "To: ";
    @reset($mail_to_array);
    while (list(, $mail_to_address) = each($mail_to_array)) {
        $mail_to_address = trim($mail_to_address);
        if (preg_match('/[^ ]+\@[^ ]+/', $mail_to_address)) {
            fputs($socket, "RCPT TO: <$mail_to_address>\r\n");
            server_parse($socket, "250");
        }
        $to_header .= "<$mail_to_address>, ";
    }
    @reset($bcc);
    while (list(, $bcc_address) = each($bcc)) {
        $bcc_address = trim($bcc_address);
        if (preg_match('/[^ ]+\@[^ ]+/', $bcc_address)) {
            fputs($socket, "RCPT TO: <$bcc_address>\r\n");
            server_parse($socket, "250");
        }
    }
    @reset($cc);
    while (list(, $cc_address) = each($cc)) {
        $cc_address = trim($cc_address);
        if (preg_match('/[^ ]+\@[^ ]+/', $cc_address)) {
            fputs($socket, "RCPT TO: <$cc_address>\r\n");
            server_parse($socket, "250");
        }
    }
    fputs($socket, "DATA\r\n");
    server_parse($socket, "354");
    fputs($socket, "Subject: $subject\r\n");
    fputs($socket, "$to_header\r\n");
    fputs($socket, "$headers\r\n\r\n");
    fputs($socket, "$message\r\n");
    fputs($socket, ".\r\n");
    server_parse($socket, "250");
    fputs($socket, "QUIT\r\n");
    fclose($socket);
    return TRUE;
}
function SendMail($frommail, $tomail, $subject, $message, $fromfullname = "", $admin_email)
{
    $from    = $fromfullname . " <" . $frommail . ">";
    $headers = "Return-Path: " . $fromfullname . " <" . $frommail . ">\r\n";
    $headers .= "From: $from\nX-Mailer: " . $fromfullname . "\r\n";
    $headers .= "Mime-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $smtp_host     = 'sg1-ss106.a2hosting.com';
    //$admin_email   = 'sendee@gmail.com';
    $smtp_username = 'no_reply@sendee.com';
    $smtp_password = 'E2nd6w8@7r';
    $result        = @smtpmail($tomail, $subject, $message, $headers, $smtp_host, $smtp_username, $smtp_password, $admin_email);
    //exit($message.'-'.$tomail);
}

?>