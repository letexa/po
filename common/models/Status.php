<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $alias
 * @property string $name
 *
 * @property Apple[] $apples
 * @property Statuslog[] $statuslogs
 * @property Statuslog[] $statuslogs0
 */
class Status extends \yii\db\ActiveRecord
{
    const HANGING_STATUS = 1;

    const FALL_STATUS = 2;

    const ROTTEN_STATUS = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'name'], 'required'],
            [['alias', 'name'], 'string', 'max' => 255],
            ['alias', 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'name' => 'Название',
        ];
    }

    /**
     * Gets query for [[Apples]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApples()
    {
        return $this->hasMany(Apple::className(), ['status_id' => 'id']);
    }

    /**
     * Gets query for [[Statuslogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatuslogs()
    {
        return $this->hasMany(Statuslog::className(), ['new_status_id' => 'id']);
    }

    /**
     * Gets query for [[Statuslogs0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatuslogs0()
    {
        return $this->hasMany(Statuslog::className(), ['old_status_id' => 'id']);
    }
}
