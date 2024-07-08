<?php

use yii\db\Migration;

final class m240708_175211_create_table_manager extends Migration
{
    public function up(): void
    {
        $this->createTable(
            \application\common\entities\Manager::$tableName,
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(32),
                'surname' => $this->string(64),
                'email' => $this->string(128),
                'phone' => $this->string(11),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
            ]
        );
    }

    public function down(): void
    {
        $this->dropTable(
            \application\common\entities\Manager::$tableName
        );
    }
}
