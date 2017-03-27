<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t("common", "My Blog"),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $left_menuItem = [
        ['label' => Yii::t("common", "Home"), 'url' => ['/site/index']],
        ['label' => Yii::t("common", "Article"), 'url' => ['/article/index']],
        ['label' => "添加文章", 'url' => ['/article/add']],
        ['label' => "自定义文章", 'url' => ['/myart/add']],
        ['label' => Yii::t("common", "About"), 'url' => ['/site/about']],
        ['label' => Yii::t("common", "Category"), 'url' => ['/site/about']],
        ['label' =>  Yii::t("common", "Contact"), 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' =>Yii::t("common", "Signup") , 'url' => ['/site/signup']];
        $menuItems[] = ['label' =>Yii::t("common", "Login") , 'url' => ['/site/login']];
    } else {
        $menuItems[] =[ 
            "label"=>"<img src='\statics\images\headimg\default.jpeg' style='width:30px' alt=''> ( ".Yii::$app->user->identity->username." ) ",
            'items' => [
                ['label' => "<i class='icon-user'>&nbsp;</i> ".Yii::t("common", "center") , 'url' => ['/site/signup']],
                ['label' => "<i class='icon-bookmark'>&nbsp;</i> ".Yii::t("common", "collect") , 'url' => ['/site/signup']],
                ['label' => "<i class='icon-heart'>&nbsp;</i> ".Yii::t("common", "like_art") , 'url' => ['/site/signup']],
                ['label' => "<i class='icon-cog'>&nbsp;</i> ".Yii::t("common", "basic") , 'url' => ['/site/signup']],
                ['label' => "<i class='icon-envelope-alt'>&nbsp;</i> ".Yii::t("common", "contact") , 'url' => ['/site/signup']],
                ['label' => "<i class='icon-signout'>&nbsp;</i>".Yii::t("common", "Logout")  , 'url'=>['site/logout'],'linkOptions'=>['data-method'=>'post']],
                
            ]    
          ];      
//                
//                '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                Yii::t("common", "Logout").'(' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        "encodeLabels"=>false,//编码html代码
        'items' => $menuItems,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $left_menuItem,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
