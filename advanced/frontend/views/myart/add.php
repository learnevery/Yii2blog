<?php
use yii\widgets\ActiveForm; 

?>
 <?php $form = ActiveForm::begin(); ?>
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



<?php ActiveForm::end(); ?>






