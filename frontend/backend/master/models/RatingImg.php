<?php

namespace frontend\backend\master\models;

use Yii;

/**
 * This is the model class for table "rating_img".
 *
 * @property string $RETING_ID
 * @property string $ACCESS_UNIX
 * @property string $IMAGE_64
 * @property int $STATUS
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class RatingImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IMAGE_64'], 'string'],
            [['STATUS'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['ACCESS_UNIX', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RETING_ID' => Yii::t('app', 'Reting  ID'),
            'ACCESS_UNIX' => Yii::t('app', 'Access  Unix'),
            'IMAGE_64' => Yii::t('app', 'Image 64'),
            'STATUS' => Yii::t('app', 'Status'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_AT' => Yii::t('app', 'Create  At'),
            'UPDATE_BY' => Yii::t('app', 'Update  By'),
            'UPDATE_AT' => Yii::t('app', 'Update  At'),
        ];
    }
}
