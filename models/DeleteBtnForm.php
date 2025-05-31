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
        
        try
        {
            $delData=TasksData::find()->where(['taskNumber'=>$valId])->one();
            if(!isset($delData))
                throw new ErrorException('Data not set');
            $delData->delete();
            
        }
        catch(ErrorException $err)
        {
            throw $err;
        }
    }     
}

?>