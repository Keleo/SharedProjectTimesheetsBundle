<?php

/*
 * This file is part of the "Shared Project Timesheets Bundle" for Kimai.
 * All rights reserved by Fabian Vetter (https://vettersolutions.de).
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace KimaiPlugin\SharedProjectTimesheetsBundle\Migrations;

use App\Doctrine\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;

final class Version2020122010000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add flags to enable charts of shared project timesheets';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable(Version2020120600000::SHARED_PROJECT_TIMESHEETS_TABLE_NAME);

        $table->addColumn('annual_chart_visible', Types::BOOLEAN, ['default' => false, 'notnull' => true]);
        $table->addColumn('monthly_chart_visible', Types::BOOLEAN, ['default' => false, 'notnull' => true]);
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable(Version2020120600000::SHARED_PROJECT_TIMESHEETS_TABLE_NAME);

        $table->dropColumn('annual_chart_visible');
        $table->dropColumn('monthly_chart_visible');
    }
}
