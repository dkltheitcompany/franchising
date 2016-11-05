<?php

include ROOT.'/application/models/model_authorization.php';
include ROOT.'/application/views/view_authorization.php';

class controller_authorization
{
    public static function index()
    {
        if (model_authorization::is_auth_form_valid())
        {
            model_authorization::start_session();
            header('Location: /project');
        }
        else
        {
            session_start();
            if (isset($_SESSION['userid']))
                header('Location: /project');
            else
                view_authorization::make_auth_form(model_authorization::$valid_form);
        }
    }

    public static function apply_reset_password()
    {
        if(model_authorization::is_apply_reset_form_valid())
        {
            model_authorization::apply_reset();
            view_authorization::make_apply_reset();
        }
        else
            view_authorization::make_apply_reset_form(model_authorization::$valid_form);
    }
    
    public static function reset($hash)
    {
        if (model_authorization::is_reset_form_valid())
        {
            model_authorization::reset();
            header('Location: /authorization');
        }
        else if (model_authorization::is_valid_reset($hash))
        {
            view_authorization::make_reset_form(model_authorization::$valid_form, model_authorization::$user['userid']);
        }
        else
            http_response_code(404);
    }

    public static function exit_account()
    {
        session_start();
        if ($_SESSION['userid'])
        {
            model_authorization::end_session();
            header('Location: /');
        }
        else
            http_response_code(404);
    }
}
