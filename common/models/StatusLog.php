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
            [['old_status_id', 'new_status_id'], 'required'],
            [['old_status_id', 'new_status_id'], 'integer'],
            [['updatedate'], 'safe'],
            [['new_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['new_status_id' => 'id']],
            [['old_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['old_status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'old_status_id' => 'Старый статус',
            'new_status_id' => 'Новый статус',
            'updatedate' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[NewStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'new_status_id']);
    }

    /**
     * Gets query for [[OldStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOldStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'old_status_id']);
    }
}
