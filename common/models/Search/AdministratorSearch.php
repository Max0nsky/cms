<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

class AdministratorSearch extends User
{
    public $created_at_start;
    public $created_at_end;

    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['username', 'email', 'created_at', 'updated_at'], 'safe'],
            [['created_at_start', 'created_at_end'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $this->status = 10;
        
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        if(!empty($this->created_at_start)){
            $query->andFilterWhere(['>=', 'created_at', strtotime($this->created_at_start)]);
        }

        if(!empty($this->created_at_end)){
            $query->andFilterWhere(['<=', 'created_at', strtotime($this->created_at_end)]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
