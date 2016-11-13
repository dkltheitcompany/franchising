<?php

return [
    
    'check_unique' => [
        'querry' => 'SELECT usermail, userpnum FROM user WHERE '
        . 'usermail=:usermail OR userpnum=:userpnum '
        . 'UNION '
        . 'SELECT usermail, userpnum FROM user_tmp WHERE '
        . 'usermail=:usermail OR userpnum=:userpnum',
        'args' => [':usermail', ':userpnum']
    ],
    
    'add_user_tmp' => [
        'querry' => 'INSERT INTO user_tmp (usercode, userfname, usersname, usertname, usermail, userpnum, userpassword) '
        . 'VALUES (:usercode, :userfname, :usersname, :usertname, :usermail, :userpnum, :userpassword)',
        'args' => [':usercode', ':userfname', ':usersname', ':usertname', ':usermail', ':userpnum', ':userpassword']
    ],
    
    'check_code_user_tmp' => [
        'querry' => 'SELECT usercode, userfname, usersname, usertname, usermail, userpnum, userpassword FROM user_tmp WHERE usercode=:usercode AND usermail=:usermail',
        'args' => [':usercode', ':usermail']
    ],
    
    'repeat_apply_user_tmp' => [
        'querry' => 'SELECT usercode FROM user_tmp WHERE usermail=:usermail',
        'args' => [':usermail']
    ],
    
    'delete_user_tmp' => [
        'querry' => 'DELETE FROM user_tmp WHERE usercode=:usercode',
        'args' => [':usercode']
    ],
    
    'add_user' => [
        'querry' => 'INSERT INTO user (userfname, usersname, usertname, usermail, userpnum, userpassword, usertype) '
        . 'VALUES (:userfname, :usersname, :usertname, :usermail, :userpnum, :userpassword, :usertype)',
        'args' => [':userfname', ':usersname', ':usertname', ':usermail', ':userpnum', ':userpassword', ':usertype']
    ],
    
    'auth_find_user' => [
        'querry' => 'SELECT userid, userfname, usersname, userpassword, usertype FROM user WHERE userpnum=:userpnum',
        'args' => [':userpnum']
    ],
    
    'delete_user' => [
        'querry' => 'DELETE FROM user_tmp WHERE userid=:userid',
        'args' => [':userid']
    ],
    
    'reset_find_user'=> [
        'querry' => 'SELECT userid FROM user WHERE usermail=:usermail',
        'args' => [':usermail']
    ],
    
    'new_password_user'=> [
        'querry' => 'UPDATE user SET userpassword=:userpassword WHERE userid=:userid',
        'args' => [':userid', ':userpassword']
    ],
    
    'add_reset' => [
        'querry' => 'INSERT INTO reset (userid, hash) VALUES (:userid, :hash)',
        'args' => [':userid', ':hash']
    ],
    
    'find_hash_reset' => [
        'querry' => 'SELECT userid FROM reset WHERE hash=:hash',
        'args' => [':hash']
    ],
    
    'delete_reset' => [
        'querry' => 'DELETE FROM reset WHERE userid=:userid',
        'args' => [':userid']
    ],
    
    'add_new_franchisor' => [
        'querry' => 'INSERT INTO franchisor (userid, cityid, stage) VALUES (:userid, :cityid, \'application\')',
        'args' => [':userid', ':cityid']
    ],
    
    'coord_list_find_franchisor' => [
        'querry' => 'SELECT user.*, franchisor.* FROM user, franchisor WHERE franchisor.stage IN (\'application\', \'contract\') AND user.userid=franchisor.userid',
        'args' => []
    ],
    
    'stage_info_franchisor' => [
        'querry' => 'SELECT stage, applied, lasupdate FROM franchisor WHERE userid=:userid',
        'args' => [':userid']
    ],
    
    'coord_list_find_pm' => [
        'querry' => 'SELECT user.*, pm.* FROM user, pm WHERE user.userid=pm.userid',
        'args' => []
    ],

    'project_info'=>[
        'querry'=>'SELECT user.*, franchisor.* FROM user, franchisor WHERE user.userid=:userid AND franchisor.userid=:userid',
        'args'=>[':userid']
    ],
];