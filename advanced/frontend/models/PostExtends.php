<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "post_extends".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $browser
 * @property integer $collect
 * @property integer $praise
 * @property integer $comment
 */
class PostExtends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'post_id' => Yii::t('common', 'Post ID'),
            'browser' => Yii::t('common', 'Browser'),
            'collect' => Yii::t('common', 'Collect'),
            'praise' => Yii::t('common', 'Praise'),
            'comment' => Yii::t('common', 'Comment'),
        ];
    }
    /*
     * $codition 根据条件查找到某篇文章
     * $attribute 自增的属性
     * 
     */
    
    public function upCounter($condition,$attribute,$num=1){
//        1. 查询扩展表
        $article = $this->findOne($condition);
//        文章已经存在,让她的浏览量加一
//       属性名 browser
      
        if($article){
             $data[$attribute]=$num;
              $article->updateCounters($data);
        }
//        文章没存在让浏览量默认为一
        else{
            $this->setAttributes($condition);
            $this->$attribute = 1;
            $this->save();
        }
    }
}
