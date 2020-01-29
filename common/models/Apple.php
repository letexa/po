<?php

namespace common\models;

use Yii;
use common\models\StatusLog;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property int $color_id
 * @property int $status_id
 * @property int $size
 * @property string $createdate
 * @property string $updatedate
 *
 * @property Color $color
 * @property Status $status
 */
class Apple extends \yii\db\ActiveRecord
{
    /**
     * Период (в месяцах) до сегодняшнего дня, в течение которого может появится яблоко
     */
    const PERIOD = 1; // месяц

    /**
     * Старые данные модели
     *
     * @var [type]
     */
    public $oldRecord;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    public function afterFind()
    {
        $this->oldRecord = clone $this;
        return parent::afterFind();     
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        /** Запись в лог, если статус был обновлен */ 
        if ($this->oldRecord && $this->oldRecord->status_id != $this->status_id) {
            $log = new StatusLog();
            $log->old_status_id = $this->oldRecord->status_id;
            $log->new_status_id = $this->status_id;
            $log->save();
        }

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color_id', 'status_id'], 'required'],
            [['color_id', 'status_id'], 'integer'],
            [['createdate', 'updatedate'], 'safe'],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['color_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['size'], 'number', 'integerOnly' => TRUE, 'min' => 1, 'max' => 100]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color_id' => 'Цвет',
            'status_id' => 'Статус',
            'size' => 'Целостность яблока',
            'createdate' => 'Дата появления',
            'updatedate' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
}
