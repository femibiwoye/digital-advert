<?php

namespace api\modules\v1\controllers;


use api\modules\v1\models\ApiResponse;
use api\modules\v1\models\PostComments;
use api\modules\v1\models\PostLikes;
use api\modules\v1\models\Posts;
use api\modules\v1\models\PostView;
use Yii;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;


/**
 * Amazon controller
 */
class PostController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        //For CORS
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];
        //$behaviors['authenticator'] = $auth;
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];

        return $behaviors;
    }

    public function actionAllPost()
    {
        $model = Posts::find()
            ->where(['is_approved' => 1, 'is_promoted' => 1])
            ->all();
        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionMyPost()
    {
        $model = Posts::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->all();
        if (!$model)
            return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT);


        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionApprovedPost()
    {
        $model = Posts::find()
            ->where(['user_id' => Yii::$app->user->id, 'is_approved' => 1])
            ->all();
        if (!$model)
            return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionPendingPost()
    {
        $model = Posts::find()
            //->joinWith(['postLike'])
            ->where(['user_id' => Yii::$app->user->id, 'is_approved' => 0])
            ->all();

        if (!$model)
            return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionLike($post_id)
    {
        $model = Posts::findOne(['id' => $post_id]);
        if (!$model) {
            return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'Post is not found!');
        }

        if ($model->postLike) {
            if (!$model->feedDisliked()) {
                return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'Post is not disliked!');
            }

            return (new ApiResponse)->success(null, ApiResponse::SUCCESSFUL, 'Post is disliked');
        }

        $model = new PostLikes();
        $model->post_id = $post_id;
        $model->user_id = Yii::$app->user->id;
        if (!$model->save()) {
            return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'Post not liked');
        }

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL, 'Post liked');
    }

    public function actionLikes($post_id)
    {
        $model = PostLikes::findAll(['post_id' => $post_id]);

        if (!$model)
            return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionComments($post_id)
    {
        $model = PostComments::findAll(['post_id' => $post_id]);

        if (!$model)
            return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionCreatePost()
    {
        $model = new Posts();
        $model->user_id = Yii::$app->user->id;
        $model->attributes = Yii::$app->request->post();
        if (!$model->validate()) {
            return (new ApiResponse)->error($model->getErrors(), ApiResponse::VALIDATION_ERROR);
        }

        if (!$model->save())
            return (new ApiResponse)->error($model, ApiResponse::UNABLE_TO_PERFORM_ACTION);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionRetweetPost()
    {
        $model = new PostComments();
        $model->user_id = Yii::$app->user->id;
        $model->type = 'share';
        $model->attributes = Yii::$app->request->post();
        if (!$model->validate()) {
            return (new ApiResponse)->error($model->getErrors(), ApiResponse::VALIDATION_ERROR);
        }

        if (!$model->save())
            return (new ApiResponse)->error($model, ApiResponse::UNABLE_TO_PERFORM_ACTION);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionViewPost($post_id)
    {
        if ($model = PostView::findOne(['post_id' => $post_id, 'user_id' => Yii::$app->user->id])) {
            $model->view_count = $model->view_count + 1;
        } else {
            $model = new PostView();
            $model->post_id = $post_id;
            $model->user_id = Yii::$app->user->id;
        }

        if (!$model->save())
            return (new ApiResponse)->error($model, ApiResponse::UNABLE_TO_PERFORM_ACTION);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }
}

