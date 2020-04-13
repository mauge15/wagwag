<?php

namespace app\controllers;

use Yii;
use app\models\Asistencia;
use app\models\BonoComprado;
use app\models\AsistenciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AsistenciaController implements the CRUD actions for Asistencia model.
 */
class AsistenciaController extends Controller
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
     * Lists all Asistencia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AsistenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Asistencia model.
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
     * Creates a new Asistencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_mascota)
    {
        $model = new Asistencia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
                'id_mascota' => $id_mascota,
            ]);
        }
        else
        {
            return $this->render('_form', [
                        'model' => $model
            ]);
        }
    }


     /**
     * Creates a new BonoComprado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateajax($id_mascota)
    {
        $model = new Asistencia();
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            $message = "Datos guardados.";
            if (isset($model->id_bono_comprado))
            {
                $bono = BonoComprado::findOne($model->id_bono_comprado);
                if (isset($bono))
                {
                    if ($model->entrada_salida==1)
                    {
                        $bono->dias_utilizados = $bono->dias_utilizados + 1;
                        $bono->dias_bono = $bono->dias_bono-1;
                        if ($bono->dias_bono==0)
                        {
                            $bono->activo=0;
                            $message = $message. " BONO INACTIVO, ya no quedan días.";
                        }
                        else
                        {
                            $message = $message." Quedan ".$bono->dias_bono. " días disponibles.";
                        }
                        $bono->save();   
                    }
                }
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' => [
                    'success' => true,
                    'model' => $model,
                    'message' => $message,
                ],
                'code' => 0,
            ];

        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('createAjax', [
                'model' => $model,
                'id_mascota' => $id_mascota,
            ]);
        }
        else
        {
            return $this->render('_form', [
                        'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Asistencia model.
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
     * Deletes an existing Asistencia model.
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
     * Finds the Asistencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Asistencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asistencia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
