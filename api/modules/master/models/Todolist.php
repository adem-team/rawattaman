<?php

namespace api\modules\master\models;

use Yii;

/**
 * This is the model class for table "todolist".
 *
 * @property string $ID
 * @property string $LIST_NAME
 * @property string $KETERANGAN
 * @property int $STATUS
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class Todolist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'todolist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['KETERANGAN'], 'string'],
            [['STATUS'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['LIST_NAME'], 'string', 'max' => 255],
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
            'LIST_NAME' => Yii::t('app', 'List  Name'),
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
			'LIST_NAME'=>function($model){
				return $model->LIST_NAME;
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
