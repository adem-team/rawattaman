<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\UserProfil;

/**
 * UserProfilSearch represents the model behind the search form of `app\backend\sistem\models\UserProfil`.
 */
class UserProfilSearch extends UserProfil
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCESS_UNIX', 'NM_DEPAN', 'NM_TENGAH', 'NM_BELAKANG', 'KTP', 'ALAMAT', 'LAHIR_TEMPAT', 'LAHIR_TGL', 'LAHIR_GENDER', 'HP', 'EMAIL', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UserProfil::find()->JoinWith('userTbl',true,'INNER JOIN');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'LAHIR_TGL' => $this->LAHIR_TGL,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
			'user_profil.ACCESS_UNIX'=> $this->ACCESS_UNIX
        ]);

        $query->andFilterWhere(['like', 'NM_DEPAN', $this->NM_DEPAN])
            ->andFilterWhere(['like', 'NM_TENGAH', $this->NM_TENGAH])
            ->andFilterWhere(['like', 'NM_BELAKANG', $this->NM_BELAKANG])
            ->andFilterWhere(['like', 'KTP', $this->KTP])
            ->andFilterWhere(['like', 'ALAMAT', $this->ALAMAT])
            ->andFilterWhere(['like', 'LAHIR_TEMPAT', $this->LAHIR_TEMPAT])
            ->andFilterWhere(['like', 'LAHIR_GENDER', $this->LAHIR_GENDER])
            ->andFilterWhere(['like', 'HP', $this->HP])
            ->andFilterWhere(['like', 'EMAIL', $this->EMAIL])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
