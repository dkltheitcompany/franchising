<?php

class view_main
{
    public static function make_general()
    {
        $view_body = 'Дратути, дратути.<br><a href="/registration">Регистрация</a>';

        include ROOT.'/application/views/pages/view_template.php';
    }
}
