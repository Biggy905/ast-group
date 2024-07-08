<?php

use yii\db\Migration;

final class m240708_175155_create_table_event extends Migration
{
    public function up(): void
    {
        $this->createTable(
            \application\common\entities\Event::$tableName,
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(128),
                'description' => $this->text(),
                'date' => $this->dateTime(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
            ]
        );
    }

    public function down(): void
    {
        $this->dropTable(
            \application\common\entities\Event::$tableName
        );
    }
}
