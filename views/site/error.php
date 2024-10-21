<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = "Page not found";

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/custom.css');
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/site.js');
?>
<div class="site-error-container">
    <h1 style="font-size:275px;"> 404 </h1>

</div>
