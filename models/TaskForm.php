<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Connection;


class TaskForm extends Model
{
	//public $performedBy;
	//public $taskStatus;
	public $task;
	public $taskStart;
	public $taskEnd;
	public $taskInformation;
	
	public $status;
	public function rules()
	{
		return [
			['task','required'],
			['taskStart','required'],
			['taskEnd','required'],
			['taskInformation','required']
			//['status','default','value'=>1],
		];
	}
	public function addNewUserTable()
	{
		$tableName=Signup::find()->asArray()->orderBy(['id'=> SORT_DESC])->limit(1)->one();
		$tableName='tasks_data_'.$tableName['id'];
			
		$sqlCommand='CREATE TABLE IF NOT EXISTS '.$tableName.'(Id INT(3) PRIMARY KEY AUTO_INCREMENT, Task VARCHAR(50),
		taskStatus VARCHAR(20),Task_start_date date,Task_end_date date,taskInfo VARCHAR(50));';
		
		//file_put_contents('test.txt',$sqlCommand);
		$sqlResult=Yii::$app->db->createCommand($sqlCommand);
		$sqlResult->execute();
		
	}
}


?>