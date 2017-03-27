<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use yii\base\Model;
use frontend\models\Posts;
use frontend\models\RelationPostTags;

/**
 * Description of PostsForm
 *
 * @author Administrator
 */
//数据模型继承自ActionRecond
//表单模型继承自 Model
class PostsForm extends Model {

    //put your code here
//   声明属性
    public $id;
    public $title;
    public $content;
    public $label_img;
    public $cat_id;
    public $tags;
    public $_lastError;

    const SCENARIOS_CREATE = "create";
    const SCENARIOS_UPDATE = "update";
    const EVENT_AFTER_CREATE = "create";
    const EVENT_AFTER_UPDATE = "update";

//    设置验证规则
    public function rules() {
//        parent::rules();
        return[
            [["id", "title", "content", "cat_id"], "required"],
            [["id", "cat_id"], "integer"],
            ['title', "string", "min" => 4, "max" => 50],
        ];
    }

    //        多语言国际化
    public function attributeLabels() {
        return [
            "title" => \Yii::t("common", 'title'),
            "content" => \Yii::t("common", 'content'),
            "cat_id" => \Yii::t("common", 'cat_id'),
            "tags" => \Yii::t("common", 'tags'),
            "label_img" => \Yii::t("common", 'label_img'),
        ];
    }

//   场景
    public function scenarios() {
        $scenarios = [
            self::SCENARIOS_CREATE => ["tags", "title", "content", "cat_id", "label_img"],
            self::SCENARIOS_UPDATE => ["tags", "title", "content", "cat_id", "label_img"],
        ];
        return array_merge(parent::scenarios(), $scenarios);
    }

    public function createArticle() {
//        开启事物
        $transaction = \Yii::$app->db->beginTransaction();
//      捕获异常信息
        try {
//            正常执行
            $art = new Posts();
            $art->setAttributes($this->attributes);
            $art->summary = $this->_getSunmmary();
            $art->created_at = time();
            $art->updated_at = time();
            $art->user_id = \Yii::$app->user->identity->id;
            $art->user_name = \Yii::$app->user->identity->username;
            $art->is_valid = Posts::IS_VALID;
            if (!$art->save()) {
                throw new Exception("存储失败");
            }
            $this->id = $art->id;
//            提交事务

            $transaction->commit();
            $data = array_merge($this->getAttributes(), $art->getAttributes());
//说明:一个合格的函数,长度不应该超过1000行
            $this->_eventAfterToDo($data);
            return true;
        } catch (Exception $ex) {
//            回滚事务
            $transaction->rollBack();
//一旦代码出错/抛出异常...
            $this->_lastError = $ex->getMessage();
            return false;
        }
    }

    public function _getSunmmary($start = 0, $end = 90, $char = "utf-8") {
        if (empty($this->content)) {
            return null;
        }
        return mb_substr(str_replace("&nbsp;", "", strip_tags($this->content)), $start, $end, $char);
    }

//    私有函数前加下划线,是默认规则
    public function _eventAfterToDo($data) {
//        设计模式:通知模式
//        on 绑定事件 ,这个事件并没有执行
        $this->on(self::EVENT_AFTER_CREATE, [$this, "_saveTags"], $data);
//        $this->off($name) //解除事件
//        事件执行:执行该字符串上的所有绑定事件
        $this->trigger(self::EVENT_AFTER_CREATE);
    }

    public function _saveTags($event) {
        $tags = new TagsForm();
        $tags->tags = $event->data['tags'];
        $tagids = $tags->saveTags();
        RelationPostTags::deleteAll(["post_id" => $event->data['id']]);
        if (!empty($tagids)) {
            foreach ($tagids as $k => $v) {
                $row[$k]["post_id"] = $this->id;
                $row[$k]['tag_id'] = $v;
            }
            $res = (new \yii\db\Query())->createCommand()->batchInsert(RelationPostTags::tableName(), ['post_id', "tag_id"], $row)->execute();
            if (!$res) {
                throw new Exception("关联关系保存失败");
            }
        }
    }

    public function getArticleById($id) {
        $data = Posts::find()->with('relate.tag', "extend")->where(['id' => $id])->asArray()->one();
        if (!$data) {
            throw new \yii\web\NotFoundHttpException("文章不存在");
        }
        $data['tags'] = [];
        if (isset($data['relate']) && !empty($data['relate'])) {
            foreach ($data['relate'] as $k => $v) {
                $data["tags"][] = $v['tag']["tag_name"];
            }
        }
        unset($data['relate']);

        return $data;
    }

    public function getArticleList($condition,$currentPage=1, $pageSize=5, $page = 1, $limit = 10, $orderBy = ['id' => SORT_DESC]) {
        $model = new Posts();
        $query = $model->find()->where($condition)->with("relate.tag", "extend")->orderBy($orderBy);
        $res = $model->getPages($query, $currentPage, $pageSize);
        $res["data"] = self::_formatList($res["data"]);
        return $res;
    }

    public function _formatList($data) {
        foreach ($data as &$list) {
            if (isset($list['relate']) && !empty($list['relate'])) {
                foreach ($list['relate'] as $lt) {
                    $list['tags'][] = $lt['tag']['tag_name'];
                }
            }
            unset($list["relate"]);
        }
        return $data;
    }
   

}
