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
	private function getCurrentUserId()
	{
		return Yii::$app->user->id;
	}
	private function getCurrentDate()
	{
		return date('l jS \of F Y h:i:s A');
	}
	public  function addData($userId)
	{
		try
		{
			$userId=$this->getCurrentUserId();

			$tasksData=new TasksData();
			$tasksData->Task=$this->task;

			$taskStart=date(strtotime($this->taskStart));
			$taskEnd=date(strtotime($this->taskEnd));

			$tasksData->Task_start_date=$taskStart;
			$tasksData->Task_end_date=$taskEnd;
				
			$tasksData->taskInfo=$this->taskInformation;

			/*$taskData->Date=$this->getCurrentDate();*/

			//$tasksData->userId=$userId;
			
			$tasksData->save();
		}
		catch(ErrorException $err)
		{
			throw $err;
		}

	}
}


?>