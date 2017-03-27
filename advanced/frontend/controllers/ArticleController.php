<?php

namespace frontend\controllers;

use frontend\models\PostsForm;
use app\models\Cats;
use frontend\models\PostExtends;
use frontend\models\FeedsForm;
class ArticleController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }
    
    public function actionDetail() {
        $model = new PostsForm();
//        每次展示文章详情,让浏览量自动加一
//        理论上,同一个ip,连续访问同一篇文章,不应该+1
        $extends = new PostExtends();
        $extends->upCounter(["post_id"=>\Yii::$app->request->get("id")],"browser");
        $data = $model->getArticleById(\Yii::$app->request->get("id"));
        return $this->render('detail',['data'=>$data]);
    }
    public function actionAddfeed() {
   
        $model = new FeedsForm;
        $model ->content = \Yii::$app->request->post("content");
        if($model->validate()){
            if($model->createFeeds()){
                return json_encode(['status'=>true]);
            }
        }
        return json_encode(['status'=>false,'msg'=>"发布失败"]);
    }
    public function actionAdd() {
    
        $model = new PostsForm();
        $model->setScenario(PostsForm::SCENARIOS_CREATE);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            if($model->createArticle()){
              return  $this->redirect(['article/detail',"id"=>$model->id]);
            }else{
                echo "保存失败";
            }
            exit;
        }
        $categorys = Cats::find()->asArray()->all();
        $cats = [];
        $cats[0] = "默认分类";
        foreach ($categorys as $key => $value) {
            $cats[$value['id']] = $value["cat_name"];
        }

        return $this->render('add', ['model' => $model, "cats" => $cats]);
    }

    public function actions() {
        return [
            'upload' => [
                'class' => 'common\widgets\file_upload\UploadAction', //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],
            'ueditor' => [
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                    //上传图片配置
                    'imageUrlPrefix' => "", /* 图片访问路径前缀 */
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                ]
            ]
        ];
    }


}
