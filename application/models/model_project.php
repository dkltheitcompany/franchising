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
            else if ($_POST[$task->taskname] == 'good')
                TaskPool::checked_good($task->taskname, $_POST["{$task->taskname}_msg"]);
            else if ($_POST[$task->taskname] == 'bad')
                TaskPool::checked_bad($task->taskname, $_POST["{$task->taskname}_msg"]);
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
                TaskPool::checked_good($task->taskname, $_POST["{$task->taskname}_msg"]);
            else if ($_POST[$task->taskname] == 'bad')
                TaskPool::checked_bad($task->taskname, $_POST["{$task->taskname}_msg"]);
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
            DataBase::querry("UPDATE franchisor SET pmid={$_POST['userid']} WHERE userid=$userid");
            return true;
        }
        return false;
    }
    
    public static function not_for_coord($userid)
    {
        DataBase::querry("SELECT userid FROM franchisor WHERE userid=$userid");
        if (empty(DataBase::fetch()))
            return true;
        DataBase::querry("SELECT pmid FROM franchisor WHERE userid=$userid");
        return !empty(DataBase::fetch()['pmid']);
    }
    
    public static function not_for_pm($userid)
    {
        DataBase::querry("SELECT pmid FROM franchisor WHERE userid=$userid");
        return DataBase::fetch()['pmid'] != $_SESSION['userid'];
    }

        public static function take_form_pm($userid)
    {
        TaskPool::load($userid);
        foreach (TaskPool::$tasks as $task)
        {
            if ($_POST[$task->taskname] == 'done')
            {
                TaskPool::done($task->taskname);
            }
            else if ($_POST[$task->taskname] == 'good')
                TaskPool::checked_good($task->taskname, $_POST["{$task->taskname}_msg"]);
            else if ($_POST[$task->taskname] == 'bad')
                TaskPool::checked_bad($task->taskname, $_POST["{$task->taskname}_msg"]);
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
        DataBase::querry_tmp('list_pm_franchisor', $_SESSION['userid']);
        $franch = DataBase::fetch_all();
        return $franch;
    }
}