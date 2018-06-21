<?php

use yii\db\Migration;

/**
 * Handles the creation of table `app`.
 */
class m180503_090313_create_app_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%app}}', [
            'id' => $this->primaryKey(),
            'app_name' => $this->string(32)->notNull()->comment('App名称'),
            'app_description' => $this->string(125)->notNull()->defaultValue('')->comment('App简介'),
            'app_key' => $this->char(36)->notNull()->comment('App Key'),
            'app_secret' => $this->char(32)->notNull()->comment('App Secret'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('更新时间'),
            'status' => $this->boolean()->notNull()->defaultValue(1)->comment('状态'),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%app}}');
    }
}
