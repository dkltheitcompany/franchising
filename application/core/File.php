<?php

class File
{
    public static function save_file($name)
    {
        $filedata = file_get_contents($_FILES[$name]['tmp_name']);
        DataBase::querry("INSERT INTO file (filename, filetype, filedata) "
                . "VALUES (:filename, :filetype, :filedata)",
                        [':filename' => $_FILES[$name]['name'],
                        ':filetype' => $_FILES[$name]['type'],
                        ':filedata' => $filedata,
                        ]);
    }
    public static function load_file($fileid)
    {
        DataBase::querry("SELECT filename, filetype, filedata FROM file WHERE fileid=$fileid LIMIT 1");
        return DataBase::fetch();
    }
}
