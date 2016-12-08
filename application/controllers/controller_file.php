<?php

class controller_file
{
    public static function load($fileid)
    {
        $file = File::load_file($fileid);
        $tmp_name = $fileid.'_tmp';
        file_put_contents($tmp_name, $file['filedata']);
        if (ob_get_level()) {
          ob_end_clean();
            }
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file['filename']));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '.filesize($tmp_name));
        readfile($tmp_name);
        unlink($tmp_name);
    }
}
