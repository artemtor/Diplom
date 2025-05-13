<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public $maxPrice;
    public $color;
    public function rules()
    {
        return [
            [['color'], 'string'],
            [['maxPrice'], 'integer'],
            [['id', 'name', 'price', 'color', 'category_id'], 'integer'],
            [['photo', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Product::find();

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
    // // Фильтрация по цене
    if ($this->maxPrice) {
        $query->andWhere(['<=', 'price', $this->maxPrice]);
    }
    if ($this->category_id) {
        $query->andWhere(['category_id' => $this->category_id]);
    }
    // Фильтрация по цвету
    if ($this->color) {
        $query->andWhere(['color' => $this->color]);
    }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'color' => $this->color,
            'date' => $this->date,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'photo', $this->photo])
        ->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere(['like', 'color', $this->color]);

        return $dataProvider;
    }
}
