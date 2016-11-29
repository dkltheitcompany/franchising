<?php

class model_chat 
{
    public static $messages = Array();
    public static $companions = Array();
    
    
    public static function find_messages($compid)
    {
        if (isset($_POST['message']) && $_POST['message'])
            DataBase::querry_tmp('send_message', $compid, $_SESSION['userid'], $_POST['message']);
        
        DataBase::querry_tmp('find_messages', $_SESSION['userid']);
        
        model_chat::$messages = DataBase::fetch_all();
    }
    
    public static function find_chats($types)
    {
        $type = $types[0];
        $target = $types[1];
        
        DataBase::querry("SELECT $target FROM pm WHERE $type=".$_SESSION['userid']);
        
        foreach (DataBase::fetch_all() as $value)
            array_push(model_chat::$companions, $value[$target]);
    }
}
