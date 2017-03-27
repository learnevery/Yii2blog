<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Posts;
use frontend\widgets\article\ArticleWidget;
/* @var $this yii\web\View */
/* @var $model frontend\models\Posts */
/* @var $form ActiveForm */


$this->title = Yii::t('common', "article");
$this->params['breadcrumbs'][] = $this->title;
?>
<?=ArticleWidget::widget()?>