<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string $type
 * @property string $key
 * @property string $message
 * @property int $read
 * @property string $created_at
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'key', 'message'], 'required'],
            [['read'], 'integer'],
            [['created_at'], 'safe'],
            [['type', 'key', 'message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'key' => 'Key',
            'message' => 'Message',
            'read' => 'Read',
            'created_at' => 'Created At',
        ];
    }
    public static function getUnreadCount()
    {
        return self::find()->where(['read' => 0])->count();
    }

    /**
     * Получает последние уведомления
     * @param int $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getRecentNotifications($limit = 5)
    {
        return self::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->limit($limit)
            ->all();
    }
}
