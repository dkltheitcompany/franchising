<?php

class Router
{
    public static function start()
    {
        $routes = include ROOT.'/application/config/routes.php';
        
        foreach ($routes as $request => $path)
        {
            $path['args'] = preg_replace("~$request~", $path['args'], $_SERVER['REQUEST_URI'], -1, $reps);
            if ($reps)
            {
                $controller = 'controller_'.$path['controller'];
                $action = $path['action'];
                $args = preg_split('~/s+~',$path['args']);
                break;
            }
        }
        
        self::events();
        
        if (!isset($controller))
            http_response_code(404);
        else
        {
            include ROOT.'/application/controllers/'.$controller.'.php';
            call_user_func_array("$controller::$action", $args);
        }
    }
    
    public static function events()
    {
        DataBase::querry("SELECT userid, usermail FROM user WHERE userid=("
                . "SELECT pmid FROM franchisor WHERE userid=("
                . "SELECT userid FROM task WHERE taskdeadline<DATE_ADD(NOW(), INTERVAL 3 DAY) AND taskdone=0 AND taskdlmsg=0))");
        foreach (DataBase::fetch_all() as $msg)
        {
            DataBase::querry("SELECT userid, userfname, usersname, usertname FROM user WHERE pmid={$msg['userid']}");
            $franch = DataBase::fetch();
            MailMessager::sendmsg('deadline_close', $msg['usermail'],
                    $franch['userfname'], $franch['usersname'], $franch['usertname'], $franch['userid']);
        }
    }
}
