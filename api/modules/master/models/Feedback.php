<?php

namespace api\modules\master\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property string $ID
 * @property string $ACCESS_UNIX
 * @property string $NOTE
 * @property string $TGL
 * @property string $JAM
 * @property int $STATUS
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOTE'], 'string'],
            [['TGL', 'JAM', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['STATUS'], 'integer'],
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
            'ACCESS_UNIX' => Yii::t('app', 'Access.Unix'),
            'NOTE' => Yii::t('app', 'Note Feedback'),
            'TGL' => Yii::t('app', 'Tanggal'),
            'JAM' => Yii::t('app', 'Jam'),
            'STATUS' => Yii::t('app', 'Status'),
            'CREATE_BY' => Yii::t('app', 'Create.By'),
            'CREATE_AT' => Yii::t('app', 'Create.At'),
            'UPDATE_BY' => Yii::t('app', 'Update.By'),
            'UPDATE_AT' => Yii::t('app', 'Update.At'),
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
			'JAM'=>function($model){
				return $model->JAM;
			},	
			'STATUS'=>function($model){
				return $model->STATUS;
			},
			'NOTE'=>function($model){
				return $model->NOTE;
			}
		];
	}
}
