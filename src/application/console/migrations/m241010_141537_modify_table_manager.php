<?php

use yii\db\Migration;

final class m241010_141537_modify_table_manager extends Migration
{
    public function up(): void
    {
        $this->addColumn(
            \application\common\entities\Manager::$tableName,
            'status_send_to_external',
            $this->string(16),
        );
    }

    public function down(): void
    {
        $this->dropColumn(
            \application\common\entities\Manager::$tableName,
            'status_send_to_external',
        );
    }
}
