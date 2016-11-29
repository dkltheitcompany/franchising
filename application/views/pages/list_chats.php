<?php

foreach (model_chat::$companions as $value)
{
    $href = "'/chat/$value'";
    echo "<a href=$href>$value</a><br>";
}