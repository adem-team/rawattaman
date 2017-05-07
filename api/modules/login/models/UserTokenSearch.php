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

			$query->andFilterWhere(['like', 'username', $this->username]);
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
