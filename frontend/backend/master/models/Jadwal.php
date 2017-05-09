<?php

namespace frontend\backend\master\models;

use Yii;

/**
 * This is the model class for table "jadwal".
 *
 * @property string $ID
 * @property string $ACCESS_UNIX
 * @property string $ID_PEKERJA
 * @property string $HARI
 * @property string $TGL
 * @property string $JAM_MASUK
 * @property string $JAM_KELUAR
 * @property string $TODOLIST
 * @property string $KETERANGAN
 * @property int $STATUS
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class Jadwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jadwal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TGL', 'JAM_MASUK', 'JAM_KELUAR', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TODOLIST', 'KETERANGAN'], 'string'],
            [['STATUS'], 'integer'],
            [['ACCESS_UNIX', 'ID_PEKERJA', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['HARI'], 'string', 'max' => 20],
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
            'ID_PEKERJA' => Yii::t('app', 'Id  Pekerja'),
            'HARI' => Yii::t('app', 'Hari'),
            'TGL' => Yii::t('app', 'Tgl'),
            'JAM_MASUK' => Yii::t('app', 'Jam  Masuk'),
            'JAM_KELUAR' => Yii::t('app', 'Jam  Keluar'),
            'TODOLIST' => Yii::t('app', 'Todolist'),
            'KETERANGAN' => Yii::t('app', 'Keterangan'),
            'STATUS' => Yii::t('app', 'Status'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_AT' => Yii::t('app', 'Create  At'),
            'UPDATE_BY' => Yii::t('app', 'Update  By'),
            'UPDATE_AT' => Yii::t('app', 'Update  At'),
        ];
    }
}
