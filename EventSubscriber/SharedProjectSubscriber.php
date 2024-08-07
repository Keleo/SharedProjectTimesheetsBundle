<?php

/*
 * This file is part of the "Shared Project Timesheets Bundle" for Kimai.
 * All rights reserved by Fabian Vetter (https://vettersolutions.de).
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace KimaiPlugin\SharedProjectTimesheetsBundle\EventSubscriber;

use App\Event\PageActionsEvent;
use App\EventSubscriber\Actions\AbstractActionsSubscriber;
use KimaiPlugin\SharedProjectTimesheetsBundle\Entity\SharedProjectTimesheet;

class SharedProjectSubscriber extends AbstractActionsSubscriber
{
    public static function getActionName(): string
    {
        return 'shared_project';
    }

    public function onActions(PageActionsEvent $event): void
    {
        $payload = $event->getPayload();

        if (!\is_array($payload) || !\array_key_exists('sharedProject', $payload)) {
            return;
        }

        /** @var SharedProjectTimesheet $sharedProject */
        $sharedProject = $payload['sharedProject'];

        if ($sharedProject->getId() === null || $sharedProject->getType() === null) {
            return;
        }

        $event->addEdit($this->path('update_shared_project_timesheets', ['sharedProject' => $sharedProject->getId(), 'shareKey' => $sharedProject->getShareKey()]));

        if ($sharedProject->isCustomerSharing()) {
            $event->addAction('customer', ['url' => $this->path('customer_details', ['id' => $sharedProject->getCustomer()->getId()])]);
        } else {
            $event->addAction('project', ['url' => $this->path('project_details', ['id' => $sharedProject->getProject()->getId()])]);
        }

        $event->addDelete($this->path('remove_shared_project_timesheets', ['sharedProject' => $sharedProject->getId(), 'shareKey' => $sharedProject->getShareKey()]), false);
    }
}
