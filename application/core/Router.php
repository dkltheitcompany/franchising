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
        
        if (!isset($controller))
            http_response_code(404);
        else
        {
            include ROOT.'/application/controllers/'.$controller.'.php';
            call_user_func_array("$controller::$action", $args);
        }
    }
}
