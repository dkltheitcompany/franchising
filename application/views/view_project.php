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
    
    public static function make_info_franchisor($project)
    {
        $view_body = file_get_contents(ROOT.'/application/views/pages/info_franchisor.php');
        
        include ROOT.'/application/views/pages/view_template.php';
    }
    
    public static function make_list_pm($pms)
    {
        eval ('?>'.file_get_contents(ROOT.'/application/views/pages/list_pm.php'));
    }
    
    public static function make_info_pm($project)
    {
        $view_body = file_get_contents(ROOT.'/application/views/pages/info_pm.php');
        
        include ROOT.'/application/views/pages/view_template.php';
    }
    
    public static function make_list_franch_pm($franchisors)
    {
        $view_body = file_get_contents(ROOT.'/application/views/pages/list_franchisor_pm.php');
        
        include ROOT.'/application/views/pages/view_template.php';
    }
}