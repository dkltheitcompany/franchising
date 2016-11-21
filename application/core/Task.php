<?php

class Task
{
    public $taskid;
    public $taskname;
    public $userid;
    public $taskdone;
    public $taskchecked;
    public $taskdate;
    
    public $updated;
    
    public function __construct($task = null)
    {
        $this->taskid = $task['taskid'];
        $this->taskname = $task['taskname'];
        $this->userid = $task['userid'];
        $this->taskdone = $task['taskdone'];
        $this->taskchecked = $task['taskchecked'];
        $this->taskdate = $task['taskdate'];
        
        $this->updated = 0;
    }
    
    public function get_form()
    {
        $task_data = include ROOT.'/application/config/task_data.php';
        return $task_data[$this->taskname];
    }
}

class TaskPool
{
    public static $tasks = [];
    
    public static $next_stage = 0;
    
    public static function new_task_pool($userid)
    {
        $task_tree = include ROOT.'/application/config/task_tree.php';
        foreach ($task_tree['application'] as $task)
            DataBase::querry("INSERT INTO task (taskname, userid) VALUES ('{$task['taskname']}', $userid)");
    }
    
    public static function load($userid)
    {
        DataBase::querry("SELECT * FROM task WHERE userid=$userid");
        while (!empty($task = DataBase::fetch()))
                self::$tasks[$task['taskname']] = new Task($task);
    }
    
    public function done($taskname)
    {
        self::$tasks[$taskname]->updated = true;
        self::$tasks[$taskname]->taskdone = true;
    }
    
    public function checked_good($taskname)
    {
        self::$tasks[$taskname]->updated = true;
        self::$tasks[$taskname]->taskchecked = true;
        foreach (self::$tasks as $task)
        {
             if (!$task->taskchecked)
                return;
        }
        self::$next_stage = true;
    }
    
    public function checked_bad($taskname)
    {
        self::$tasks[$taskname]->updated = true;
        self::$tasks[$taskname]->taskdone = 0;
    }
    
    public static function save()
    {
        print_r(self::$tasks);
        if (self::$next_stage)
        {
            $userid = array_shift(self::$tasks)->userid;
            self::$tasks = [];
            DataBase::querry("DELETE FROM task WHERE userid=$userid");
            DataBase::querry("UPDATE franchisor SET stage=stage+1 WHERE userid=$userid");
            DataBase::querry("SELECT stage FROM franchisor WHERE userid=$userid");
            $task_tree = include ROOT.'/application/config/task_tree.php';
            $next_stage = DataBase::fetch()['stage'];
            foreach ($task_tree[$next_stage] as $new_task)
            {
                DataBase::querry("INSERT INTO task (taskname, userid) VALUES ('{$new_task['taskname']}', $userid)");
            }
            self::load($userid);
        }
        else
        {
            foreach (self::$tasks as $task)
            {
                if ($task->updated)
                    DataBase::querry("UPDATE `task` "
                            . "SET `taskdone`=$task->taskdone, `taskchecked`=$task->taskchecked, `taskdate`=NOW() "
                            . "WHERE `taskid`=$task->taskid");
            }
        }
    }
    
    public static function get_form_franch()
    {
        foreach (self::$tasks as $task)
        {
            echo $task->taskname.' ';
            if (!$task->taskdone)
                echo "<input type='checkbox' name='{$task->taskname}' value='done'></input> ";
            else if ($task->taskchecked)
                echo "checked ";
            echo '<br>'.$task->get_form().'<br><br>';
        }
        
    }
    
    public static function get_form_gala()
    {
        foreach (self::$tasks as $task)
        {
            echo $task->taskname.' ';
            if ($task->taskdone && !$task->taskchecked)
                echo "<input type='radio' name='{$task->taskname}' value='good'>Ок</input> "
                . "<input type='radio' name='{$task->taskname}' value='bad'>Упс</input> ";
            echo "<br><br>";
            //echo $task->get_form().'\n';
        }
    }
}
