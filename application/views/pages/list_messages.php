<?php

include ROOT.'/application/views/forms/send_message_form.php';

echo "<b>Сообщения:</b><br><br>";

foreach (model_chat::$messages as $key => $value)
{
    echo $value['mestext'].'<br>';
    echo 'From: '.$value['senduserid'].'<br>';
    echo 'To: '.$value['desuserid'].'<br>';
    echo 'Date: '.$value['mesdate'].'<br><br>';
}

