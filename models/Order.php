<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $date
 * @property int|null $status_id
 * @property int|null $user_id
 * @property string $adress
 * @property string $payment_method
 * @property int $item_count
 * @property Cart[] $carts
 * @property OrderStatus $status
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
   public $monthNames = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['status_id', 'user_id','item_count'], 'integer'],
            [['adress', 'payment_method'], 'required'],
            [['payment_method'], 'string'],
            [['adress'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата создания',
            'status_id' => 'Статус заказа',
            'user_id' => 'Пользователь',
            'adress' => 'Адрес',
            'payment_method' => 'Способ оплаты',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(OrderStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function getTotalPrice()
{
    $total = 0;
    foreach ($this->carts as $cartItem) {
        $total += $cartItem->product->price * $cartItem->count;
    }
    return $total;
}
public static function getMonthlyStats()
{
    $stats = static::find()
        ->select(['MONTH(date) as month', 'COUNT(*) as count'])
        ->where(['YEAR(date)' => date('Y')])
        ->andWhere(['IS NOT', 'date', null])
        ->groupBy(['MONTH(date)'])
        ->asArray()
        ->all();

    $months = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];
    $labels = $months;
    $values = array_fill(0, 12, 0);

    foreach ($stats as $row) {
        $month = (int)$row['month'];
        $count = (int)$row['count'];
        if ($month >= 1 && $month <= 12) {
            $values[$month - 1] = $count;
        }
    }

    return ['labels' => $labels, 'values' => $values];
}



public static function checkTableExists()
{
    try {
        return self::getDb()
            ->createCommand("SELECT 1 FROM ".self::tableName()." LIMIT 1")
            ->execute() !== false;
    } catch (\Exception $e) {
        return false;
    }
}

public static function getMonthlyRevenueStats()
{
    $stats = static::find()
        ->select([
            'MONTH(date) as month', 
            'SUM((SELECT SUM(p.price * c.count) FROM cart c JOIN product p ON c.product_id = p.id WHERE c.order_id = order.id)) as total_revenue'
        ])
        ->where(['YEAR(date)' => date('Y')])
        ->andWhere(['IS NOT', 'date', null])
        ->groupBy(['MONTH(date)'])
        ->asArray()
        ->all();

    $months = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];
    $netValues = array_fill(0, 12, 0);

    foreach ($stats as $row) {
        $month = (int)$row['month'];
        $revenue = (float)$row['total_revenue'];
        if ($month >= 1 && $month <= 12) {
            $netValues[$month - 1] = $revenue * 0.87; // чистая прибыль (минус 13%)
        }
    }

    return [
        'labels' => $months,
        'netValues' => $netValues
    ];
}

 public $item_count = 0;
}
