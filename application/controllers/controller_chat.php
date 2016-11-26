<?php

include ROOT.'/application/models/model_chat.php';
include ROOT.'/application/views/view_chat.php';

class controller_chat 
{
    public static function index()
    {
        session_start();
        if (isset($_SESSION['userid']) && $_SESSION['usertype'] == 'franchisor')
        {
            model_chat::find_messages();
            view_chat::make_general();
        }
        else 
            header("HTTP/1.0 404 Not Found");
    }
}
