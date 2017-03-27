<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "my_tags".
 *
 * @property integer $tags_id
 * @property string $tags_val
 */
class MyTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tags_val'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tags_id' => Yii::t('common', 'Tags ID'),
            'tags_val' => Yii::t('common', 'Tags Val'),
        ];
    }
}
