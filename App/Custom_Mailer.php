<?php

namespace App;

/*
 * Send HTML Emails with inline images
 */
class Custom_Mailer
{
    public $email_attachments = [];

    public function send($to, $subject, $body, $headers, $attachments)
    {
        /* Used by "phpmailer_init" hook to add attachments directly to PHPMailer  */
        $this->email_attachments = $attachments;

        /* Setup Before send email */
        add_action('phpmailer_init', [$this, 'add_attachements_to_php_mailer']);
        add_filter('wp_mail_content_type', [$this, 'set_content_type']);
        add_filter('wp_mail_from', [$this, 'set_wp_mail_from']);
        add_filter('wp_mail_from_name', [$this, 'wp_mail_from_name']);
        
        /* Send Email */
        $is_sent = wp_mail($to, $subject, $body, $headers);
        
        /* Cleanup after send email */
        $this->email_attachments = [];
        remove_action('phpmailer_init', [$this, 'add_attachements_to_php_mailer']);
        remove_filter('wp_mail_content_type', [$this, 'set_content_type']);
        remove_filter('wp_mail_from', [$this, 'set_wp_mail_from']);
        remove_filter('wp_mail_from_name', [$this, 'wp_mail_from_name']);

        return $is_sent;
    }

    public function add_attachements_to_php_mailer(&$phpmailer)
    {
        $phpmailer->SMTPKeepAlive=true;
        
        /* Sendgrid */
        if (defined('SENDGRID_PASSWORD')) {
            $phpmailer->IsSMTP();
            $phpmailer->Host="smtp.sendgrid.net";
            $phpmailer->Port = 587;
            $phpmailer->SMTPAuth = true;
            $phpmailer->SMTPSecure = 'tls';
            $phpmailer->Username="apikey";
            $phpmailer->Password = SENDGRID_PASSWORD;   /* api key from sendgrid */
        }

        /* Add attachments to mail */
        foreach ($this->email_attachments as $attachment) {
            if (file_exists($attachment['path'])) {
                $phpmailer->AddEmbeddedImage($attachment['path'], $attachment['cid'], $attachment['name']);
            }
        }
    }

    public function set_content_type()
    {
        return "text/html";
    }
    
    public function set_wp_mail_from($email)
    {
        //Make sure the email is from the same domain
        //as your website to avoid being marked as spam.
        return strip_tags(get_option('admin_email'));
    }

    public function wp_mail_from_name($name)
    {
        return get_bloginfo('name');
    }
}
