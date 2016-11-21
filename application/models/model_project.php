<?php

class model_project
{
    public static function list_franch()
    {
        DataBase::querry_tmp('coord_list_find_franchisor');
        return DataBase::fetch_all();
    }
    
    public static function list_pm()
    {
        DataBase::querry_tmp('coord_list_find_pm');
        return DataBase::fetch_all();
    }
    
    public static function take_form_franch()
    {
        TaskPool::load($_SESSION['userid']);
        foreach (TaskPool::$tasks as $task)
        {
            if ($_POST[$task->taskname] == 'done')
                TaskPool::done($task->taskname);
        }
        TaskPool::save();
    }
    
    public static function info_franchisor()
    {
        DataBase::querry_tmp('stage_info_franchisor', $_SESSION['userid']);
        return DataBase::fetch();
    }
    
    public static function take_form_coord($userid)
    {
        TaskPool::load($userid);
        foreach (TaskPool::$tasks as $task)
        {
            if ($_POST[$task->taskname] == 'good')
                TaskPool::checked_good($task->taskname);
            else if ($_POST[$task->taskname] == 'bad')
                TaskPool::checked_bad($task->taskname);
        }
        TaskPool::save();
    }
    
    public static function info_coordinator($userid)
    {
        DataBase::querry_tmp('info_coordinator_franchisor', $userid);
        $user = DataBase::fetch();
        return $user;
    }
}