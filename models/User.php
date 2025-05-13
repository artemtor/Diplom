<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface; 
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $adress
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $check_password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
{
    $scenarios = parent::scenarios();
    $scenarios['ajax'] = ['username', 'email']; // Поля для AJAX-валидации
    return $scenarios;
}
    public function rules()
    {
        return [
            [['username', 'password', 'email','fio'], 'required'],
            [['username'], 'match', 'pattern' => '/^[a-zA-Z0-9-]+$/', 'message' => 'Разрешены только латиница, цифры и тире'],
            [['fio'], 'match', 'pattern' => '/^[А-Яа-яЁё\s-]+$/u', 'message' => 'Разрешены только кириллица, пробел и тире'],
            [['username', 'email'], 'unique', 'message' => 'Пользователь с такими данными уже зарегистрирован'],
            ['email', 'email'],
            [['favorites'],'string'],
            [['is_admin'], 'integer'],
            ['check_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли должны совпадать'],
            [['username', 'password', 'email', 'adress'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'is_admin' => 'Администратор',
            'check_password' => 'Подтверждение пароля',
            'email' => 'Электронная почта',
            'adress' => 'Адрес',
            'fio' => 'ФИО',
        ];
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    
    public static function findIdentityByAccessToken($token, $type = null) {}
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getAuthKey(){}
    
    public function validateAuthKey($authKey) {}
    
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public function isAdmin() {
        return boolval($this->is_admin);
    }
    public function getFavorites()
{
    if (Yii::$app->user->isGuest) {
        return Yii::$app->session->get('favorites', []);
    }
    // Для зарегистрированных пользователей можно хранить в JSON в поле user
    return $this->favorites ? json_decode($this->favorites, true) : [];
}

public function addFavorite($productId)
{
    if (Yii::$app->user->isGuest) {
        $favorites = Yii::$app->session->get('favorites', []);
        if (!in_array($productId, $favorites)) {
            $favorites[] = $productId;
            Yii::$app->session->set('favorites', $favorites);
        }
    } else {
        $favorites = $this->favorites ? json_decode($this->favorites, true) : [];
        if (!in_array($productId, $favorites)) {
            $favorites[] = $productId;
            $this->favorites = json_encode($favorites);
            $this->save();
        }
    }
}

public function removeFavorite($productId)
{
    if (Yii::$app->user->isGuest) {
        $favorites = Yii::$app->session->get('favorites', []);
        $key = array_search($productId, $favorites);
        if ($key !== false) {
            unset($favorites[$key]);
            Yii::$app->session->set('favorites', array_values($favorites));
        }
    } else {
        $favorites = $this->favorites ? json_decode($this->favorites, true) : [];
        $key = array_search($productId, $favorites);
        if ($key !== false) {
            unset($favorites[$key]);
            $this->favorites = json_encode(array_values($favorites));
            $this->save();
        }
    }
}

public function isFavorite($productId)
{
    if (Yii::$app->user->isGuest) {
        $favorites = Yii::$app->session->get('favorites', []);
        return in_array($productId, $favorites);
    }
    $favorites = $this->favorites ? json_decode($this->favorites, true) : [];
    return in_array($productId, $favorites);
}
}
