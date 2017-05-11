<?php

namespace api\modules\master\models;

use Yii;

use api\modules\master\models\RatingImg;
use api\modules\master\models\RatingJadwal;
use api\modules\master\models\RatingPekerja;

class Rating extends \yii\db\ActiveRecord
{
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
            [['TGL', 'JAM_MASUK', 'JAM_KELUAR', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['ACCESS_UNIX', 'ID_PEKERJA', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'JADWAL_ID' => Yii::t('app', 'Jadwal.ID'),
            'ACCESS_UNIX' => Yii::t('app', 'Access Unix'),
            'ID_PEKERJA' => Yii::t('app', 'Id.Pekerja'),
            'NILAI' => Yii::t('app', 'Nilai'),
            'NILAI_KETERANGAN' => Yii::t('app', 'Keterangan'),
            'TGL' => Yii::t('app', 'Tanggal'),
            'JAM_MASUK' => Yii::t('app', 'Jam.Masuk'),
            'JAM_KELUAR' => Yii::t('app', 'Jam.Keluar'),
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
			'TGL'=>function($model){
				return $model->TGL;
			},	
			'JAM_MASUK'=>function($model){
				return $model->JAM_MASUK;
			},				
			'JAM_KELUAR'=>function($model){
				return $model->JAM_KELUAR;
			},				
			'STATUS'=>function($model){
				return $model->STATUS;
			},				
			'ID_PEKERJA'=>function($model){
				return $model->ID_PEKERJA;
			},				
			'JADWAL_ID'=>function($model){
				return $model->JADWAL_ID;
			},
			'JADWAL_LIST'=>function(){
				return $this->jadwalTbl;
			},			
			'LIST_PEKERJA'=>function(){
				return $this->pekerjaTbl;
			},
			'PHOTO_HASIL'=>function(){
				return $this->ratingImgTbl;//->IMAGE_64;
			}
			
		];
	}
	
	public function getRatingImgTbl(){
		return $this->hasMany(RatingImg::className(),['ACCESS_UNIX'=>'ACCESS_UNIX','RETING_ID'=>'ID']);
	}
	
	public function getJadwalTbl(){
		return $this->hasOne(RatingJadwal::className(),['ACCESS_UNIX'=>'ACCESS_UNIX','ID'=>'JADWAL_ID']);
	}
	
	//Join TABLE Pekerja
	public function getPekerjaTbl(){
		//return $this->hasMany(Item::className(), ['OUTLET_CODE' => 'OUTLET_CODE']);//->from(['formula' => Item::tableName()]);
		//$inKondition=('FIND_IN_SET("'.$this->ID_PEKERJA.'", ID_PEKERJA)');
		//$this->inKondition=$this->ID_PEKERJA;
		//return $this->hasMany(Pekerja::className(), ['ID_PEKERJA' =>'ID_PEKERJA']);//->andWhere('FIND_IN_SET( ID_PEKERJA,"'.$this->ID_PEKERJA.'")');
		//return $this->hasMany(Pekerja::className(),['ID_PEKERJA' =>'inKondition']);//->andWhere(['ID_PEKERJA' =>'ID_PEKERJA']);//->Where('FIND_IN_SET("'.$this->ID_PEKERJA.'", ID_PEKERJA)');
		//$model = Pekerja::find()->Where(['ID_PEKERJA'=>['RT0001','RT0002']])->all();
		$model = RatingPekerja::find()->Where('FIND_IN_SET( ID_PEKERJA,"'.$this->ID_PEKERJA.'")')->all();
		return $model;
	}	
}
