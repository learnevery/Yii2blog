<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets\article;
use frontend\models\PostsForm;
use frontend\models\Posts;
use yii\base\Widget;

/**
 * Description of Article
 *
 * @author Administrator
 */
class ArticleWidget extends Widget {

    //put your code here
    public $title;
    public $limit = 3;
    public $page = true;
    public $more = true;

//    public function init(){
//        
//    }
    public function run() {
//      获取当前页
        $currentPage = \Yii::$app->request->get("page",1);
//        查询条件
        $condition =['=','is_valid',  \frontend\models\Posts::IS_VALID];
//       由表单模型根据条件查询符合的文章
        $res = PostsForm::getArticleList($condition,$currentPage,  $this->limit);
        $result["title"] =  $this->title ? : "最新文章";
        $result["more"]= \yii\helpers\Url::to(["article/index"]);
        $result['body'] = $res["data"]? :[];
        if($this->page){
            $pages = new \yii\data\Pagination(['totalCount'=>$res['count'],"pageSize"=>$res['pageSize']]);
            $result['page']=$pages;
        }  else {
            
        }
     return $this->render("index",["data"=>$result]);
    }

}
