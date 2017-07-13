<?php

namespace frontend\backend\master\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property string $ID
 * @property string $JADWAL_ID
 * @property string $ACCESS_UNIX
 * @property string $ID_PEKERJA
 * @property int $NILAI
 * @property string $NILAI_KETERANGAN
 * @property string $TGL
 * @property string $JAM_MASUK
 * @property string $JAM_KELUAR
 * @property int $STATUS
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class Rating extends \yii\db\ActiveRecord
{
	public $hari;
	Public $todolist;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['JADWAL_ID', 'NILAI', 'STATUS'], 'integer'],
            [['NILAI_KETERANGAN'], 'string'],
            [['TGL', 'JAM_MASUK', 'JAM_KELUAR', 'CREATE_AT', 'UPDATE_AT','hari','todolist','ID_PEKERJA'], 'safe'],
            [['ACCESS_UNIX',  'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'JADWAL_ID' => Yii::t('app', 'Jadwal  ID'),
            'ACCESS_UNIX' => Yii::t('app', 'Access  Unix'),
            'ID_PEKERJA' => Yii::t('app', 'Pekerja/Gardener'),
            'NILAI' => Yii::t('app', 'Nilai'),
            'NILAI_KETERANGAN' => Yii::t('app', 'Nilai  Keterangan'),
            'TGL' => Yii::t('app', 'Tgl'),
            'JAM_MASUK' => Yii::t('app', 'Jam  Masuk'),
            'JAM_KELUAR' => Yii::t('app', 'Jam  Keluar'),
            'STATUS' => Yii::t('app', 'Status'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_AT' => Yii::t('app', 'Create  At'),
            'UPDATE_BY' => Yii::t('app', 'Update  By'),
            'UPDATE_AT' => Yii::t('app', 'Update  At'),
        ];
    }
}
