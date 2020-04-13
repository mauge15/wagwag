<?php

namespace app\controllers;

use Yii;
use app\models\VacunaMascota;
use app\models\VacunaMascotaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VacunaMascotaController implements the CRUD actions for VacunaMascota model.
 */
class VacunamascotaController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all VacunaMascota models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VacunaMascotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $sort = $dataProvider->getSort();
        $sort->defaultOrder = ['proxima_fecha' => SORT_ASC];
        $dataProvider->setSort($sort);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

      /**
     * Creates a new Anotacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateajax()
    {
        $model = new VacunaMascota();
      
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                    return [
                        'data' => [
                            'success' => true,
                            'model' => $model,
                            'message' => 'Datos guardados.',
                        ],
                        'code' => 0,
                    ];
            }
            else 
            {
                return [
                    'data' => [
                        'success' => false,
                        'model' => null,
                        'message' => 'An error occured.',
                    ],
                    'code' => 1, // Some semantic codes that you know them for yourself
                ];
            }
        
    }

    /**
     * Displays a single VacunaMascota model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new VacunaMascota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VacunaMascota();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing VacunaMascota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing VacunaMascota model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VacunaMascota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VacunaMascota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VacunaMascota::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    
  
}
