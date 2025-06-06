<?php
namespace app\widgets;
use Yii;
use yii\helpers\Html;

class CustomNavBar extends \yii\bootstrap5\Widget
{
	
	public $headerOptions;
	public $header;
	public function init()
	{
		parent ::init();
		echo Html::tag('h1',$this->header,['class'=>$this->headerOptions]);
	}
	public function renderToggleButton()
	{
		return "";
	}
}


?>