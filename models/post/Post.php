<?php

namespace app\models\post;

use Yii;
use yii\base\Model;
use yii\db\ActiveQuery;
use app\models\Material;
use Dignity\TranslitHelper;
use app\models\category\Category;
use app\models\Tag;
use app\models\User;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string  $title
 * @property string  $slug
 * @property string  $content
 * @property integer $status_id
 * @property integer $datecreate
 * @property integer $dateupdate
 * @property integer $user_id
 * @property integer $hits
 * @property bool    $allow_comments
 * @property integer $ontop
 * @property string  $premium
 * @property string  $meta_description
 * @property integer $category_id
 * @property integer $show_share_buttons
 * @property integer $show_post_details
 *
 * relations
 * @property Tag[] $tags
 *
 * @author Alexander Schilling
 *
 */
class Post extends Material
{

    public const SHOW_ON_TOP = 1;

    /** @var array */
    public $form_tags;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'datecreate', 'dateupdate', 'user_id', 'hits', 'ontop', 'category_id'], 'required'],
            [['content', 'allow_comments', 'slug'], 'string'],
            [['status_id', 'datecreate', 'dateupdate', 'user_id', 'hits', 'ontop', 'category_id', 'show_share_buttons', 'show_post_details'], 'integer'],
            [['title'], 'string', 'max' => 69],
            [['premium', 'show_share_buttons', 'show_post_details'], 'string', 'max' => 1],
            [['meta_description'], 'string', 'max' => 156],
            [['form_tags'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {

        $scenarios = parent::scenarios();

        $scenarios[Model::SCENARIO_DEFAULT] = [
            'title',
            'content',
            'allow_comments',
            'status_id',
            'ontop',
            'meta_description',
            'slug',
            'form_tags',
            'category_id',
            'premium',
            'show_share_buttons',
            'show_post_details',
        ];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {

        return [
            'id'                 => 'ID',
            'title'              => 'Заголовок',
            'content'            => 'Текст',
            'status_id'          => 'Статус',
            'datecreate'         => 'Дата публикации',
            'dateupdate'         => 'Дата обновления',
            'user_id'            => 'ID Автора',
            'hits'               => 'Просмотров',
            'allow_comments'     => 'Разрешить комментарии',
            'ontop'              => 'На главную',
            'meta_description'   => 'Описание страницы (meta-description)',
            'slug'               => 'Постоянная ссылка',
            'form_tags'          => 'Тэги',
            'category_id'        => 'Категория',
            'premium'            => 'Premium',
            'show_share_buttons' => 'Показывать блок "поделиться"',
            'show_post_details'  => 'Показать подробную информацию',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {

        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->user_id = Yii::$app->user->id;
            $this->datecreate = time();
            $this->dateupdate = time();
            $this->hits = 0;

            if (empty($this->slug)) {
                $this->slug = TranslitHelper::translit($this->title);
            }
        } else {
            $this->dateupdate = time();

            if (empty($this->slug)) {
                $this->slug = TranslitHelper::translit($this->title);
            }
        }

        return true;
    }

    /**
     * @return \Yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(\demi\comments\common\models\Comment::className(), ['material_id' => 'id'])
                    ->andOnCondition(['material_type' => 1])
                    ->orderBy(['created_at' => SORT_ASC]);
    }

    /**
     * @inheritdoc
     *
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    /**
     * @return ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
                    ->select(['id', 'name', 'slug'])
                    ->viaTable(PostTag::tableName(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id'])
                    ->andOnCondition(['material_id' => Material::MATERIAL_POST_ID]);
    }

    /**
     * @return bool
     */
    public function isPremium(): bool
    {

        if (\Yii::$app->user->identity === null) {
            return false;
        }

        if (!\Yii::$app->user->identity->premium) {
            return false;
        }

        if (isset(\Yii::$app->user->identity)) {

            /** @var User $user */
            $user = User::findOne(\Yii::$app->user->identity->getId());

            if ($user->isExpired($user->premium_until)) {
                return false;
            }

        }

        return true;
    }

    /**
     * @return bool
     */
    public function commentsAllowed(): bool
    {

        // not premium post

        if (!$this->premium) {
            return $this->allow_comments;
        }

        // premium post, check premium user status

        if (!$this->isPremium()) {
            return false;
        }

        return $this->allow_comments;

    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @throws \yii\db\Exception
     */
    public function afterSave($insert, $changedAttributes)
    {

        // no tags selected, remove current tags

        if (($this->form_tags === '') && !$insert) {
            PostTag::deleteAll(['post_id' => $this->id]);
        }

        // tags selected, save tags

        if (is_array($this->form_tags)) {

            if (!$insert) {
                // Remove current tags
                PostTag::deleteAll(['post_id' => $this->id]);
            }

            if (count($this->form_tags)) {

                // form tags array
                $tag_ids = [];

                foreach ($this->form_tags as $tagName) {
                    $tag_ids[] = Tag::getIdByName($tagName);
                }

                $tag_ids = array_unique($tag_ids);

                if (($i = array_search(null, $tag_ids)) !== false) {
                    unset($tag_ids[$i]);
                }

                if (count($tag_ids)) {
                    // Insert new relations data
                    $data = [];

                    foreach ($tag_ids as $tag_id) {
                        $data[] = [$this->id, $tag_id];
                    }

                    Yii::$app->db->createCommand()->batchInsert(
                        PostTag::tableName(),
                        ['post_id', 'tag_id'],
                        $data
                    )->execute();
                }

            }

        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        return true;
    }
}
