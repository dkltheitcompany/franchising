<?php

return [
    'username' => '^[А-ЯЁ][а-яё]+$',
    'usermail' => '^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$',
    'userpnum' => '^\d{11}$',
    'userpassword' => '^[a-zA-Z0-9_]{6,20}$'
];