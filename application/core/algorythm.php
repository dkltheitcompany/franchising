<?php

function change_key($key, $new_key, &$arr, $rewrite=true)
{
    if(!array_key_exists($new_key, $arr) || $rewrite)
    {
        $arr[$new_key] = $arr[$key];
        unset($arr[$key]);
        return true;
    }
    return false;
}

function run_php($filename, $data)
{
     file_get_contents($filename);
}