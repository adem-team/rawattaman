<?php

namespace api\modules\master\models;

use Yii;

use api\modules\master\models\Pekerja;
use api\modules\master\models\PekerjaSearch;

class RatingJadwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $inKondition;
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
            [['TGL', 'JAM_MASUK', 'JAM_KELUAR', 'CREATE_AT', 'UPDATE_AT','inKondition'], 'safe'],
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
			}
		];
	}
}
