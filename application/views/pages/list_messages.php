<?php

include ROOT.'/application/views/forms/send_message_form.php';

echo "<b>Сообщения:</b><br><br>";

foreach (model_chat::$messages as $key => $value)
{
    echo $value['mestext'].'<br>';
    echo 'From: '.$value['senduserfname'].' '.$value['sendusersname'].' '.$value['sendusertname'].'<br>';
    echo 'To: '.$value['desuserfname'].' '.$value['desusersname'].' '.$value['desusertname'].'<br>';
    echo 'Date: '.$value['mesdate'].'<br><br>';
}

