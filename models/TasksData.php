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
}

?>