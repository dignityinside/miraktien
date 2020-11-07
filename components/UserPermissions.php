<?php

namespace app\components;

use app\models\post\Post;
use app\models\User;
use app\models\forum\Forum;

/**
 * User permissions contains various methods to check what user can do
 *
 * @author Alexander Schilling
 */
class UserPermissions
{

    public const ADMIN_POST = 'adminPost';
    public const ADMIN_USERS = 'adminUsers';
    public const ADMIN_CATEGORY = 'adminCategory';
    public const ADMIN_FORUM = 'adminForum';

    /**
     * Checks if user can admin posts
     *
     * @return bool
     */
    public static function canAdminPost(): bool
    {

        if (\Yii::$app->user->isGuest) {
            return false;
        }

        if (\Yii::$app->user->can(self::ADMIN_POST)) {
            return true;
        }

        return false;
    }

    /**
     * Checks if user can edit particular posts
     *
     * @param Post $post
     *
     * @return bool
     */
    public static function canEditPost(Post $post): bool
    {
        if (\Yii::$app->user->isGuest) {
            return false;
        }

        if (self::canAdminPost()) {
            return true;
        }

        $currentUserID = \Yii::$app->user->getId();

        if ((int)$post->user_id === (int)$currentUserID) {
            return true;
        }

        return false;
    }

    /**
     * Checks if user can admin other users
     *
     * @return bool
     */
    public static function canAdminUsers(): bool
    {

        if (\Yii::$app->user->isGuest) {
            return false;
        }

        if (\Yii::$app->user->can(self::ADMIN_USERS)) {
            return true;
        }

        return false;
    }

    /**
     * Checks if user can edit profile
     *
     * @param User $user
     *
     * @return bool
     */
    public static function canEditUser(User $user): bool
    {

        if (\Yii::$app->user->isGuest) {
            return false;
        }

        $currentUserID = \Yii::$app->user->getId();

        if ((int)$user->id === $currentUserID) {
            return true;
        }

        if (self::canAdminUsers()) {
            return true;
        }

        return false;
    }

    /**
     * Checks if user can admin category
     *
     * @return bool
     */
    public static function canAdminCategory(): bool
    {

        if (\Yii::$app->user->isGuest) {
            return false;
        }

        if (\Yii::$app->user->can(self::ADMIN_CATEGORY)) {
            return true;
        }

        return false;
    }

    /**
     * Checks if user can admin forum
     *
     * @return bool
     */
    public static function canAdminForum(): bool
    {

        if (\Yii::$app->user->isGuest) {
            return false;
        }

        if (\Yii::$app->user->can(self::ADMIN_FORUM)) {
            return true;
        }

        return false;
    }

    /**
     * Checks if user can edit particular forum
     *
     * @param Forum $forum
     *
     * @return bool
     */
    public static function canEditForum(Forum $forum): bool
    {
        if (\Yii::$app->user->isGuest) {
            return false;
        }

        if (self::canAdminForum()) {
            return true;
        }

        $currentUserID = \Yii::$app->user->getId();

        if ((int)$forum->user_id === (int)$currentUserID) {
            return true;
        }

        return false;
    }
}
