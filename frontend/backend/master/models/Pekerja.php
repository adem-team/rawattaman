<?php

namespace frontend\backend\master\models;

use Yii;

/**
 * This is the model class for table "pekerja".
 *
 * @property string $ID_PEKERJA
 * @property string $NAMA
 * @property string $KTP
 * @property string $GENDER
 * @property string $TGL_LAHIR
 * @property string $ALAMAT
 * @property string $HP
 * @property string $EMAIL
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class Pekerja extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pekerja';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_PEKERJA'], 'required'],
            [['TGL_LAHIR', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['ALAMAT'], 'string'],
            [['ID_PEKERJA', 'KTP', 'HP', 'EMAIL', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['NAMA'], 'string', 'max' => 150],
            [['GENDER'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_PEKERJA' => Yii::t('app', 'Id  Pekerja'),
            'NAMA' => Yii::t('app', 'Nama'),
            'KTP' => Yii::t('app', 'Ktp'),
            'GENDER' => Yii::t('app', 'Gender'),
            'TGL_LAHIR' => Yii::t('app', 'Tgl  Lahir'),
            'ALAMAT' => Yii::t('app', 'Alamat'),
            'HP' => Yii::t('app', 'Hp'),
            'EMAIL' => Yii::t('app', 'Email'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_AT' => Yii::t('app', 'Create  At'),
            'UPDATE_BY' => Yii::t('app', 'Update  By'),
            'UPDATE_AT' => Yii::t('app', 'Update  At'),
        ];
    }
}
