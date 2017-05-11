<?php

namespace api\modules\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use api\modules\master\models\RatingImg;

/**
 * RatingImgSearch represents the model behind the search form of `frontend\backend\master\models\RatingImg`.
 */
class RatingImgSearch extends RatingImg
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RETING_ID', 'STATUS'], 'integer'],
            [['ACCESS_UNIX', 'IMAGE_64', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT','KETERANGAN'], 'safe'],
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
        $query = RatingImg::find();

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
            'RETING_ID' => $this->RETING_ID,
            'STATUS' => $this->STATUS,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_UNIX', $this->ACCESS_UNIX])
            ->andFilterWhere(['like', 'IMAGE_64', $this->IMAGE_64])
            ->andFilterWhere(['like', 'KETERANGAN', $this->KETERANGAN])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
