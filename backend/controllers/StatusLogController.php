<?php

namespace backend\controllers;

use Yii;
use common\models\StatusLog;
use backend\models\search\StatusLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StatusLogController implements the CRUD actions for StatusLog model.
 */
class StatusLogController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all StatusLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StatusLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
