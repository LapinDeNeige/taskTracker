<?php
namespace app\models;

use Yii;
use yii\base\Model;

class DeleteBtnForm extends Model
{
    public $delBtnHidden; 

    
    public function rules()
    {
        return [
            ['delBtnHidden','integer'], //verifiying delBtnHidden value to be type of integer 
            ['delBtnHidden','required'] 
        ];
    }
    
    public function deleteData()
    {
        $valId=$this->delBtnHidden;
        
        /*
        if(!isset($valId))
            file_put_contents('test.txt','Error');
        else
            file_put_contents('test.txt',$valId);
        */
        $delData=TasksData::find()->where(['user_id'=>$valId])->one();
        //$delData=TasksData::findOne($valId);
        if(isset($delData))
        {
            $delData->delete();
            return true;
        }
        else
            return false;
    }     
}

?>