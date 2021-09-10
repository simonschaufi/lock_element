<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * (c) Simon Schaufelberger
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace SimonSchaufi\LockElement\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Registry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class ChristmasCampaignController
{
    /**
     * AJAX endpoint for hiding the christmas campaign for the current year
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function hideChristmasCampaignAction(ServerRequestInterface $request): ResponseInterface
    {
        $registry = GeneralUtility::makeInstance(Registry::class);
        $registry->set('lock_element', 'hideChristmasCampaign-' . date('Y'), true);

        $message = LocalizationUtility::translate(
            'tx_lockelement_donate.christmas_campaign_hidden',
            'LockElement'
        );

        return new JsonResponse([
            'success' => true,
            'message' => $message
        ]);
    }
}
