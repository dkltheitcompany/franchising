<?php

include ROOT.'/application/models/model_chat.php';
include ROOT.'/application/views/view_chat.php';

class controller_chat 
{
    public static $accord = [
        'franchisor' => ['workwith','userid'],
        'project_manager' => ['userid', 'workwith']
    ];
    
    
    public static function index()
    {
        session_start();
        if (isset($_SESSION['userid']))
        {
            model_chat::find_chats(self::$accord[$_SESSION['usertype']]);
            view_chat::make_general();
        }
        else 
            header("HTTP/1.0 404 Not Found");
    }
    
    public static function show_one($compid)
    {
        session_start();
        if (isset($_SESSION['userid']))
        {
            DataBase::querry_tmp('is_correct_comp', $_SESSION['userid'], $compid);
            
            if (!empty(DataBase::fetch_all()))
            {
                model_chat::find_messages($compid);
                view_chat::make_one();
            }
        }
        else 
            header("HTTP/1.0 404 Not Found");
    }
}
