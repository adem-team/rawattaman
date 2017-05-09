<?php

namespace frontend\backend\master\models;

use Yii;

/**
 * This is the model class for table "prodak".
 *
 * @property string $ID
 * @property string $PRODAK_NAME
 * @property string $KETERANGAN
 * @property string $HARGA
 * @property string $DISCOUNT
 * @property string $SHARE_PROFIT
 * @property int $STATUS
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class Prodak extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prodak';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['KETERANGAN'], 'string'],
            [['HARGA', 'DISCOUNT', 'SHARE_PROFIT'], 'number'],
            [['STATUS'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['PRODAK_NAME'], 'string', 'max' => 255],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'PRODAK_NAME' => Yii::t('app', 'Prodak  Name'),
            'KETERANGAN' => Yii::t('app', 'Keterangan'),
            'HARGA' => Yii::t('app', 'Harga'),
            'DISCOUNT' => Yii::t('app', 'Discount'),
            'SHARE_PROFIT' => Yii::t('app', 'Share  Profit'),
            'STATUS' => Yii::t('app', 'Status'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_AT' => Yii::t('app', 'Create  At'),
            'UPDATE_BY' => Yii::t('app', 'Update  By'),
            'UPDATE_AT' => Yii::t('app', 'Update  At'),
        ];
    }
}
