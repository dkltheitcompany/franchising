<?php

class view_main
{
    public static function make_general()
    {
        $view_body = 'Добро пожаловать на сайт Gala-franch<br><a href="/registration">Регистрация</a>';

        include ROOT.'/application/views/view_template.php';
    }
}
