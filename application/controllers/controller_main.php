<?php

include ROOT.'/application/views/view_main.php';

class controller_main
{
    public static function index()
    {
        session_start();
        if (isset($_SESSION['userid']))
            header('Location: /project');
        else
            view_main::make_general();
    }
}
