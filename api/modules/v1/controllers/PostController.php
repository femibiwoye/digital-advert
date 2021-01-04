<?php

namespace api\modules\v1\controllers;


use api\components\Utility;
use api\modules\v1\models\ApiResponse;
use api\modules\v1\models\PostComments;
use api\modules\v1\models\PostLikes;
use api\modules\v1\models\Posts;
use api\modules\v1\models\PostView;
use api\modules\v1\models\Settings;
use api\modules\v1\models\TwitterAccounts;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
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
        $query = Posts::find()
            ->where(['is_approved' => 1, 'is_promoted' => 1]);
        $provider = new ActiveDataProvider([
            'query' => $query->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 3,
                'validatePage' => false,
            ],
        ]);

        if ($provider->totalCount > 0)
            return (new ApiResponse)->success($provider->getModels(), ApiResponse::SUCCESSFUL, 'Search result', $provider);
        return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT, 'No result');
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
        $model->like_status = 1;
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
        $model = PostComments::findAll(['post_id' => $post_id, 'status' => 1]);

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

//        if (PostComments::find()->where(['user_id' => Yii::$app->user->id, 'post_id' => $model->post_id])->exists()) {
//            return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'You cannot share the same post twice');
//        }

        if (!$model->save())
            return (new ApiResponse)->error($model, ApiResponse::UNABLE_TO_PERFORM_ACTION);

        if ($twitterAccount = TwitterAccounts::find()->where(['user_id' => Yii::$app->user->id])->one()) {
            $status_id = $model->post->tweet_id;
            $media = $model->media;
            //$connection = Utility::TwitterConnection($twitterAccount->oauth_token,$twitterAccount->oauth_token_secret);
            //$token = 'ZOZCwlvwwXcG9JZ6yljAsRQlkHWGEJoEhC9-RbR2BXuccv5iqbaNi2vFleNVidGf7iPTrh5HpqIGkAdGx58HzVAWLI2sCQLu2LZfe2tkV_erN62TlM8EffLxq6guIgwSVQFFDtR38OFkzMRTmqvxtd1DACVEyOD8C_pPXYSAxOLbowK5awKMa4TKEDsJxKcSg0-kn2tD';
            //  $tokenStr = '94iGAQAAAAABHor0AAABdsox9bI';
            //$connection = Utility::TwitterConnection($tokenStr,$token);
            $connection = Utility::TwitterConnection();
            $path = Url::to("@webfolder/images/tmp");
            Utility::CreateFolder($path);

            if (!empty($media) && $media != "[]") {
                if (is_array($media)) {
                    $upload = [];
                    foreach ($media as $m) {
                        $uploadResponse = $connection->upload('media/upload', ['media' => Utility::GetFileNameWithExtension($m, $path)]);
                        $upload[] = $uploadResponse->media_id_string;
                    }
                    $data['media_ids'] = implode(',', $upload);
                } else {
                    $upload = $connection->upload('media/upload', ['media' => Utility::GetFileNameWithExtension($media, $path)]);
                    $data["media_ids"] = $upload->media_id_string;
                }
            }

            $reply = ['in_reply_to_status_id' => $status_id, 'status' => $model->comment];
            if (isset($data['media_ids'])) {
                $reply = array_merge($reply, ['media_ids' => $data['media_ids']]);
            }

            if ($response = $connection->post('statuses/update', $reply)) {
                $earned = Settings::findOne(['key_word' => 'user_share_point']);
                Utility::UpdateWallet($earned->value, 'credit');
                $model->tweet_id = $response->id_str;
                $model->raw = json_encode($response);
                $model->status = 1;
                $model->save();
            }
        }

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

