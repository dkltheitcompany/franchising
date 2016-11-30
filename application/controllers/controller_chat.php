<?php

include ROOT.'/application/models/model_chat.php';
include ROOT.'/application/views/view_chat.php';

class controller_chat 
{
    public static function index()
    {
        session_start();
        if (isset($_SESSION['userid']) && $_SESSION['usertype'] != 'coordinator')
        {
            model_chat::find_chats();
            view_chat::make_general();
        }
        else 
            http_response_code(404);
    }
    
    public static function show_one($userid)
    {
        session_start();
        if (isset($_SESSION['userid']))
        {
            DataBase::querry_tmp('is_correct_comp', $_SESSION['userid'], $userid);
            
            if (!empty(DataBase::fetch_all()))
            {
                model_chat::find_messages($userid);
                view_chat::make_one();
            }
            else
                http_response_code(404);
                
        }
        else
            http_response_code(404);
    }
}
