<?php

use yii\db\Migration;

/**
 * Class m241021_113912_auth
 */
class m241021_113912_auth extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241021_113912_auth cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
		$this->createTable('tasks_data',
		['id'=>$this->integer(50),
		'username'=>$this->string(5),
		'password'=>$this->string(250),
		'auth_key'=>$this->string(50)
		]
		
		);
    }

    public function down()
    {
        echo "m241021_113912_auth cannot be reverted.\n";

        return false;
    }
    
}
