<?php

class view_authorization
{
    public static function make_auth_form($valid_inputs)
    {
        if (!$valid_inputs)
            $report = 'Неверный номер телефона или пароль';
        
        $view_body = file_get_contents(ROOT.'/application/views/forms/authorization_form.php');
        
        include ROOT.'/application/views/pages/view_template.php';
    }
    public static function make_apply_reset()
    {
        $view_body = 'На ваш Email отправлено письмо с восстановлением пароля';
        
        include ROOT.'/application/views/pages/view_template.php';
    }

    public static function make_reset_form($valid_form, $userid)
    {
        if(!$valid_form)
            $report_password = 'Пароли не совпадают';

        $view_body = file_get_contents(ROOT.'/application/views/forms/reset_form.php');
        
        include ROOT.'/application/views/pages/view_template.php';
    }

    public static function make_apply_reset_form($valid_form)
    {
        if (!$valid_form)
            $report_mail = 'E-mail некорректен или не зарегестрирован';
        
        $view_body = file_get_contents(ROOT.'/application/views/forms/apply_reset_form.php');
        
        include ROOT.'/application/views/pages/view_template.php';
    }
}
