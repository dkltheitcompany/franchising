<?php

class view_registration
{
    public static function make_reg_form($valid_inputs)
    {
        if (!$valid_inputs['userfname'])
            $report_fname = 'Поле может содержать только кириллицу и не должно быть пустым';
        if (!$valid_inputs['usersname'])
            $report_sname = 'Поле может содержать только кириллицу и не должно быть пустым';
        if (!$valid_inputs['usertname'])
            $report_tname = 'Поле может содержать только кириллицу и не должно быть пустым';
        
        if (!$valid_inputs['usermail'])
            $report_mail = 'E-mail некорректен или уже зарегестрирован';
        
        if (!$valid_inputs['userpnum'])
            $report_pnum = 'Номер некорректен или уже зарегестрирован';
        
        if (!$valid_inputs['userpassword'])
            $report_password = 'Пароль должен содержать только латинские символы, цифры и подчёркивания';
        else if (!$valid_inputs['repeatpassword'])
            $report_password = 'Неправильно повторён пароль';
        
        $view_body = include ROOT.'/application/views/registration_form.php';
        
        include ROOT.'/application/views/view_template.php';
    }
    
    public static function make_bad_apply()
    {
        $view_body = 'Вы не заполнили форму регистрации.';
        
        include ROOT.'/application/views/view_template.php';
    }

    public static function make_confirm_form()
    {
        $view_body = file_get_contents(ROOT.'/application/views/confirm_form.php');
        
        include ROOT.'/application/views/view_template.php';
    }
    
    public static function make_confirm()
    {
        $view_body = 'E-mail подтверждён.<br><a href="/authorization">Войти в аккаунт</a>';
        
        include ROOT.'/application/views/view_template.php';
    }
    
    public static function make_invalid_confirm()
    {
        $view_body = 'Неверный код.<br><a href="/registration/confirm">Повторить попытку</a>';
        
        include ROOT.'/application/views/view_template.php';
    }
}