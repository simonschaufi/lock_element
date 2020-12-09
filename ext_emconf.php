<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Lock Element',
    'description' => 'A locked element can\'t be deleted.',
    'category' => 'be',
    'version' => '2.2.1',
    'state' => 'stable',
    'uploadfolder' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => false,
    'author' => 'Simon Schaufelberger',
    'author_email' => 'simonschaufi+lockelement@gmail.com',
    'author_company' => '',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-10.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
