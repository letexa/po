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
     * Период, через который яблоко гниет (в часах)
     */
    const ROT_PERIOD = 5;

    /**
     * Старые данные модели
     *
     * @var [type]
     */
    public $oldRecord;

    public function __construct()
    {
        parent::__construct();

    }

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

        /** Удаление съеденного яблока */
        if ($this->size <= 0) {
            $this->delete();
        } else {
            /** Запись в лог, если статус был обновлен */ 
            if ($this->oldRecord && $this->oldRecord->status_id != $this->status_id) {
                $log = new StatusLog();
                $log->status_id = $this->status_id;
                $log->apple_id = $this->id;
                $log->save();
            }
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
            [['size'], 'number', 'integerOnly' => FALSE, 'min' => 0, 'max' => 100.00],
            [['status_id'], 'statusValidate'],
            [['size'], 'sizeValidate'],
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

    /**
     * Валидация для статусов
     *
     * @param string $attribute
     * @return void
     */
    public function statusValidate($attribute)
    {
        if (!$this->oldRecord) {
            return true;
        }

        if ($this->oldRecord->status_id == status::HANGING_STATUS && $this->status_id == Status::ROTTEN_STATUS) {
            $this->addError($attribute, 'Висящее на дерево яблоко не может сгнить');
        }

        if ($this->oldRecord->status_id == status::FALL_STATUS && $this->status_id == Status::HANGING_STATUS) {
            $this->addError($attribute, 'Яблоко уже не вернуть назад на дерево');
        }

        if (($this->oldRecord->status_id == status::ROTTEN_STATUS && $this->status_id == Status::HANGING_STATUS) ||
            ($this->oldRecord->status_id == status::ROTTEN_STATUS && $this->status_id == Status::FALL_STATUS)) {
            $this->addError($attribute, 'Выброси его, оно уже сгнило');
        }
    }

    /**
     * Валидация для целостности
     *
     * @param string $attribute
     * @return void
     */
    public function sizeValidate($attribute)
    {
        if (!$this->oldRecord) {
            return true;
        }

        if ($this->oldRecord->status_id == status::HANGING_STATUS && $this->size < 100) {
            $this->addError($attribute, 'Сначала яблоко должно упасть');
        }

        if ($this->oldRecord->status_id == status::ROTTEN_STATUS && $this->oldRecord->size != $this->size) {
            $this->addError($attribute, 'Фу! Собрался жрать гнилое яблоко!');
        }

        if ($this->oldRecord->size < $this->size) {
            $this->addError($attribute, 'Погрызанное яблоко нельзя увеличить');
        }
    }

    /**
     * Создание яблока
     *
     * @return void
     */
    static public function appleCreate()
    {
        $model = new self();

        /** Задаем случайный цвет */ 
        $model->color_id = random_int(1, Color::find()->count());

        /** Задаем случайную дату появления в определенном диапазоне, 
         * например в течение месяца
        */
        $date_to = new \DateTime();
        $date_from = new \DateTime();
        $date_from->modify('-' . $model::PERIOD . ' month');
        $model->createdate = random_int($date_from->format('U'), $date_to->format('U'));
        $model->createdate = date('Y-m-d H:i:s', $model->createdate);

        $model->status_id = Status::HANGING_STATUS;
        return $model->save();
    }
}
