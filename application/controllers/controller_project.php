<?php

include ROOT.'/application/models/model_project.php';
include ROOT.'/application/views/view_project.php';

class controller_project
{
    public static function index()
    {
        session_start();
        if (isset($_SESSION['userid']))
        {
            switch ($_SESSION['usertype'])
            {
            case 'franchisor':
                view_project::make_stage(model_project::stage_info());
                break;
            case 'coordinator':
                view_project::make_list_franch(model_project::list_franch());
                break;
            case 'project_manager':
                view_project::make();
                break;
            }
        }
        else
            header("Location: /authorization");
    }
}
