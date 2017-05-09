<?php

namespace frontend\backend\master\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property string $ID
 * @property string $ACCESS_UNIX
 * @property string $PRODAK_ID
 * @property string $KETERANGAN
 * @property string $JUMLAH_BAYAR
 * @property int $STATUS
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRODAK_ID', 'STATUS'], 'integer'],
            [['KETERANGAN'], 'string'],
            [['JUMLAH_BAYAR'], 'number'],
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
            'ID' => Yii::t('app', 'ID'),
            'ACCESS_UNIX' => Yii::t('app', 'Access  Unix'),
            'PRODAK_ID' => Yii::t('app', 'Prodak  ID'),
            'KETERANGAN' => Yii::t('app', 'Keterangan'),
            'JUMLAH_BAYAR' => Yii::t('app', 'Jumlah  Bayar'),
            'STATUS' => Yii::t('app', 'Status'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_AT' => Yii::t('app', 'Create  At'),
            'UPDATE_BY' => Yii::t('app', 'Update  By'),
            'UPDATE_AT' => Yii::t('app', 'Update  At'),
        ];
    }
}
