<?php
use frontend\widgets\banner\BannerWidget;   
use frontend\widgets\hot\HotWidget;
use frontend\widgets\tag\TagWidget;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="col-lg-9">
    <?=BannerWidget::widget()?>
</div>
<div class="col-lg-3">
    <?=  HotWidget::widget()?>
    <?=  TagWidget::widget()?>
</div>
