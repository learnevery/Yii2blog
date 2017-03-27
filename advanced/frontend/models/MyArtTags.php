<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "my_art_tags".
 *
 * @property integer $id
 * @property integer $art_id
 * @property integer $tags_id
 */
class MyArtTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_art_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['art_id', 'tags_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'art_id' => Yii::t('common', 'Art ID'),
            'tags_id' => Yii::t('common', 'Tags ID'),
        ];
    }
}
