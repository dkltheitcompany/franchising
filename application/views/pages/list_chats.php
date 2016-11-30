<?php

foreach (model_chat::$companions as $value)
{
    echo "<a href='/chat/{$value['userid']}'>{$value['userfname']} {$value['usersname']} {$value['usertname']}</a><br>";
}