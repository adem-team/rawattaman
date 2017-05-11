<?php

namespace frontend\backend\master\models;

use Yii;

/**
 * This is the model class for table "pekerja_img".
 *
 * @property string $ID_PEKERJA
 * @property string $IMAGE_64
 * @property int $STATUS
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class PekerjaImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pekerja_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_PEKERJA'], 'required'],
            [['IMAGE_64'], 'string'],
            [['STATUS'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['ID_PEKERJA', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_PEKERJA' => Yii::t('app', 'Id  Pekerja'),
            'IMAGE_64' => Yii::t('app', 'Image 64'),
            'STATUS' => Yii::t('app', 'Status'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_AT' => Yii::t('app', 'Create  At'),
            'UPDATE_BY' => Yii::t('app', 'Update  By'),
            'UPDATE_AT' => Yii::t('app', 'Update  At'),
        ];
    }
}
