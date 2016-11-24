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
        'querry' => 'SELECT usercode, userfname, usersname, usertname, usermail, userpnum, userpassword FROM user_tmp WHERE usercode=:usercode AND usermail=:usermail LIMIT 1',
        'args' => [':usercode', ':usermail']
    ],
    'repeat_apply_user_tmp' => [
        'querry' => 'SELECT usercode FROM user_tmp WHERE usermail=:usermail LIMIT 1',
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
        'querry' => 'SELECT userid, userfname, usersname, userpassword, usertype FROM user WHERE userpnum=:userpnum LIMIT 1',
        'args' => [':userpnum']
    ],
    'delete_user' => [
        'querry' => 'DELETE FROM user_tmp WHERE userid=:userid',
        'args' => [':userid']
    ],
    'reset_find_user'=> [
        'querry' => 'SELECT userid FROM user WHERE usermail=:usermail LIMIT 1',
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
        'querry' => 'SELECT userid FROM reset WHERE hash=:hash LIMIT 1',
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
        'querry' => 'SELECT  user.userfname, user.usersname, user.userpnum, franchisor.cityid, user.userid FROM user, franchisor WHERE franchisor.havepm=0 AND user.userid=franchisor.userid',
        'args' => []
    ],
    'info_coordinator_franchisor' => [
        'querry' => 'SELECT user.userfname, user.usersname, user.usertname, user.userpnum, user.usermail, franchisor.* FROM user, franchisor WHERE franchisor.havepm=0 AND user.userid=:userid AND franchisor.userid=:userid LIMIT 1',
        'args' => [':userid']
    ],
    'info_pm_franchisor' => [
        'querry' => 'SELECT user.userid, user.userfname, user.usersname, user.usertname, user.userpnum, user.usermail, franchisor.cityid, franchisor.lastupdate FROM user, franchisor WHERE franchisor.havepm=1 AND user.userid=:userid AND franchisor.userid=:userid LIMIT 1',
        'args' => [':userid']
    ],
    'stage_info_franchisor' => [
        'querry' => 'SELECT stage, lastupdate FROM franchisor WHERE userid=:userid LIMIT 1',
        'args' => [':userid']
    ],
    
    'coord_list_find_pm' => [
        'querry' => 'SELECT user.userid, user.userfname, user.usersname, user.userpnum, user.usermail, pm.workwith FROM user, pm WHERE user.userid=pm.userid',
        'args' => []
    ],
];