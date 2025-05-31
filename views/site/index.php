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

	//
	use yii\bootstrap5\Carousel;
	//

	//use yii\bootstrap5\Carousel;
	//use kartik\daterange\DateRangePicker;

	/** @var yii\web\View $this */

	$this->title = 'Task tracker';

	$this->registerCssFile(Yii::$app->request->baseUrl.'/css/custom.css');
	$this->registerJsFile(Yii::$app->request->baseUrl.'/js/site.js');
	$this->registerJsFile(Yii::$app->request->baseUrl.'/js/enableDisable.js');
	$curTaskNumber=null;

?>
<script>
	
	function changeStatus()
	{		
		$(document).on('click',function(event){
			var bodyElement=$('body');

			 var taskId=$(event.target).parent().parent().prop('id'); //event.target.tagName
			 var taskStatus=$(event.target).val(); //get new task status

			disableElement(bodyElement);
			 $.ajax(
			{
				url:'<?php echo Url::toRoute("update")?>',
				type:'post',
				dataType:'json',
				data:{'task_id':taskId,
					'task_status':taskStatus},
				success:function(){
					enableElement(bodyElement);
					console.log("Data sucessfull updated!");
				},
				error:function(code,status)
				{
					enableElement(bodyElement);
					console.log("Error updating data!"+code);
					
				}
				
			}
		);

			
		});

		
	}
</script>
<?php
	///
	Modal::begin(['id'=>'modal-delete-task',
	'class'=>'bg-color txt-bg',
	'title'=>'<h1 style="margin-left:10%;"> Do you want to delete a task? </h1>']);
		
		$btnDelForm=ActiveForm::begin(['method'=>'POST','action'=>Url::toRoute(['remove'])]);
			echo $btnDelForm->field($delBtnFrm,'delBtnHidden')->hiddenInput(['value'=>'','id'=>'hidden-delete'])->label(false); 

			echo '<div style="display:inline-flex">';
				echo Html::submitButton('Ok',['class'=>'btn-in-confirm']);
				echo Html::tag('button','Cancel',['class'=>'btn-in-confirm','onclick'=>'closeDeleteTaskModal()']);
			echo '</div>';
		ActiveForm::end();
	Modal::end();
	
	///


	Modal::begin(['id'=>'modal-edit',
	'class'=>'bg-color txt-bg',
	'title'=>'<h1> Edit task </h1>']);

		$btnEditTask=ActiveForm::begin(['method'=>'POST','action'=>Url::toRoute(['edit'])]);

			echo $btnEditTask->field($editModel,'task')->textInput(['maxlength'=>'50','id'=>'edit-task']);
			echo $btnEditTask->field($editModel,'taskStart')->widget(\yii\jui\DatePicker::classname(),['dateFormat'=>'mm-dd-yyyy','inline'=>false,'options'=>['class'=>'form-control']]);
			echo $btnEditTask->field($editModel,'taskEnd')->widget(\yii\jui\DatePicker::classname(),['dateFormat'=>'mm-dd-yyyy','inline'=>false,'options'=>['class'=>'form-control']]);
			echo $btnEditTask->field($editModel,'taskInformation')->textarea(['maxlength'=>'150','style'=>'height:150px;','id'=>'edit-task-info']);
			
			echo $btnEditTask->field($editModel,'taskNumber')->hiddenInput(['value'=>'','id'=>'hidden-edit'])->label(false);
			echo Html::submitButton('Send',['class'=>'btn-dialog ']);
		ActiveForm::end();

	Modal::end();

?>



<div class="site-index">
    <div class="body-content">
		<?php
		
		///
		global $curTaskNumber;
		///
		
		if(!$isLoggedIn)
		{
			echo Html::tag('h1','Task tracker',['class'=>'h-logo']);
			echo Html::tag('br');

			echo Carousel::widget([
				'items'=>[
					//'<img src="../img/1.jpg"/>',
					['content'=>'<img src="../img/2.jpg" />'],
					['content'=>'<img src="../img/1.jpg" />']
					],
					'showIndicators'=>false


			]);

			//LATER TO CLASS 
			
			echo '<div style="width:50%;height:auto;min-height:150px;max-width:950px;;background-color:#272C33;font-weight:10px2px;font-size:25px;margin-top:8%;margin-left:27%;">';
				echo Html::tag("h1","Task tracker helps you in business to track your issues in your projects",['class'=>'fonts-color','style'=>'line-height:36px;padding:5%;']);
				echo Html::tag("h1","Improve your productivity and time management skills and achieve more in less time",['class'=>'fonts-color','style'=>'line-height:36px;padding:5%;']);
				echo Html::tag("h1","Access your tasks wherever you are",['class'=>'fonts-color','style'=>'line-height:36px;padding:5%;']);
				echo Html::tag("h1","Fully free! Discover new expierence!",['class'=>'fonts-color','style'=>'line-height:36px;padding:5%;']);
			echo '</div>';
			
			
		}

		else
		{
			$columns=[
				'Task No',
				'Task',
				'Task info ',
				'Task Start Date',
				'Task End Date',
				'Task status',
			
				];
				
			$taskStatutes=['Working',
			'Finished',
			'On pause'
				];


			echo '<table class="tbl">';
			echo '<thead>';
			foreach($columns as $c)
				echo '<th>'. $c.'</th>'; 
			
			echo '</thead>';
			echo '<tbody>';

			if($dataCount==0)
			{
				echo '<h1 class="no-data-text">';
					echo Html::tag('i','No data');
				echo '</h1>';
			}
			else
			{
				foreach($data as $d)
				{
					$curTaskNumber=Html::encode($d['taskNumber']);
					$curTask=Html::encode($d['Task']);
					$curTaskInfo=Html::encode($d['taskInfo']);
					$curTaskStartDate=Html::encode($d['Task_start_date']);
					$curTaskEndDate=Html::encode($d['Task_end_date']);
					$taskStatus=Html::encode($d['taskStatus']);


					echo '<tr data-key="[]" id='. $curTaskNumber.'>';
						echo Html::tag('td','#'.$curTaskNumber,['class'=>'td-task-number']);
						echo Html::tag('td',$curTask,['class'=>'td-task']);
						echo Html::tag('td',$curTaskInfo,['class'=>'td-task-info']);
						echo Html::tag('td',$curTaskStartDate,['class'=>'td-task-start']);
						echo Html::tag('td',$curTaskEndDate,['class'=>'td-task-end']);

						echo '<td>';
							//echo $taskStatus;
							echo '<select onchange="changeStatus()" value='.$taskStatus.'>';
								echo '<option>'.$taskStatus.'</option>';

								foreach($taskStatutes as $t)
								{
									if($t==$taskStatus)
										continue;

									echo '<option>'.$t.'</option>';
								}
							echo '</select>';
						echo '</td>';
						//echo Html::tag('td',$d['taskStatus'],['name'=>'on_id','class'=>'td-task-status']); //drop down list
						
						echo '<div class="btns">';
							echo '<td>';
								echo Html::tag('button','',['class'=>'btn-d-e btn-delete btn-delete-img-white','onclick'=>'openDeleteTaskModal('.$curTaskNumber.')']);
							echo '</td>';
						
							echo '<td>';
								//echo '<input type="button" class="btn-d-e btn-edit"/>';
								echo Html::tag('button','',['class'=>'btn-d-e btn-edit btn-edit-img-white','onclick'=>'openEditModal('.$curTaskNumber.')']);
							echo'</td>';
						echo '</div>';
					echo '</tr>';
					
				}
		}
			echo '</tbody>';
			
			echo '</table>';
			
			echo LinkPager::widget([
				'pagination'=>$pages,]); 
			
		}
		
		?>
    </div>
</div>
