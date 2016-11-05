<?php

class SmsMessager
{
    public static function sendmsg($destination, $text)
    {
        echo "sms sended to $destination, text:\n<pre>$text</pre>";
    }
}