<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Connection;
use yii\base\ErrorException;

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
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> da15e853c8464a63a94da72fa36432900a57eb83
	private function getCurrentUserId()
	{
		return Yii::$app->user->id;
	}
<<<<<<< HEAD
=======
=======

>>>>>>> 911a7bd99989615ef3fced0017d323ba8635ae56
>>>>>>> da15e853c8464a63a94da72fa36432900a57eb83
	private function getCurrentDate()
	{
		return date('l jS \of F Y h:i:s A');
	}
	public  function addData($userId)
	{
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> da15e853c8464a63a94da72fa36432900a57eb83
		try
		{
			$userId=$this->getCurrentUserId();

<<<<<<< HEAD
=======
=======

		try
		{
>>>>>>> 911a7bd99989615ef3fced0017d323ba8635ae56
>>>>>>> da15e853c8464a63a94da72fa36432900a57eb83
			$tasksData=new TasksData();
			$tasksData->Task=$this->task;

			$taskStart=date(strtotime($this->taskStart));
			$taskEnd=date(strtotime($this->taskEnd));
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
			//
			//file_put_contents('tmp.txt',$taskStart);
			//
>>>>>>> 911a7bd99989615ef3fced0017d323ba8635ae56
>>>>>>> da15e853c8464a63a94da72fa36432900a57eb83

			$tasksData->Task_start_date=$taskStart;
			$tasksData->Task_end_date=$taskEnd;
				
			$tasksData->taskInfo=$this->taskInformation;

			/*$taskData->Date=$this->getCurrentDate();*/

<<<<<<< HEAD
			//$tasksData->userId=$userId;
=======
<<<<<<< HEAD
			//$tasksData->userId=$userId;
=======
			//$tasksData->user_id=$userId;
>>>>>>> 911a7bd99989615ef3fced0017d323ba8635ae56
>>>>>>> da15e853c8464a63a94da72fa36432900a57eb83
			
			$tasksData->save();
		}
		catch(ErrorException $err)
		{
			throw $err;
		}

	}
}


?>