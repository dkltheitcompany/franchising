<?php

return [
    'application' => [
        ['taskname' => 'task1', 'forpm' => 0, 'taskdeadline' => 3, 'files' => 1],
        ['taskname' => 'task2', 'forpm' => 0, 'taskdeadline' => 3, 'files' => 0]
    ],
    'contract' => [
        ['taskname' => 'task3', 'forpm' => 0, 'taskdeadline' => 3, 'files' => 0],
        ['taskname' => 'task4', 'forpm' => 0, 'taskdeadline' => 3, 'files' => 1]
    ],
    'schedule' => [
        ['taskname' => 'task5', 'forpm' => 0, 'taskdeadline' => 3, 'files' => 1],
        ['taskname' => 'taktak', 'forpm' => true, 'taskdeadline' => 3, 'files' => 0],
        ['taskname' => 'ffs', 'forpm' => true, 'taskdeadline' => 3, 'files' => 0],
        ['taskname' => 'task6', 'forpm' => 0, 'taskdeadline' => 3, 'files' => 1]
    ], 
    'execution' => [
        ['taskname' => 'Clickbait', 'forpm' => true, 'taskdeadline' => 3, 'files' => 1],
        ['taskname' => 'task7', 'forpm' => 0, 'taskdeadline' => 3, 'files' => 0],
        ['taskname' => 'task8', 'forpm' => 0, 'taskdeadline' => 3, 'files' => 0]
    ],
    'finish' => []
];