<?php
use yii\widgets\LinkPager;

?>
<?php foreach($countrys as $key=>$value){ ?>
<h1><?=$value['name']?></h1>



<?php } ?>
<div class="my_div"><?= LinkPager::widget(['pagination' => $pagination]) ?></div>

