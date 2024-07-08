<?php

use yii\db\Migration;

final class m240708_175206_create_table_event_to_manager extends Migration
{
    public function up(): void
    {
        $this->createTable(
            \application\common\entities\EventToManager::$tableName,
            [
                'id' => $this->primaryKey(),
                'event_id' => $this->integer(),
                'manager_id' => $this->integer(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
            ]
        );
    }

    public function down(): void
    {
        $this->dropTable(
            \application\common\entities\EventToManager::$tableName
        );
    }
}
