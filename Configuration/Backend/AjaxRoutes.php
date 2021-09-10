<?php

use SimonSchaufi\LockElement\Controller\ChristmasCampaignController;

return [
    'hide-christmas-campaign' => [
        'path' => '/lock-element/hide-christmas-campaign',
        'target' => ChristmasCampaignController::class . '::hideChristmasCampaignAction'
    ]
];
