<?php

namespace frontend\backend\master\models;

use Yii;

use frontend\backend\master\models\UserProfil;

class Jadwal extends \yii\db\ActiveRecord
{
	 const SCENARIO_INPUT_JADWAL = 'input_jadwal';
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
            [['TGL', 'JAM_MASUK', 'JAM_KELUAR','ID_PEKERJA', 'TODOLIST','KETERANGAN','STATUS'], 'required','on'=>self::SCENARIO_INPUT_JADWAL],
            [['TGL', 'JAM_MASUK', 'JAM_KELUAR', 'CREATE_AT', 'UPDATE_AT','ClientNm','ID_PEKERJA', 'TODOLIST'], 'safe'],
            [['KETERANGAN'], 'string'],
            [['STATUS'], 'integer'],
            [['ACCESS_UNIX','CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
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
            'ACCESS_UNIX' => Yii::t('app', 'Access.Unix'),
            'ID_PEKERJA' => Yii::t('app', 'Id.Pekerja'),
            'TGL' => Yii::t('app', 'Tanggal'),
			'HARI' => Yii::t('app', 'Hari'),
            'JAM_MASUK' => Yii::t('app', 'Jam.Masuk'),			
            'JAM_KELUAR' => Yii::t('app', 'Jam.Keluar'),
            'TODOLIST' => Yii::t('app', 'Todolist'),
            'KETERANGAN' => Yii::t('app', 'Keterangan'),
            'STATUS' => Yii::t('app', 'Status'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_AT' => Yii::t('app', 'Create  At'),
            'UPDATE_BY' => Yii::t('app', 'Update  By'),
            'UPDATE_AT' => Yii::t('app', 'Update  At'),
            'ClientNm' => Yii::t('app', 'CLient'),
        ];
    }
	public function fields()
	{
		return [			
			'ID'=>function($model){
				return $model->ID;
			},
			'ACCESS_UNIX'=>function($model){
				return $model->ACCESS_UNIX;
			},					
			'ID_PEKERJA'=>function($model){
				return $model->ID_PEKERJA;
			},	
			'TGL'=>function($model){
				return $model->TGL;
			},				
			'JAM_MASUK'=>function($model){
				return $model->JAM_MASUK;
			},	
			'JAM_KELUAR'=>function($model){
				return $model->JAM_KELUAR;
			},
			'KETERANGAN'=>function($model){
				return $model->KETERANGAN;
			},
			'STATUS'=>function($model){
				return $model->STATUS;
			},
			'CLIENT'=>function(){
				return $this->profileTbl->NM_DEPAN;
			}
		];
	}
	
	public  function  getProfileTbl(){
		return $this->hasOne(UserProfil::className(),['ACCESS_UNIX'=>'ACCESS_UNIX']);
	}
	
	public function getClientNm(){
		return $this->profileTbl['NM_DEPAN'];
	}
}
