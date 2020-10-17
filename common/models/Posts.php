<?php

namespace common\models;

use app\modules\v2\models\GenerateString;
use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int|null $owner_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $platform
 * @property string|null $file
 * @property int $approved
 * @property int|null $multiple_file If multiple_file is 0, it means only one file is attached to the post. If 1, it means more than one file is attached to the post.
 * @property int $paid_post Paid post is used to determine if the post require payment. 1 means payment required, 0 means payment not required.
 * @property string|null $post_token
 * @property float|null $advert_amount If paid_post is 1, the amount to be paid
 * @property string|null $payment_status If user has paid or not.
 * @property int $created_by
 * @property int|null $updated_by
 * @property int|null $approved_by
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property PostComment[] $postComments
 * @property PostFile[] $postFiles
 * @property PostLike[] $postLikes
 */
class Posts extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['owner_id', 'approved', 'multiple_file', 'paid_post', 'created_by', 'updated_by', 'approved_by'], 'integer'],
            [['title', 'slug', 'content', 'platform', 'created_by'], 'required'],
            [['content', 'platform'], 'string'],
            [['advert_amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'post_token'], 'string', 'max' => 200],
            [['file', 'payment_status'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'owner_id' => 'Owner ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'content' => 'Content',
            'platform' => 'Platform',
            'file' => 'File',
            'approved' => 'Approved',
            'multiple_file' => 'Multiple File',
            'paid_post' => 'Paid Post',
            'post_token' => 'Post Token',
            'advert_amount' => 'Advert Amount',
            'payment_status' => 'Payment Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'approved_by' => 'Approved By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[PostComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostComments()
    {
        return $this->hasMany(PostComment::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[PostFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostFiles()
    {
        return $this->hasMany(PostFile::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[PostLikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostLikes()
    {
        return $this->hasMany(PostLike::className(), ['post_id' => 'id']);
    }


    public function beforeSave($insert)
    {

        if ($this->isNewRecord) {
            $this->post_token = GenerateString::widget();
            $this->created_at = date('y-m-d H-i-s');
            $this->created_by = Yii::$app->user->id;
        } else {
            $this->updated_at = date('y-m-d H-i-s');
            $this->updated_by = Yii::$app->user->id;
        }

        if (!empty($this->approved))
            $this->approved_by = Yii::$app->user->id;

        return parent::beforeSave($insert);
    }
}
