<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $photo
 * @property int $name
 * @property int $price
 * @property int $color
 * @property string $date
 * @property int|null $category_id
 *
 * @property Cart[] $carts
 * @property Catergory $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name', 'price', 'color'], 'required'],
            [[ 'price','category_id'], 'integer'],
            [['date'], 'safe'],
            [['name', 'color'], 'match', 'pattern' => '/^[А-Яа-яЁё\s-]+$/u', 'message' => 'Разрешены только кириллица, пробел и тире'],
            [['name','color'], 'string', 'max' => 255],
            [['photo'], 'file', 'extensions' => ['png', 'jpg', 'gif','jpeg'], 'skipOnEmpty' => true],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catergory::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo' => 'Фото',
            'name' => 'Название',
            'price' => 'Цена',
            'category_id' => 'Категория',
            'color' => 'Цвет',
            'count' => 'Количество',
            'date' => 'Дата добавления',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Catergory::class, ['id' => 'category_id']);
    }
}
