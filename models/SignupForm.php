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
	public $role;
	
	public function rules()
	{
		return [
		[['username', 'password','role'], 'required'],
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

		$newUser->role=$this->role;

		$newUser->save();
		
		return $newUser;
	}

}




?>