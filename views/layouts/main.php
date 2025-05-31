<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\Modal;

//use yii\bootstrap5\NavBar;
use app\widgets\CustomNavBar;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

use app\models\LoginForm;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);


$this->registerCssFile(Yii::$app->request->baseUrl.'/css/custom.css');
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/site.js');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100 body-bg-color">
<?php $this->beginBody() ?>


<header id="header">
    <?php
  
    ///
    $loginModel=$this->params['loginModel'];
    $signupModel=$this->params['signupModel'];
    $newTaskModel=$this->params['taskModel'];
    ///

    Modal::begin(['id'=>'modal-login','class'=>'bg-color txt-bg','title'=>'<h1 style="margin-left:30%;"> Login user </h1>']);
		$loginForm=ActiveForm::begin(['method'=>'post','action'=>Url::toRoute(['login'])]);
			echo $loginForm->field($loginModel,'username')->textInput(['maxlength'=>'50','placeholder'=>'Username'])->label('Username or email');
			echo $loginForm->field($loginModel,'password')->passwordInput(['maxlength'=>'50','placeholder'=>'Password'])->label('Password');
			echo Html::submitButton('Login',['class'=>'btn-dialog']);
		ActiveForm::end();	
	Modal::end();

    Modal::begin(['id'=>'modal-signup','class'=>'bg-color txt-bg']);
		$signupForm=ActiveForm::begin(['method'=>'post','action'=>Url::toRoute(['signup'])]);
			echo $signupForm->field($signupModel,'username')->textInput(['maxlength'=>'50'])->label('Username');
			echo $signupForm->field($signupModel,'password')->passwordInput()->label('Password');

			echo $signupForm->field($signupModel,'role')->dropdownList(['admin'=>'Admin','user'=>'User']);
			
			echo Html::submitButton('Signup',['class'=>'btn-dialog']);
		ActiveForm::end();
	Modal::end();

    Modal::begin(['id'=>'modal-add-task',
	'class'=>'bg-color txt-bg',
	'title'=>'<h1 style="margin-left:30%;"> Add new task </h1>']);
		//$dataDate=
		$addTaskModel=ActiveForm::begin(['method'=>'post','action'=>Url::toRoute(['add'])]); 
			echo $addTaskModel->field($newTaskModel,'task')->textInput(['maxlength'=>'50','placeholder'=>'Task name']);
			//echo $addTaskModel->field($newTaskModel,'taskStart')->textInput(['']);//widget(\kartik\daterange\DateRangePicker::className(),['attribute'=>'datetime_range']);
			echo $addTaskModel->field($newTaskModel,'taskStart')->widget(\yii\jui\DatePicker::classname(),['dateFormat'=>'mm-dd-yyyy','inline'=>false,'options'=>['class'=>'form-control','placeholder'=>'Date start']]);
			echo $addTaskModel->field($newTaskModel,'taskEnd')->widget(\yii\jui\DatePicker::classname(),['dateFormat'=>'mm-dd-yyyy','inline'=>false,'options'=>['class'=>'form-control','placeholder'=>'Date end']]);
			echo $addTaskModel->field($newTaskModel,'taskInformation')->textarea(['maxlength'=>'90','style'=>'height:150px;','placeholder'=>'Task information']);
			echo Html::submitButton('Send',['class'=>'btn-dialog']);
		ActiveForm::end();
	Modal::end();



    CustomNavBar::begin();
	echo CustomNavBar ::widget(['header'=>'Task tracker','headerOptions'=>['fonts-color fonts-size-header nav']]);
        
		if(Yii::$app->user->isGuest)
		{
		    echo Html::tag('button','Login',['onclick'=>'openLoginModal()','class'=>'btn-nav fonts-size-nav btn-dialog login-btn']);
            echo Html::tag('button','Sign in',['onclick'=>'','class'=>'btn-nav fonts-size-nav btn-dialog signin-btn','onclick'=>'openSignupModal()']);

            ///
            //echo Html::tag('button','Sign in new user',['class'=>'btn-nav fonts-size-nav btn-dialog signin-btn-admin','onclick'=>'openSignupModal()']);
            ///
		}
        
		else
		{
            echo '<div class="add-log-container">';
                $id=Yii::$app->user->id;
                $newUser=new LoginForm();

                $role=$newUser->getRole($id);
                if($role=='admin')
                    echo Html::tag('button','Sign in new user',['class'=>'btn-nav fonts-size-nav btn-dialog signin-btn-admin','onclick'=>'openSignupModal()']);

                $logoutForm=ActiveForm::begin(['method'=>'post','action'=>Url::toRoute('logout')]);
                    echo Html::submitButton('Logout',['class'=>'fonts-size-nav btn-nav btn-dialog logout-btn']);
                ActiveForm::end();

                echo Html::tag('button','',['class'=>'btn-nav btn-dark-mode']);
                echo Html::tag('button','Add new task',['class'=>'fonts-size-nav btn-nav add-button','onclick'=>'openAddModal();']); //'style'=>'position:relative;top:-32px;left:75%;'    
            echo '</div>';
		}
    CustomNavBar::end();
	
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 footer">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start txt-bg" > Task tracker digital </div>
            
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
