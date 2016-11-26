<?php

return [
    '^/?$' => ['controller' => 'main', 'action'=> 'index'],
    '^/root/?$' => ['controller' => 'root', 'action'=> 'index'],
    '^/registration/?$' => ['controller' => 'registration', 'action'=> 'index'],
    '^/registration/repeat/?$' => ['controller' => 'registration', 'action'=> 'repeat'],
    '^/registration/confirm/?$' => ['controller' => 'registration', 'action'=> 'confirm'],
    '^/authorization/?$' => ['controller' => 'authorization', 'action'=> 'index'],
    '^/exit/?$' => ['controller' => 'authorization', 'action'=> 'exit_account'],
    '^/project/?$' => ['controller' => 'project', 'action'=> 'index'],
    '^/project/([0-9]+)/?$' => ['controller' => 'project', 'action'=> 'project_info', 'args' => '$1'],
    '^/reset/?$' => ['controller' => 'authorization', 'action' => 'apply_reset_password'],
    '^/reset/(.{40})$' => ['controller' => 'authorization', 'action' => 'reset', 'args' => '$1'],
    '^/chat/?$' => ['controller' => 'chat', 'action' => 'index']
];