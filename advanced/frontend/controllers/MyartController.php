<?php

namespace frontend\controllers;
use frontend\models\PostsForm;
class MyartController extends \yii\web\Controller
{
    public function actionAdd()
    {
        $model = new PostsForm();
        
        return $this->render('add', ['model' => $model]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
