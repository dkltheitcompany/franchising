<?php

echo "Сообщения:<br><br>";

foreach (model_chat::$messages as $key => $value)
{
    echo $value['mestext'].'<br>';
    echo 'Task: '.$value['taskid'].'<br>';
    echo 'Date: '.$value['mesdate'].'<br><br>';
}

