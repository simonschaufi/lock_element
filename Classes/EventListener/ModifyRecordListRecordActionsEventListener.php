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

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use TYPO3\CMS\Backend\RecordList\Event\ModifyRecordListRecordActionsEvent;
use TYPO3\CMS\Backend\Template\Components\ActionGroup;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Domain\RawRecord;

#[AsEventListener(identifier: 'lock-element/modify-record-list-record-actions')]
final class ModifyRecordListRecordActionsEventListener
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ModifyRecordListRecordActionsEvent $event): void
    {
        $record = $event->getRecord();
        $rawRecord = $record->getRawRecord();
        if (! $rawRecord instanceof RawRecord) {
            return;
        }

        if (! $rawRecord->has('tx_lockelement_locked')) {
            return;
        }

        $locked = $rawRecord->get('tx_lockelement_locked');
        if ($locked) {
            $event->removeAction('delete', ActionGroup::primary);
        }
    }
}
