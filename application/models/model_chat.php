<?php

class model_chat 
{
    public static $messages = [];
    public static $companions = [];
    
    
    public static function find_messages($userid)
    {
        if (isset($_POST['message']) && !empty($_POST['message']))
            DataBase::querry_tmp('send_message_chat', $userid, $_SESSION['userid'], $_POST['message']);
        
        DataBase::querry_tmp('find_messages_chat', $_SESSION['userid']);
        model_chat::$messages = DataBase::fetch_all();
    }
    
    public static function find_chats()
    {
        switch ($_SESSION['usertype'])
        {
        case 'franchisor':
            DataBase::querry("SELECT userid, userfname, usersname, usertname FROM user WHERE userid=("
                    . "SELECT pmid FROM franchisor WHERE userid={$_SESSION['userid']} LIMIT 1)");
            break;
        case 'project_manager':
            DataBase::querry("SELECT userid, userfname, usersname, usertname FROM user WHERE userid=("
                    . "SELECT userid FROM franchisor WHERE pmid={$_SESSION['userid']})");
            break;
        }
        
        model_chat::$companions = DataBase::fetch_all();
    }
}
