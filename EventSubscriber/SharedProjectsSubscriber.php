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

class SharedProjectsSubscriber extends AbstractActionsSubscriber
{
    public static function getActionName(): string
    {
        return 'shared_projects';
    }

    public function onActions(PageActionsEvent $event): void
    {
        $event->addCreate($this->path('create_shared_project_timesheets'));
    }
}
