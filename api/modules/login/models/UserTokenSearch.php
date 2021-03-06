<?php
/**
 * NOTE: Nama Class harus diawali Hurup Besar
 * Server Linux 	: hurup besar/kecil bermasalah -case sensitif-
 * Server Windows 	: hurup besar/kecil tidak bermasalah
 * Author: -ptr.nov-
*/

namespace api\modules\login\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;
/**
  * Option user, employe, modul, permission
  * @author ptrnov  <piter@lukison.com>
  * @since 1.1
*/
class UserTokenSearch extends UserToken
{
	public function rules()
    {
         return [
			[['username','auth_key','password_hash','POSITION_ACCESS'], 'required','on' => self::SCENARIO_USER],	
			[['username','auth_key','password_hash','password_reset_token'], 'string'],
			[['ID_FB','ID_GOOGLE','ID_TWITTER','ID_LINKEDIN','ID_YAHOO','email','ID_ONESIGNAL'], 'string'],
			[['updated_at'],'safe'],
			[['ACCESS_UNIX','UUID'], 'safe'],
		];
    }

    public function search($params)
    {
		
		$query = UserToken::find();
			
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination'=>[
				'pageSize'=>100,
			]   
		]);

		$this->load($params);
		if (!$this->validate()) {
			return $dataProvider;
		}

		$query->orWhere(['username'=> $this->username]);
		$query->orWhere(['email'=> $this->email]);
		// $query->orWhere(['ID_FB'=> $this->ID_FB]);
		// $query->orWhere(['ID_GOOGLE'=> $this->ID_GOOGLE]);
		// $query->orWhere(['ID_TWITTER'=> $this->ID_TWITTER]);
		// $query->orWhere(['ID_LINKEDIN'=> $this->ID_LINKEDIN]);
		//$query->orWhere(['ID_YAHOO'=> $this->ID_YAHOO]);
		//$query->orWhere(['ID_ONESIGNAL'=> $this->ID_ONESIGNAL]);
	
		$query->orFilterWhere(['ID_YAHOO'=> $this->ID_YAHOO]);
		$query->orFilterWhere(['ID_FB'=> $this->ID_FB]);
		$query->orFilterWhere(['ID_GOOGLE'=> $this->ID_GOOGLE]);
		$query->orFilterWhere(['ID_TWITTER'=> $this->ID_TWITTER]);
		$query->orFilterWhere(['ID_LINKEDIN'=> $this->ID_LINKEDIN]);
		$query->orFilterWhere(['ID_ONESIGNAL'=> $this->ID_ONESIGNAL]);
		// return $dataProvider;
		if($dataProvider->getmodels()){		
			return $dataProvider;
		}else{
			 //return Yii::$app->statusCode->apihandling(204);
			// return $this->handleFailure($response);
			return new \yii\web\HttpException(204, 'Not Data Content');
		}	
    }

}
