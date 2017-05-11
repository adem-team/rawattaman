<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\Jadwal;

/**
 * JadwalSearch represents the model behind the search form of `frontend\backend\master\models\Jadwal`.
 */
class JadwalSearch extends Jadwal
{
	
	public function attributes()
	{
		//Author -ptr.nov- add related fields to searchable attributes 
		return array_merge(parent::attributes(), ['ClientNm']);
	}
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'STATUS'], 'integer'],
            [['ACCESS_UNIX', 'ID_PEKERJA', 'HARI', 'TGL', 'JAM_MASUK', 'JAM_KELUAR', 'TODOLIST', 'KETERANGAN', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT','ClientNm'], 'safe'],
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
        $query = Jadwal::find()->JoinWith('profileTbl',true,'LEFT JOIN');

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

		$dataProvider->sort->attributes['ClientNm'] = [
			'asc' => ['user_profil.NM_DEPAN' => SORT_ASC],
			'desc' => ['user_profil.NM_DEPAN' => SORT_DESC],
		];
        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
			'jadwal.ACCESS_UNIX'=>$this->ACCESS_UNIX,
            'TGL' => $this->TGL,
            'STATUS' => $this->STATUS
        ]);

        $query->andFilterWhere(['like', 'ID_PEKERJA', $this->ID_PEKERJA])
            ->andFilterWhere(['like', 'HARI', $this->HARI])
            ->andFilterWhere(['like', 'JAM_MASUK', $this->JAM_MASUK])
            ->andFilterWhere(['like', 'JAM_KELUAR', $this->JAM_KELUAR])
            ->andFilterWhere(['like', 'TODOLIST', $this->TODOLIST])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN])
            ->andFilterWhere(['like', 'CREATE_AT', $this->CREATE_AT])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_AT', $this->UPDATE_AT])
            ->andFilterWhere(['like', 'user_profil.NM_DEPAN', $this->ClientNm])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
