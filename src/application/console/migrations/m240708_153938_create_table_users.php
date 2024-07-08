<?php

use yii\db\Migration;

final class m240708_153938_create_table_users extends Migration
{
    public function up(): void
    {
        $this->createTable(
            \application\common\entities\User::$tableName,
            [
                'id' => $this->primaryKey(),
                'username' => $this->string(16),
                'email' => $this->string(64),
                'password' => $this->string(64),
                'token_access' => $this->string(128),
                'token_refresh' => $this->string(128),
                'token_created' => $this->dateTime(),
                'name' => $this->string(16),
                'surname' => $this->string(16),
                'file_id' => $this->integer(),
                'ip' => $this->string(16),
                'logget_at' => $this->dateTime(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
            ]
        );

        $this->insert(
            \application\common\entities\User::$tableName,
            [
                'id' => 1,
                'username' => 'new_admin',
                'email' => 'admin@examples.ru',
                'password' => '$2y$13$0C5Vo5Wjeng9pL8MSgksy.hppM3RKLTsllg2/462Yred266vMJnwe',
                'token_access' => '',
                'token_refresh' => '',
                'token_created' => '',
                'name' => 'Admin',
                'surname' => 'Adminer',
                'created_at' => \application\common\helpers\DateTimeHelper::getDateTime()
                    ->format(\application\common\enums\DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value),
            ]
        );
    }

    public function down(): void
    {
        $this->dropTable(\application\common\entities\User::$tableName);
    }
}
