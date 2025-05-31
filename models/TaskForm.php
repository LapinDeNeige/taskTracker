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

	public  function addData($userId)
	{

		try
		{
			$tasksData=new TasksData();
			$tasksData->Task=$this->task;
			
			$tasksData->Task_start_date=$this->taskStart;
			$tasksData->Task_end_date=$this->taskEnd;
				
			$tasksData->taskInfo=$this->taskInformation;

			//$tasksData->user_id=$userId;
			
			$tasksData->save();
		}
		catch(ErrorException $err)
		{
			throw $err;
		}

	}
}


?>