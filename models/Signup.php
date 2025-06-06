<?php
namespace app\models;
use Yii;
use yii\base\NotSupportedException;
use yii\base\Security;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;


class Signup extends ActiveRecord implements IdentityInterface
{
	public static function tableName()
	{
		return 'auth';
	}
	public static function findByUsername($username)
	{
		return static::findOne(['username'=>$username]);
	}
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password,$this->password);
	}
		
	public static function findIdentityByAccessToken($token,$type=null)
	{
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}
	
	public function getId()
	{
		return $this->getPrimaryKey();
	}
	public function getPassword()
    {
        return $this->password;
    }
	public static function findIdentity($id)
	{
		return static::findOne(['id'=>$id]);
	}
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey()==$authKey;
	}
	public function getAuthKey()
	{
		return $this->auth_key;
	}
	
	public function getRole()
	{
		return $this->role;
	}

	public function beforeSave($insert)
	{
		if(parent::beforeSave($insert))
		{
			if($this->isNewRecord)
				$this->auth_key=Yii::$app->security->generateRandomString();
			return true;
		}
		return false;
	}
	
	
	public static function getLastUserId()
	{
		return static::find()->orderBy(['id'])->one();
	}
	
	
}


?>