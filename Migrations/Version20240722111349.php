<?php

/*
 * This file is part of the "Shared Project Timesheets Bundle" for Kimai.
 * All rights reserved by Fabian Vetter (https://vettersolutions.de).
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace KimaiPlugin\SharedProjectTimesheetsBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20240722111349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add flags to enable/disable project statistics';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable(Version2020120600000::SHARED_PROJECT_TIMESHEETS_TABLE_NAME);

        $table->addColumn('budget_stats_visible', Types::BOOLEAN, ['default' => false, 'notnull' => true]);
        $table->addColumn('time_budget_stats_visible', Types::BOOLEAN, ['default' => false, 'notnull' => true]);
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable(Version2020120600000::SHARED_PROJECT_TIMESHEETS_TABLE_NAME);

        $table->dropColumn('budget_stats_visible');
        $table->dropColumn('time_budget_stats_visible');
    }
}
