<?php

use yii\db\Migration;

/**
 * Class m221210_123253_add_api_token_columns_in_user_table
 */
class m221210_123253_add_api_token_columns_in_user_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'api_token', $this->string()->defaultValue(null));
        $this->addColumn('{{%user}}', 'api_token_expire', $this->integer()->defaultValue(null));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'api_token');
        $this->dropColumn('{{%user}}', 'api_token_expire');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221210_123253_add_api_token_columns_in_user_table cannot be reverted.\n";

        return false;
    }
    */
}
