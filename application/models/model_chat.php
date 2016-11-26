<?php

class model_chat 
{
    public static $messages = Array();
    
    public static function find_messages()
    {
        DataBase::querry_tmp('find_messages', $_SESSION['userid']);
        
        model_chat::$messages = DataBase::fetch_all();
    }
}
