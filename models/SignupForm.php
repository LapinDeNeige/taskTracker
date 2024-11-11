<?php
namespace app\models;

use Yii;
use yii\base\Model;

use yii\db\Connection;
define('MIN_PASSWORD_SIZE',7);

class SignupForm extends Model
{
	public $username;
    public $password;
	
	public function rules()
	{
		return [
		[['username', 'password'], 'required'],
		['username', 'validateUsername'],
		['password','validatePassword'],
		];
	}
	
	public function validateUsername()
	{
		$loginState=Signup::find()->where(['username'=>$this->username])->one();
		if(!$loginState)
			return true;
		return false;
	}
	public function validatePassword()
	{
		if(strlen($this->password) < MIN_PASSWORD_SIZE)
			return false;
		return true;
		
	}
	public function signup()
	{
		$newUser=new Signup();
		$newUser->username=$this->username;
		$newUser->password=Yii::$app->security->generatePasswordHash($this->password,$cost=5);
		$newUser->save();
			
		return $newUser;
	}
	public function addNewUserTable()
	{
		$lastUserName=Signup::find()->asArray()->orderBy(['id'=> SORT_DESC])->limit(1)->one();
		$tableName='tasks_data_'.$lastUserName['id'];
			
		$sqlCommand='CREATE TABLE IF NOT EXISTS '.$tableName.'(Task VARCHAR(50),taskNumber INT(5) PRIMARY KEY AUTO_INCREMENT,
		taskStatus VARCHAR(20),Task_start_date VARCHAR(25),Task_end_date VARCHAR(25),taskInfo VARCHAR(250));';
		
		//file_put_contents('test.txt',$sqlCommand);
		$sqlResult=Yii::$app->db->createCommand($sqlCommand);
		$sqlResult->execute();
		
	}
}




?>