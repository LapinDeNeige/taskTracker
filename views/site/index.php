
<?php
use yii\bootstrap\Button;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use yii\grid\GridView;
use yii\widgets\LinkPager;

use yii\jui\DatePicker;
//use yii\bootstrap5\Carousel;
//use kartik\daterange\DateRangePicker;

/** @var yii\web\View $this */

$this->title = 'Task tracker';

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/custom.css');
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/site.js');
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/addSelectToTable.js');
?>
<?php
	Modal::begin(['id'=>'modal-login','class'=>'bg-color txt-bg']);
		$loginForm=ActiveForm::begin(['method'=>'post','action'=>Url::toRoute(['login'])]);
			echo $loginForm->field($loginModel,'username')->textInput();
			echo $loginForm->field($loginModel,'password')->passwordInput();
			echo Html::submitButton('Login',['class'=>'btn-dialog']);
		ActiveForm::end();	
	Modal::end();
	
	Modal::begin(['id'=>'modal-signup','class'=>'bg-color txt-bg']);
		$signupForm=ActiveForm::begin(['method'=>'post','action'=>Url::toRoute(['signup'])]);
			echo $signupForm->field($signupModel,'username')->textInput();
			echo $signupForm->field($signupModel,'password')->passwordInput();
			
			echo Html::submitButton('Signup',['class'=>'btn-dialog']);
		ActiveForm::end();
	Modal::end();
	
	Modal::begin(['id'=>'modal-add-task','class'=>'bg-color txt-bg']);
		//$dataDate=
		$addTaskModel=ActiveForm::begin(['method'=>'post','action'=>Url::toRoute(['add'])]);
			echo $addTaskModel->field($newTaskModel,'task')->textInput();
			//echo $addTaskModel->field($newTaskModel,'taskStart')->textInput(['']);//widget(\kartik\daterange\DateRangePicker::className(),['attribute'=>'datetime_range']);
			echo $addTaskModel->field($newTaskModel,'taskStart')->widget(\yii\jui\DatePicker::classname(),
			['dateFormat'=>'mm-dd-yyyy','inline'=>false]);
			echo $addTaskModel->field($newTaskModel,'taskEnd')->widget(\yii\jui\DatePicker::classname(),
			['dateFormat'=>'mm-dd-yyyy','inline'=>false]);
			echo $addTaskModel->field($newTaskModel,'taskInformation')->textarea();
			echo Html::submitButton('Send',['class'=>'btn-dialog']);
		ActiveForm::end();
	Modal::end();
?>

<?=Html::tag('a','tmp',['class'=>'btn-dialog','href'=>Url::toRoute(['tmp'])])?>

<div class="site-index">
    <div class="body-content">
		<?php
		
		if(!$isLoggedIn)
		{
			echo Html::tag('h1','The task tracker',['style'=>'margin-left:25%;margin-top:2%;font-size:95px;']);
			echo Html::tag('br');
			echo Html::tag('h1','Add carousel image here',['style'=>'margin-left:25%;margin-top:2%;font-size:65px;']);
		}
		else
		{
			$columns=[
				'Task number',
				'Task',
				'Task information ',
				'Task Start Date',
				'Task End Date',
				'taskStatus',
			
				];
				
			
			echo '<table class="tbl">';
			echo '<thead>';
			foreach($columns as $c)
				echo '<th>'. $c.'</th>'; 
			
			echo '</thead>';
			echo '<tbody>';
			foreach($data as $d)
			{
				echo '<tr data-key="[]">';
				echo Html::tag('td','#'.$d['taskNumber']);
				echo Html::tag('td',$d['Task']);
				echo Html::tag('td',$d['taskInfo']);
				echo Html::tag('td',$d['Task_start_date']);
				echo Html::tag('td',$d['Task_end_date']);
				
				echo Html::tag('td',$d['taskStatus'],['name'=>'on_id']); //drop down list
				
				echo '</tr>';
				
			}
			
			echo '</tbody>';
			
			echo '</table>';
			
			echo LinkPager::widget([
				'pagination'=>$pages,]); 
			
		}
		
		?>
    </div>
</div>
