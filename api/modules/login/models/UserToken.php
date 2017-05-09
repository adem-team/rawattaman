<?php

namespace api\modules\login\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\Model;

use common\models\User;
use api\modules\login\models\UserImage;
use api\modules\login\models\UserProfil;
use api\modules\login\models\Corp;

class UserToken extends \yii\db\ActiveRecord
//class Userlogintest extends ActiveRecord implements IdentityInterface
{
	
	const SCENARIO_USER = 'createuser';
	const SCENARIO_API = 'createuserapi';
	public $new_pass;
	
	public static function getDb()
	{
		/* Author -ptr.nov- : HRD | Dashboard I */
		return \Yii::$app->dbkg;
	}
	
    
	public static function tableName()
    {
        return '{{user}}';
    }

	public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
	
    public function rules()
    {
        return [
			[['username','auth_key','password_hash','POSITION_ACCESS'], 'required','on' => self::SCENARIO_USER],		
			[['username','email','new_pass'], 'required','on' => self::SCENARIO_API],		
			[['username','auth_key','password_hash','password_reset_token'], 'string'],
			[['ID_FB','ID_GOOGLE','ID_TWITTER','ID_LINKEDIN'], 'string'],
			[['updated_at'],'safe'],
			[['ACCESS_UNIX','UUID','new_pass','email'], 'safe'],
		];
    }

	public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'User Name'),
            'email' => Yii::t('app', 'email'),
			'password_hash' => Yii::t('app', 'Password Hash'),
			'ACCESS_UNIX' => Yii::t('app', 'ACCESS_UNIX'),
			'UUID' => Yii::t('app', 'UUID'),		
			'ID_FB' => Yii::t('app', 'ID_FB'),		
			'ID_GOOGLE' => Yii::t('app', 'ID_GOOGLE'),		
			'ID_TWITTER' => Yii::t('app', 'ID_TWITTER'),		
			'ID_LINKEDIN' => Yii::t('app', 'ID_LINKEDIN'),		
        ];
    }
	
	public function fields()
	{
		return [
			'username'=>function($model){
				return $model->username;
			},
			'email'=>function($model){
				return $model->email;
			},
			'access_token'=>function($model){
				return $model->auth_key;
			},	
			'ACCESS_UNIX'=>function($model){
				return $model->ACCESS_UNIX;
			},
			'UUID'=>function($model){
				return $model->UUID;
			},
			'ID_FB'=>function($model){
					return $model->ID_FB;
			},
			'ID_GOOGLE'=>function($model){
					return $model->ID_GOOGLE;
			},
			'ID_TWITTER'=>function($model){
					return $model->ID_TWITTER;
			},
			'ID_LINKEDIN'=>function($model){
					return $model->ID_LINKEDIN;
			},				
		];
	} 	
}
?>
