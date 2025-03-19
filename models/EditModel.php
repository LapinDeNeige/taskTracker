<?php
namespace app\models;

use Yii;
use yii\base\Model;

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
	
	/*	
	return [
		['task','required','when'=>function($model)
		{
			return (empty($model->taskInformation)&& empty($model->taskStart));
		}]
		*/
		/*
		['taskStart','required','when'=>function($model)
		{
			return (empty($model->task) && empty($model->taskInformation) && empty($model->taskEnd));
		}	
	],
	*/
        
    }
	public function beforeValidate()
	{
		if((empty($this->task) || !isset($this->task)) &&
		(empty($this->taskStart) ||!isset($this->taskStart) ) &&
		(empty($this->taskEnd) ||!isset($this->taskEnd) ) &&
		(empty($this->taskInformation) ||!isset($this->taskInformation) ))
		{
			return false;
		}

		return true;
	}
	public function editData()
	{
		$valEditId=$this->taskNumber;
        $dataEdit=TasksData::findOne($valEditId);

		///
		//$cnt=$dataEdit->count();
		//file_put_contents('test.txt',$this->task);
		///

		if(!empty($this->task))
			$dataEdit->Task=$this->task;
		if(!empty($this->taskStart))
			$dataEdit->Task_start_date=$this->taskStart;

		if(!empty($this->taskEnd))
			$dataEdit->Task_end_date=$this->taskEnd;
		if(!empty($this->taskInformation))
			$dataEdit->taskInfo=$this->taskInformation;
		
		$dataEdit->save();
	}
    
}



?>