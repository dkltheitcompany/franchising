<?php

include ROOT.'/application/models/model_registration.php';
include ROOT.'/application/views/view_registration.php';

class controller_registration
{
    public static function index()
    {
        if (model_registration::is_reg_form_valid())
        {
            session_start();
            $_SESSION['usermail'] = $_POST['usermail'];
            header('Location: /registration/confirm');
            model_registration::apply();
        }
        else
            view_registration::make_reg_form(model_registration::$valid_inputs);
    }
    
    public static function repeat()
    {
        session_start();
        if (isset($_SESSION['usermail']))
        {
            model_registration::repeat();
            header('Location: /registration/confirm');
        }
        else
            http_response_code(404);
    }
    
    public static function confirm()
    {
        session_start();
        
        if (isset($_SESSION['usermail']))
        {
            if ($_POST['submit_confirm'])
            {
                if (model_registration::is_confirm_valid())
                {
                    model_registration::confirm();
                    view_registration::make_confirm();
                    session_unset();
                }
                else
                    view_registration::make_invalid_confirm();
            }
            else
                view_registration::make_confirm_form();
        }
        else
            view_registration::make_bad_apply();
    }
}
