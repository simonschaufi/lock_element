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

namespace SimonSchaufi\LockElement\EventListener;

use TYPO3\CMS\Backend\View\Event\ModifyDatabaseQueryForRecordListingEvent;
use TYPO3\CMS\Core\Attribute\AsEventListener;

#[AsEventListener(identifier: 'lock-element/modify-database-query-for-record-listing')]
final class ModifyDatabaseQueryForRecordListingEventListener
{
    public function __invoke(ModifyDatabaseQueryForRecordListingEvent $event): void
    {
        if ($event->getTable() !== 'tt_content') {
            return;
        }

        if (($event->getFields()[0] ?? null) === '*') {
            return;
        }

        $queryBuilder = $event->getQueryBuilder();
        $queryBuilder->addSelect('tx_lockelement_locked');
        $event->setQueryBuilder($queryBuilder);
    }
}
