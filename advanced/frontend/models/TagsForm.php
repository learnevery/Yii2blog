<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use yii\base\Model;
use frontend\models\Tags;

class TagsForm extends Model {

    public $id;
    public $tags;

    public function rules() {
        return [
            ['tags', "required"],
            ["tags", "each", "rule" => ['string']],
        ];
    }

    public function saveTags() {
        $ids = [];
        if (!empty($this->tags)) {
            foreach ($this->tags as $k => $v) {
                $ids[] = $this->_saveTags($v);
            }
        }
        return $ids;
    }

    public function _saveTags($v) {
        $model = new Tags();
        $res = $model->find()->where(['tag_name' => $v])->one();
        if (!$res) {
            $model->tag_name = $v;
            $model->post_num = 1;
            if (!$model->save()) {
                throw new Exception("保存失败");
            }
            return $model->id;
        }else{
            $res->updateCounters(["post_num"=>1]);
        }
        return $res->id;
    }

}
