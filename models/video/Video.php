<?php

namespace app\models\video;

use app\models\Material;
use app\components\UserPermissions;
use app\models\category\Category;

/**
 * This is the model class for table "video".
 *
 * @author Alexander Schilling
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $code
 * @property string $platform
 * @property string $thumbnail
 * @property int $published
 * @property string $author
 * @property int $user_id
 * @property int $status_id
 * @property int $category_id
 * @property int $hits
 * @property string $language
 * @property int $allow_comments
 * @property string $meta_description
 * @property string $meta_keywords
 */
class Video extends Material
{

    /** @var string */
    const PLATFORM_YOUTUBE = 'youtube';

    /** @var array */
    const PLATFORM = [
        self::PLATFORM_YOUTUBE => 'YouTube'
    ];

    /** @var array */
    const LANGUAGE = [
        0 => 'Русский',
        1 => 'Английский',
    ];

    /**
     * Table name
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * Validation rules
     *
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code', 'published', 'author'], 'required'],
            [['description', 'code', 'platform', 'thumbnail', 'language'], 'string'],
            [['title', 'author'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['status_id', 'published', 'user_id', 'category_id', 'hits', 'allow_comments'], 'integer'],
            [['meta_keywords'], 'string', 'max' => 256],
            [['meta_description'], 'string', 'max' => 156],
        ];
    }

    /**
     * Scenarios
     *
     * @inheritdoc
     */
    public function scenarios()
    {

        $scenarios = parent::scenarios();

        $scenarios[Material::SCENARIO_CREATE] = [
            'title',
            'description',
            'code',
            'platform',
            'thumbnail',
            'allow_comments',
            'category_id',
            'author',
            'language'
        ];

        $scenarios[Material::SCENARIO_UPDATE] = [
            'title',
            'description',
            'code',
            'platform',
            'thumbnail',
            'allow_comments',
            'category_id',
            'author',
            'language'
        ];

        $scenarios[Material::SCENARIO_ADMIN] = [
            'title',
            'description',
            'code',
            'platform',
            'thumbnail',
            'allow_comments',
            'status_id',
            'category_id',
            'author',
            'meta_keywords',
            'meta_description',
            'language'
        ];

        return $scenarios;

    }

    /**
     * Attribute labels
     *
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'code' => 'Код видео',
            'published' => 'Дата публикации',
            'author' => 'Автор видео',
            'status_id' => 'Статус',
            'platform' => 'Платформа',
            'thumbnail' => 'Картинка',
            'user_id' => 'ID автора',
            'category_id' => 'Категория',
            'hits' => 'Просмотров',
            'allow_comments' => 'Разрешить комментарии',
            'language' => 'Язык видео'
        ];
    }

    /**
     * Find
     *
     * {@inheritdoc}
     *
     * @return VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideoQuery(get_called_class());
    }

    /**
     * Return category
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id'])
            ->andOnCondition(['material_id' => Material::MATERIAL_VIDEO_ID]);
    }

    /**
     * Before save video
     *
     * @param bool $insert
     *
     * @return bool
     */
    public function beforeSave($insert): bool
    {

        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {

            if (isset(\Yii::$app->user->id)) {
                $this->user_id = \Yii::$app->user->id;
            }

            if (empty($this->published)) {
                $this->published = time();
            }

            if (empty($this->allow_comments)) {
                $this->allow_comments = Material::STATUS_PUBLIC;
            }

            if (empty($this->author)) {
                $this->author = $this->user->username;
            }

            $this->hits = 0;

            if (empty($this->category_id)) {
                $this->category_id = 0;
            }

        }

        if (!UserPermissions::canAdminVideo()) {
            $this->status_id = \Yii::$app->params['video']['preModeration']
                ? Material::STATUS_DRAFT : Material::STATUS_PUBLIC;
        }

        return true;

    }
}