<?php

return [
    'reg_apply' => [
        'text' => "Код подтверждения регистрации <strong>{$data[0]}</strong>.",
        'title' => 'Подтверждение регистрации',
        'headers' => "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\n"
        ],
     'reset' => [
        'text' => "Для восстановления пороля перейдите по <a href='http://{$_SERVER['SERVER_NAME']}/reset/{$data[0]}'>ссылке</a>.",
        'title' => 'Восстановление пароля',
        'headers' => "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\n"
        ],
     'deadline_close' => [
        'text' => "Франчайзеру {$data[0]} {$data[1]} {$data[2]} осталось 3 до дедлайна.\n<a href='http://{$_SERVER['SERVER_NAME']}/reset/{$data[4]}'>Проверьте сделку</a> с ним",
        'title' => 'Дедлайн',
        'headers' => "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\n"
        ],
];