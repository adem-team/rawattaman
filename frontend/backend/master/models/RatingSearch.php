<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\Rating;

/**
 * RatingSearch represents the model behind the search form of `frontend\backend\master\models\Rating`.
 */
class RatingSearch extends Rating
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'JADWAL_ID', 'NILAI', 'STATUS'], 'integer'],
            [['ACCESS_UNIX', 'ID_PEKERJA', 'NILAI_KETERANGAN', 'TGL', 'JAM_MASUK', 'JAM_KELUAR', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT'], 'safe'],
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
        $query = Rating::find();

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
            'ID' => $this->ID,
            'JADWAL_ID' => $this->JADWAL_ID,
            'NILAI' => $this->NILAI,
            'TGL' => $this->TGL,
            'JAM_MASUK' => $this->JAM_MASUK,
            'JAM_KELUAR' => $this->JAM_KELUAR,
            'STATUS' => $this->STATUS,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_UNIX', $this->ACCESS_UNIX])
            ->andFilterWhere(['like', 'ID_PEKERJA', $this->ID_PEKERJA])
            ->andFilterWhere(['like', 'NILAI_KETERANGAN', $this->NILAI_KETERANGAN])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
