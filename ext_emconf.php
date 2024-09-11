<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Lock Element',
    'description' => 'A locked element can\'t be deleted.',
    'category' => 'be',
    'version' => '4.0.0',
    'state' => 'stable',
    'author' => 'Simon Schaufelberger',
    'author_email' => 'simonschaufi+lockelement@gmail.com',
    'author_company' => '',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
