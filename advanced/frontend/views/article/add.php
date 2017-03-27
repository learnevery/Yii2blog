<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Posts;

/* @var $this yii\web\View */
/* @var $model frontend\models\Posts */
/* @var $form ActiveForm */
$this->title = Yii::t("common", "Add Article");
$this->params['breadcrumbs'][] = ['label' => "文章", 'url' => ['/article/index']];

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-9">
        <div class="panel-title">
            <span>发布文章</span>
        </div>
        <div>
            <!--这里的模型-->
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'cat_id')->dropDownList($cats) ?>

            <?=
            $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload', [
//                'config' => [
//                    //图片上传的一些配置，不写调用默认配置
//                    'domain_url' => 'http://www.yii2.io',
//                ]
            ])
            ?>
            <?=
            $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor', [
                'options' => [
                    'initialFrameWidth' => 850,
                ]
            ])
            ?>
<?= $form->field($model, 'tags')->widget('common\widgets\tags\TagWidget') ?>
            <div class="form-group">
            <?= Html::submitButton(Yii::t("common", "submit"), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

<?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div></div>
    </div>



</div>