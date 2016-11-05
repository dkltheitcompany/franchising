<?php

class MailMessager
{
    public static function sendmsg($type, $destination, ...$data)
    {
        $msg_templates = include ROOT.'/application/config/msg_templates.php';
        $msg = $msg_templates[$type];
        mail($destination, $msg['title'], $msg['text'], $msg['headers']);
    }
}