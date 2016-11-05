<?php

class model_authorization {

    public static $valid_form = true;
    public static $user;

    public static function is_apply_reset_form_valid()
    {
        if (empty($_POST['submit_apply_reset']))
            return false;
        
        DataBase::querry('reset_find_user', $_POST['usermail']);
        if (empty(self::$user = DataBase::fetch()))
            return self::$valid_form = false;
        
        return true;
    }

    public static function is_valid_reset($hash)
    {
        DataBase::querry('find_hash_reset', $hash);
        if(empty(self::$user = DataBase::fetch()))
                return false;
        
        return true;
    }
    
    public static function is_reset_form_valid()
    {
        if(empty($_POST['submit_reset']))
            return false;
        
        if($_POST['userpassword'] != $_POST['repeatpassword'])
            return self::$valid_form=false;
        
        return true;
    }

    public static function reset()
    {
        DataBase::querry('new_password_user', $_POST['userid'], password_hash($_POST['userpassword'], PASSWORD_BCRYPT));
        DataBase::querry('delete_reset', $_POST['userid']);
    }

    public static function apply_reset()
    {
        $hash = sha1(self::$user['userid'].$_POST['usermail']);
        DataBase::querry('add_reset', self::$user['userid'], $hash);
        MailMessager::sendmsg('reset', $_POST['usermail'], $hash);
    }

    public static function is_auth_form_valid()
    {
        if (empty($_POST['submit_auth']))
            return false;

        DataBase::querry('auth_find_user', $_POST['userpnum']);
        if (empty(self::$user = DataBase::fetch()))
            return self::$valid_form = false;

        if (!password_verify($_POST['userpassword'], self::$user['userpassword']))
            return self::$valid_form = false;

        return true;
    }

    public static function start_session()
    {
        session_start(['cookie_lifetime' => 86400]);
        $_SESSION['userid'] = self::$user['userid'];
        $_SESSION['userfname'] = self::$user['userfname'];
        $_SESSION['usersname'] = self::$user['usersname'];
        $_SESSION['usertype'] = self::$user['usertype'];
    }

    public static function end_session()
    {
        session_unset();
    }

}
