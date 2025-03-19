<?php
namespace app\models;
use yii\db\ActiveRecord;

class TasksData extends ActiveRecord
{
	public static function tableName()
	{
		return 'tasks_data';
	}
	public function rules()
	{
		return [
			['taskStatus','default','value'=>'On pause'],
		
		];
	}
	
	public static function getLastTaskNumber($userId) //get last task number of user id 
	{
		$result= static::find()->where(['user_id'=>$userId])->one();
		if(!isset($result))
			return 0;
		return $result->taskNumber;
	}
}

?>