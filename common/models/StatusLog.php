<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "statuslog".
 *
 * @property int $id
 * @property int $old_status_id
 * @property int $new_status_id
 * @property string $updatedate
 *
 * @property Status $newStatus
 * @property Status $oldStatus
 */
class StatusLog extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statuslog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apple_id', 'status_id'], 'required'],
            [['apple_id', 'status_id'], 'integer'],
            [['updatedate'], 'safe'],
            [['apple_id'], 'exist', 'skipOnError' => true, 'targetClass' => apple::className(), 'targetAttribute' => ['apple_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'apple_id' => 'ID яблока',
            'status_id' => 'Статус',
            'updatedate' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[NewStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[OldStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApple()
    {
        return $this->hasOne(Apple::className(), ['id' => 'apple_id']);
    }
}
