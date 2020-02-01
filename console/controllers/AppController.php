<?php
namespace console\controllers;

use yii\db\Query;
use yii\console\Controller;
use common\models\Apple;
use common\models\Status;
use common\models\StatusLog;

class AppController extends Controller
{
    /**
     * Через определенное время яблоки гниют
     *
     * @return void
     */
    public function actionRotten()
    {
        $count = Apple::find()->where(['status_id' => Status::FALL_STATUS])->count();
        if ($count) {
            $limit = 20;
            for ($i = 0; $i < $count; $i += $limit) {
                $Query = new Query();
                $data = Apple::find()
                    ->where(['status_id' => Status::FALL_STATUS])
                    ->limit($limit)
                    ->offset($i)
                    ->all();

                if ($data) {
                    foreach ($data as $item) {
                        $log = StatusLog::findOne(['apple_id' => $item->id, 'status_id' => Status::FALL_STATUS]);
                        if ($log && strtotime($log->updatedate) <= (time() - Apple::ROT_PERIOD * 60 * 60)) {
                            $item->status_id = Status::ROTTEN_STATUS;
                            $item->save();
                        }
                    }
                }
            }
        }
    }
}