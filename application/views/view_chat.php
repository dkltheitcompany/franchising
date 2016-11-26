<?php

class view_chat 
{
    public static function make_general()
    {
        $view_body = file_get_contents(ROOT.'/application/views/pages/list_messages.php');
        
        include ROOT.'/application/views/pages/view_template.php';
    }
}
