<?php

class view_project
{
    public static function make()
    {
        $view_body = 'Ваш id: '.$_SESSION['userid'].'<br>'.'Ваш тип: '.$_SESSION['usertype'];
        
        include ROOT.'/application/views/pages/view_template.php';
    }
    
    public static function make_list_franch($franchisors)
    {
        $view_body = file_get_contents(ROOT.'/application/views/pages/list_franchisor.php');
        
        include ROOT.'/application/views/pages/view_template.php';
    }
    
    public static function make_info_coordinator($project)
    {
        $view_body = file_get_contents(ROOT.'/application/views/pages/info_coordinator.php');
        
        include ROOT.'/application/views/pages/view_template.php';
    }
    
    public static function make_stage($info)
    {
        $view_body = "Этап: {$info['stage']}<br>Обновлён: {$info['lastupdate']}";
        if (!$info['applied'])
            $view_body .= "<br><form><input type='submit' name='submit_apply_stage'></form>";
        else
            $view_body .= 'Ваши действия обрабатываются';
    }
}