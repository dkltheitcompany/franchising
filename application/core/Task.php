<?php

class Task
{
    public $taskid;
    public $taskname;
    public $userid;
    public $forpm;
    public $files;
    public $fileid;
    public $taskdone;
    public $taskrejected;
    public $taskmsg;
    public $taskchecked;
    public $taskdate;
    
    public $updated;
    
    public function __construct($task)
    {
        $this->taskid = $task['taskid'];
        $this->taskname = $task['taskname'];
        $this->userid = $task['userid'];
        $this->forpm = $task['forpm'];
        $this->files = $task['files'];
        $this->fileid = $task['fileid'];
        $this->taskdone = $task['taskdone'];
        $this->taskrejected = $task['taskrejected'];
        $this->taskmsg = $task['taskmsg'];
        $this->taskchecked = $task['taskchecked'];
        $this->taskdate = $task['taskdate'];
        
        $this->updated = 0;
    }
    
    public function get_form()
    {
        $task_data = include ROOT.'/application/config/task_data.php';
        return $task_data[$this->taskname].'<br>'.$this->taskmsg;
    }
    
    public function get_msg()
    {
        return "$this->taskmsg<input type='text' name='{$this->taskname}_msg' value=''></input>";
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
        {
            $taskdeadline = time() + $task['taskdeadline'] * 24 * 60 * 60;
            DataBase::querry("INSERT INTO task (taskname, userid, forpm, files, taskdeadline) VALUES ('{$task['taskname']}', $userid, {$task['forpm']}, {$task['files']}, FROM_UNIXTIME($taskdeadline));");
            $lastid = DataBase::last_insert_id();
            DataBase::querry("INSERT INTO taskmsg (taskid, taskmsg) VALUES ($lastid, '');");
        }
    }
    
    public static function load($userid)
    {
        DataBase::querry("SELECT task.*, taskmsg.taskmsg FROM task, taskmsg WHERE task.userid=$userid AND task.taskid=taskmsg.taskid");
        while (!empty($task = DataBase::fetch()))
        {
            self::$tasks[$task['taskname']] = new Task($task);
        }
    }
    
    public function done($taskname)
    {
        if (self::$tasks[$taskname]->files)
        {
            if (empty($_FILES[$taskname.'_file']) || $_FILES[$taskname.'_file']['error'] != 0)
            {
                return;
            }
            else
            {
                File::save_file($taskname.'_file');
                self::$tasks[$taskname]->fileid = DataBase::last_insert_id();
            }
        }
        self::$tasks[$taskname]->updated = true;
        self::$tasks[$taskname]->taskrejected = 0;
        self::$tasks[$taskname]->taskdone = true;
    }
    
    public function checked_good($taskname, $msg)
    {
        self::$tasks[$taskname]->updated = true;
        self::$tasks[$taskname]->taskrejected = 0;
        self::$tasks[$taskname]->taskchecked = true;
        if (!empty($msg))
            self::$tasks[$taskname]->taskmsg .= '<pre>CONFIRMED: '.$msg.'</pre>'."\n";
        foreach (self::$tasks as $task)
        {
             if (!$task->taskchecked)
                return;
        }
        self::$next_stage = true;
    }
    
    public function checked_bad($taskname, $msg)
    {
        self::$tasks[$taskname]->updated = true;
        self::$tasks[$taskname]->taskrejected = 1;
        self::$tasks[$taskname]->taskdone = 0;
        if (!empty($msg))
            self::$tasks[$taskname]->taskmsg .= '<pre>REJECTED: '.$msg.'</pre>'."\n";
    }
    
    public static function save()
    {
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
                $taskdeadline = time() + $new_task['taskdeadline'] * 24 * 60 * 60;
                DataBase::querry("INSERT INTO task (taskname, userid, forpm, files, taskdeadline) VALUES ('{$new_task['taskname']}', $userid, {$new_task['forpm']}, {$new_task['files']}, FROM_UNIXTIME($taskdeadline));");
                $lastid = DataBase::last_insert_id();
                DataBase::querry("INSERT INTO taskmsg (taskid, taskmsg) VALUES ($lastid, '');");
            }
            self::load($userid);
        }
        else
        {
            foreach (self::$tasks as $task)
            {
                if ($task->updated)
                {
                    DataBase::querry("UPDATE `task` "
                            . "SET `taskdone`=$task->taskdone, `taskrejected`=$task->taskrejected, `taskchecked`=$task->taskchecked, `taskdate`=NOW() "
                            . "WHERE `taskid`=$task->taskid");
                    if (!empty($task->fileid))
                        DataBase::querry("UPDATE `task` "
                                . "SET `fileid`=$task->fileid "
                                . "WHERE `taskid`=$task->taskid");
                    if (!empty($task->taskmsg))
                        DataBase::querry("UPDATE taskmsg "
                                . "SET taskmsg='$task->taskmsg' "
                                . "WHERE taskid=$task->taskid");
                }
            }
        }
    }
    
    public static function get_form_franch()
    {
        foreach (self::$tasks as $task)
        {
            if ($task->forpm)
                continue;
            echo $task->taskname.' ';
            if (!$task->taskdone)
            {
                echo "<input type='checkbox' name='{$task->taskname}' value='done'></input> ";
                if ($task->files)
                {
                    echo "<input type='file' name='{$task->taskname}_file'></input> ";
                }
            }
            echo '<br>'.$task->get_form().'<br><br>';
        }
        echo 'Задания Руководителя Проэктом:<br>';
        foreach (self::$tasks as $task)
        {
            if (!$task->forpm)
               continue;
            echo $task->taskname.' ';
            if ($task->taskdone && !$task->taskchecked)
            {echo "<input type='radio' name='{$task->taskname}' value='good'>Ок</input> "
                . "<input type='radio' name='{$task->taskname}' value='bad'>Упс</input> ";
            if (!empty($task->fileid))
                echo "<a href='/load/{$task->fileid}' target='_blank'>Attachment</a><br>";
            echo '<br>'.$task->get_msg();}
            echo '<br><br>';
        }
        echo '<input type="submit" name="submit" value="Подтвердить">';
    }
    
    public static function get_form_gala()
    {
        foreach (self::$tasks as $task)
        {
            if (!$task->forpm)
                continue;
            echo $task->taskname.' ';
            if (!$task->taskdone)
            {
                echo "<input type='checkbox' name='{$task->taskname}' value='done'></input> ";
                if ($task->files)
                {
                    echo "<input type='file' name='{$task->taskname}_file'></input> ";
                }
            }
            echo '<br>'.$task->get_form().'<br><br>';
        }
        echo 'Задания Франчизи:<br>';
        foreach (self::$tasks as $task)
        {
            if ($task->forpm)
                continue;
            echo $task->taskname.' ';
            if ($task->taskdone && !$task->taskchecked)
            {echo "<input type='radio' name='{$task->taskname}' value='good'>Ок</input> "
                . "<input type='radio' name='{$task->taskname}' value='bad'>Упс</input> ";
            if (!empty($task->fileid))
                echo "<a href='/load/{$task->fileid}' target='_blank'>Attachment</a><br>";
            echo '<br>'.$task->get_msg();}
            echo '<br><br>';
        }
        echo '<input type="submit" name="submit" value="Подтвердить">';
    }
}
