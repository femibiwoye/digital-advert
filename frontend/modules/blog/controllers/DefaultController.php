<?php

namespace frontend\modules\blog\controllers;

use common\models\BlogPost;
use common\models\Category;
use frontend\models\Posts;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `blog` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($s=null)
    {
        $query = BlogPost::find()->where(['status' => 1])
            ->orderBy('id DESC');

        if (!empty($s)) {

            $query = $query->andFilterWhere(['OR',
                ['like', 'title', $s],
                ['like', 'subtitle', $s],
                ['like', 'message', $s],
                ['like', 'meta', $s],
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 13
            ]
        ]);


        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionDetails($slug)
    {

        $model = BlogPost::findOne(['slug' => $slug]);
        $recent = BlogPost::find()->where(['AND',['<>', 'id', $model->id],['status'=>1]])->limit(4)->all();
        $category = Category::find()->where(['status'=>1])->limit(5)->all();
        return $this->render('details', [
            'model' => $model,
            'recent'=>$recent,
            'category'=>$category,
        ]);
    }
}
