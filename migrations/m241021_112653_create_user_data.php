<?php

use yii\db\Migration;

/**
 * Class m241021_112653_create_user_data
 */
class m241021_112653_create_user_data extends Migration
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
        echo "m241021_112653_create_user_data cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
		$this->createTable('tasks_data',
		['Task'=>$this->string(50),
		//'taskNumber'=>$this->integer(5)->notNull(),
        'taskNumber'=>$this->primaryKey(11),
		'taskStatus'=>$this->string(20),
		'Task_start_date'=>$this->date(),
		'Task_end_date'=>$this->date(),
		'taskInfo'=>$this->string(90)
		]);
        
        ///
        $this->alterColumn('{{%tasks_data}}','taskNumber',$this->integer(8).' NOT NULL AUTO_INCREMENT');
		///
    }

    public function down()
    {
        echo "m241021_112653_create_user_data cannot be reverted.\n";

        return false;
    }
    
}
