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
        
        if(!isset($valId))
            file_put_contents('Error','test.txt');
        else
            file_put_contents($valId,'test.txt');
        //$delData=TasksData::findOne($valId);
        //$delData->delete();
    }     
}

?>