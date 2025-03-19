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

	public  function addData($userId)
	{
		$tasksData=new TasksData();
		$tasksData->Task=$this->task;
		
		$lastTaskId=TasksData::getLastTaskNumber($userId);

		$tasksData->taskNumber = ($lastTaskId+1); 

		$tasksData->Task_start_date=$this->taskStart;
		$tasksData->Task_end_date=$this->taskEnd;
			
		$tasksData->taskInfo=$this->taskInformation;

		$tasksData->user_id=$userId;
		
		$tasksData->save();

	}
}


?>