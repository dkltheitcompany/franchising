<?php

class model_registration
{
    public static $valid_inputs = [
        'userfname' => true,
        'usersname' => true,
        'usertname' => true,
        'usermail' => true,
        'userpnum' => true,
        'userpassword' => true,
        'repeatpassword' => true
        ];
    private static $user;
    
    private static function unique()
    {
        DataBase::querry_tmp('check_unique', $_POST['usermail'], $_POST['userpnum']);
        $unique = true;
        while (!empty($user = DataBase::fetch()))
        {
            if ($user['usermail'] == $_POST['usermail'])
                $unique = self::$valid_inputs['usermail'] = false;
            if ($user['userpnum'] == $_POST['userpnum'])
                $unique = self::$valid_inputs['userpnum'] = false;
        }
        return $unique;
    }
    
    private static function generate_key()
    {
        return strval(rand(0, 9)).strval(rand(0, 9)).strval(rand(0, 9)).strval(rand(0, 9));
    }
    
    public static function is_reg_form_valid()
    {
        $is_valid = true;
        
        if (empty($_POST['submit_reg']))
            return false;
        
        $regex = include ROOT.'/application/config/registration_regex.php';
        
        if (!preg_match("~{$regex['username']}~u", $_POST['userfname']))
            $is_valid = self::$valid_inputs['userfname'] = false;
        if (!preg_match("~{$regex['username']}~u", $_POST['usersname']))
            $is_valid = self::$valid_inputs['usersname'] = false;
        if (!preg_match("~{$regex['username']}~u", $_POST['usertname']))
            $is_valid = self::$valid_inputs['usertname'] = false;
        
        if (!preg_match("~{$regex['usermail']}~", $_POST['usermail']))
            $is_valid = self::$valid_inputs['usermail'] = false;
        
        if (!preg_match("~{$regex['userpnum']}~", $_POST['userpnum']))
            $is_valid = self::$valid_inputs['userpnum'] = false;
        
        if (!preg_match("~{$regex['userpassword']}~", $_POST['userpassword']))
            $is_valid = self::$valid_inputs['userpassword'] = false;
        
        if ($_POST['repeatpassword'] != $_POST['userpassword'])
            $is_valid = self::$valid_inputs['repeatpassword'] = false;
        
        if (!self::unique())
            $is_valid = false;
        
        return $is_valid;
    }
    
    public static function is_confirm_valid()
    {
        DataBase::querry_tmp('check_code_user_tmp', $_POST['usercode'], $_SESSION['usermail']);
        self::$user = DataBase::fetch();
        return !empty(self::$user);
    }

    public static function apply()
    {
        $encpword = password_hash($_POST['userpassword'], PASSWORD_BCRYPT);
        do 
        {
            $usercode = self::generate_key();
            DataBase::querry_tmp('add_user_tmp',
                    $usercode, $_POST['userfname'], $_POST['usersname'], $_POST['usertname'],
                    $_POST['usermail'], $_POST['userpnum'], $encpword);
        } while (DataBase::error() == 23000);
        MailMessager::sendmsg('reg_apply', $_POST['usermail'], $usercode);
    }
    
    public static function repeat()
    {
        DataBase::querry_tmp('repeat_apply_user_tmp', $_SESSION['usermail']);
        $usercode = DataBase::fetch()['usercode'];
        MailMessager::sendmsg('reg_apply', $_SESSION['usermail'], $usercode);
    }

    public static function confirm()
    {
        DataBase::querry_tmp('add_user',
                self::$user['userfname'], self::$user['usersname'], self::$user['usertname'], 
                self::$user['usermail'], self::$user['userpnum'], self::$user['userpassword'],
                'franchisor');
        $userid = DataBase::last_insert_id();
        DataBase::querry_tmp('add_new_franchisor', $userid, 42);
        TaskPool::new_task_pool($userid);
        DataBase::querry_tmp('delete_user_tmp', self::$user['usercode']);
    }
}