<?php

class model_project
{
    public static function list_franch()
    {
        DataBase::querry('coord_list_find_franchisor');
        return DataBase::fetch_all();
    }
    
    public static function list_pm()
    {
        DataBase::querry('coord_list_find_pm');
        return DataBase::fetch_all();
    }
    
    public static function stage_info()
    {
        DataBase::querry('stage_info_franchisor', $_SESSION['userid']);
        return DataBase::fetch();
    }
}