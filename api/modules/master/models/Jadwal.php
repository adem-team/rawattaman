<?php

namespace api\modules\master\models;

use Yii;

use api\modules\master\models\Pekerja;
use api\modules\master\models\DataPekerja;
use api\modules\master\models\PekerjaSearch;
use api\modules\master\models\Todolist;

class Jadwal extends \yii\db\ActiveRecord
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
			},
			'LIST_PEKERJA'=>function(){
				return $this->pekerjaTbl;
			}
		];
	}
	
	//Join TABLE Pekerja - NO IMAGE
	public function getPekerjaTbl(){
		//return $this->hasMany(Item::className(), ['OUTLET_CODE' => 'OUTLET_CODE']);//->from(['formula' => Item::tableName()]);
		//$inKondition=('FIND_IN_SET("'.$this->ID_PEKERJA.'", ID_PEKERJA)');
		//$this->inKondition=$this->ID_PEKERJA;
		//return $this->hasMany(Pekerja::className(), ['ID_PEKERJA' =>'ID_PEKERJA']);//->andWhere('FIND_IN_SET( ID_PEKERJA,"'.$this->ID_PEKERJA.'")');
		//return $this->hasMany(Pekerja::className(),['ID_PEKERJA' =>'inKondition']);//->andWhere(['ID_PEKERJA' =>'ID_PEKERJA']);//->Where('FIND_IN_SET("'.$this->ID_PEKERJA.'", ID_PEKERJA)');
		//$model = Pekerja::find()->Where(['ID_PEKERJA'=>['RT0001','RT0002']])->all();
		$model = Pekerja::find()->Where('FIND_IN_SET( ID_PEKERJA,"'.$this->ID_PEKERJA.'")')->all();
		return $model;
	}	
	//Join TABLE Pekerja - WITH IMAGE
	public function getIMG_PEKERJA(){
		$model = DataPekerja::find()->Where('FIND_IN_SET( ID_PEKERJA,"'.$this->ID_PEKERJA.'")')->all();
		return $model;
	}	
	//Join TABLE - TODOLIST
	public function getTodolist(){
		$model = Todolist::find()->Where('FIND_IN_SET( ID,"'.$this->TODOLIST.'")')->all();
		return $model;
	}	
	
	public function extraFields()
	{
		return ['IMG_PEKERJA','Todolist'];
	}
}
