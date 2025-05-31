<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\ErrorException;

class EditModel extends Model
{
    public $task;
	public $taskStart;
	public $taskEnd;
	public $taskInformation;
    
	public $taskNumber;
    
    public function rules()
    {
	return
    [
		['task','string'],
		//['task','required'],

		['taskStart','string'],
		//['taskStart','required'],

		['taskEnd','string'],
		//['taskEnd','required'],

		['taskInformation','string'],
		//['taskInformation','required']
		['taskNumber','integer']
	];
	
	
        
    }
	public function validateData()
	{
		if(empty($this->task) && empty($this->taskStart) && empty($this->taskEnd) && empty($this->taskInformation))
			return false;

		return true;
	}

	public function editData()
	{
		try
		{
			$valEditId=$this->taskNumber;
			$dataEdit=TasksData::find()->where(['taskNumber'=>$valEditId])->one();
			

			if(!empty($this->task))
				$dataEdit->Task=$this->task;
			else
				throw new ErrorException('some field not set');
			if(!empty($this->taskStart))
				$dataEdit->Task_start_date=$this->taskStart;
			else
				throw new ErrorException('some field not set');
			if(!empty($this->taskEnd))
				$dataEdit->Task_end_date=$this->taskEnd;
			else
				throw new ErrorException('some field not set');
			if(!empty($this->taskInformation))
				$dataEdit->taskInfo=$this->taskInformation;
			else
				throw new ErrorException('some field not set');
			$dataEdit->save();
		
		}
		catch(ErrorException $e)
		{
			throw $e;
		}
	}
    
}



?>