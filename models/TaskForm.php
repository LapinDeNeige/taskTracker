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
	private function getCurrentUserId()
	{
		return Yii::$app->user->id;
	}
=======

>>>>>>> 911a7bd99989615ef3fced0017d323ba8635ae56
	private function getCurrentDate()
	{
		return date('l jS \of F Y h:i:s A');
	}
	public  function addData($userId)
	{
<<<<<<< HEAD
		try
		{
			$userId=$this->getCurrentUserId();

=======

		try
		{
>>>>>>> 911a7bd99989615ef3fced0017d323ba8635ae56
			$tasksData=new TasksData();
			$tasksData->Task=$this->task;

			$taskStart=date(strtotime($this->taskStart));
			$taskEnd=date(strtotime($this->taskEnd));
<<<<<<< HEAD
=======
			//
			//file_put_contents('tmp.txt',$taskStart);
			//
>>>>>>> 911a7bd99989615ef3fced0017d323ba8635ae56

			$tasksData->Task_start_date=$taskStart;
			$tasksData->Task_end_date=$taskEnd;
				
			$tasksData->taskInfo=$this->taskInformation;

			/*$taskData->Date=$this->getCurrentDate();*/

<<<<<<< HEAD
			//$tasksData->userId=$userId;
=======
			//$tasksData->user_id=$userId;
>>>>>>> 911a7bd99989615ef3fced0017d323ba8635ae56
			
			$tasksData->save();
		}
		catch(ErrorException $err)
		{
			throw $err;
		}

	}
}


?>