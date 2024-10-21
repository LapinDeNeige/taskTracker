<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;

//use yii\bootstrap5\NavBar;
use app\widgets\CustomNavBar;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

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
    CustomNavBar::begin();
	echo CustomNavBar ::widget(['header'=>'Task tracker','headerOptions'=>['fonts-color fonts-size-header nav']]);
		if(Yii::$app->user->isGuest)
		{
			echo Html::tag('button','Login',['onclick'=>'openLoginModal()','class'=>'btn-nav fonts-size-nav']);
		}
		else
		{
			echo '<div class="logout-container">';
				$logoutForm=ActiveForm::begin(['method'=>'post','action'=>Url::toRoute('logout')]);
					//echo Html::tag('button','Logout',['onclick'=>'lala','class'=>'btn-nav fonts-size-nav']);
					echo Html::submitButton('Logout',['class'=>'fonts-size-nav btn-nav']);
				ActiveForm::end();
			echo '</div>';
			echo Html::tag('button','Add new task',['class'=>'fonts-size-nav btn-nav','style'=>'position:relative;top:-32px;left:75%;','class'=>'add-button','onclick'=>'openAddModal();']);
			//echo Html::tag('button','Add new task',['class'=>'fonts-size-nav btn-nav']);
			echo Html::tag('button','Sign in new user',['class'=>'btn-nav fonts-size-nav','onclick'=>'openSignupModal()','style'=>'position:relative;top:-37px;left:12%;']);
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

<footer id="footer" class="mt-auto py-3 footer-bg">
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
