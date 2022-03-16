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

namespace SimonSchaufi\LockElement\UserFunction;

use DateInterval;
use DateTime;
use TYPO3\CMS\Backend\Form\Element\UserElement;
use TYPO3\CMS\Core\Registry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class TCA
{
    private static ?DateInterval $intervalCache = null;

    public function donateField(array $parameters, ?UserElement $pObj): string
    {
        $text = LocalizationUtility::translate('tx_lockelement_donate.text', 'LockElement');
        $paypalDonateButtonText = LocalizationUtility::translate(
            'tx_lockelement_donate.paypal_donate_button_text',
            'LockElement'
        );
        $githubDonateButtonText = LocalizationUtility::translate(
            'tx_lockelement_donate.github_donate_button_text',
            'LockElement'
        );
        return <<<HTML
            <p>$text <i class="fa fa-smile-o" aria-hidden="true"></i></p>
            <a href="https://www.paypal.me/simonschaufi" target="_blank" class="btn btn-default">
                <strong><i class="fa fa-paypal" style="color: #0070ba;" aria-hidden="true"></i> $paypalDonateButtonText</strong>
            </a>
            <a href="https://github.com/sponsors/simonschaufi" target="_blank" class="btn btn-default">
                <strong><i class="fa fa-heart" style="color: #ea4aaa;" aria-hidden="true"></i> $githubDonateButtonText</strong>
            </a>
HTML;
    }

    /**
     * @throws \Exception
     * @see https://thisinterestsme.com/php-days-until-christmas/
     */
    public function christmasCampaign(array $parameters, ?UserElement $pObj): string
    {
        $interval = static::getChristmasInterval();

        // Check for errors
        if (!$interval instanceof DateInterval) {
            return '';
        }

        $headline = LocalizationUtility::translate(
            'tx_lockelement_donate.christmas_campaign_headline',
            'LockElement',
            [$interval->days]
        );
        $text = LocalizationUtility::translate(
            'tx_lockelement_donate.christmas_campaign_text',
            'LockElement'
        );
        $paypalDonateButtonText = LocalizationUtility::translate(
            'tx_lockelement_donate.christmas_campaign_paypal_donate_button_text',
            'LockElement'
        );
        $githubDonateButtonText = LocalizationUtility::translate(
            'tx_lockelement_donate.christmas_campaign_github_donate_button_text',
            'LockElement'
        );
        $hide = LocalizationUtility::translate(
            'tx_lockelement_donate.christmas_campaign_hide',
            'LockElement'
        );

        return <<<HTML
            <div id="christmasCampaignWrapper">
                <h4>$headline</h4>
                <p>$text <i class="fa fa-smile-o" aria-hidden="true"></i></p>
                <a href="https://www.paypal.me/simonschaufi" target="_blank" class="btn btn-default">
                    <strong><i class="fa fa-paypal" style="color: #0070ba;" aria-hidden="true"></i> $paypalDonateButtonText</strong>
                </a>
                <a href="https://github.com/sponsors/simonschaufi" target="_blank" class="btn btn-default">
                    <strong><i class="fa fa-heart" style="color: #ea4aaa;" aria-hidden="true"></i> $githubDonateButtonText</strong>
                </a>
                <button type="button" id="hideChristmasCampaignElement" class="btn btn-default">
                    <i class="fa fa-times" aria-hidden="true"></i> $hide
                </button>
            </div>
HTML;
    }

    /**
     * @throws \Exception
     */
    public static function showChristmasCampaign(): bool
    {
        $registry = GeneralUtility::makeInstance(Registry::class);
        $hideChristmasCampaign = $registry->get('lock_element', 'hideChristmasCampaign-' . date('Y'));

        if ($hideChristmasCampaign) {
            return false;
        }

        $interval = static::getChristmasInterval();

        // Check for errors
        if (!$interval instanceof DateInterval) {
            return false;
        }

        return $interval->days < 31;
    }

    /**
     * @return DateInterval|false
     * @throws \Exception
     */
    private static function getChristmasInterval()
    {
        if (self::$intervalCache instanceof DateInterval) {
            return self::$intervalCache;
        }

        $today = (new DateTime())->setTime(0, 0);
        $christmasDay = (new DateTime())
            ->setDate((int)$today->format('Y'), 12, 25)
            ->setTime(0, 0);

        // Have we already passed this year's Christmas day?
        if ($today > $christmasDay) {
            // Use next year's Christmas day.
            $christmasDay->modify('+1 year');
        }

        self::$intervalCache = $today->diff($christmasDay);

        return self::$intervalCache;
    }
}
