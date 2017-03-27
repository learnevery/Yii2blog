<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "my_art".
 *
 * @property integer $art_id
 * @property string $art_name
 * @property string $art_content
 */
class MyArt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_art';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['art_content'], 'string'],
            [['art_name'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'art_id' => Yii::t('common', 'Art ID'),
            'art_name' => Yii::t('common', 'Art Name'),
            'art_content' => Yii::t('common', 'Art Content'),
        ];
    }
}
