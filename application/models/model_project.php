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
        $user = DataBase::fetch_all();
        return $user;
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
        $user = DataBase::fetch();
        return $user;
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
    
    public static function is_choosen($userid)
    {
        if (isset($_POST['choose']))
        {
            DataBase::querry("SELECT workwith FROM pm WHERE userid={$_POST['userid']}");
            $workwith = DataBase::fetch()['workwith'].' '.$userid;
            DataBase::querry("UPDATE pm SET workwith=$workwith WHERE userid={$_POST['userid']}");
            DataBase::querry("UPDATE franchisor SET havepm=1 WHERE userid=$userid");
            return true;
        }
        return false;
    }
    
    public static function take_form_pm($userid)
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
    
    public static function info_pm($userid)
    {
        DataBase::querry_tmp('info_pm_franchisor', $userid);
        $user = DataBase::fetch();
        return $user;
    }
    
    public static function list_franch_pm()
    {
        DataBase::querry("SELECT workwith FROM pm WHERE userid={$_SESSION['userid']}");
        $workwith = preg_split('~ ~', DataBase::fetch()['workwith']);
        $franch = [];
        foreach ($workwith as $userid)
        {
            DataBase::querry_tmp('info_pm_franchisor', $userid);
            $franch[] = DataBase::fetch();
        }
        return $franch;
    }
}