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
                model_project::take_form_franch();
                view_project::make_info_franchisor(model_project::info_franchisor());
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
    
    public static function project_info($userid)
    {
        session_start();
        if (isset($_SESSION['userid']))
        {
            switch ($_SESSION['usertype'])
            {
            case 'franchisor':
                http_response_code(404);
                break;
            case 'coordinator':
                model_project::take_form_coord($userid);
                view_project::make_info_coordinator(model_project::info_coordinator($userid));
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
