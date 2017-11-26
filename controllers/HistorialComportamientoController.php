<?php

namespace app\controllers;

use Yii;
use app\models\HistorialComportamiento;
use app\models\HistorialComportamientoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Temperamento;
use app\models\Mascota;

/**
 * HistorialComportamientoController implements the CRUD actions for HistorialComportamiento model.
 */
class HistorialcomportamientoController extends Controller
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
     * Lists all HistorialComportamiento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HistorialComportamientoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HistorialComportamiento model.
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
     * Displays a single HistorialComportamiento model.
     * @param integer $id
     * @param integer $id_historial_comportamiento
     * @param integer $id_mascota
     * @return mixed
     */
    public function actionView2($id, $id_historial_comportamiento, $id_mascota )
    {
        return $this->render('view', [
            'model' => $this->findModel($id_historial_comportamiento),
            'id_mascota' => $id_mascota,
        ]);
    }

    /**
     * Creates a new HistorialComportamiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HistorialComportamiento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


      /**
     * Creates a new HistorialMedico model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatewithid($id_mascota)
    {
        $model = new HistorialComportamiento();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             $mascota = Mascota::findOne($id_mascota);
            $mascota->id_historial_comportamiento = $model->id;
            $mascota->save();
            return $this->redirect(['mascota/view', 'id' => $id_mascota]);
        } else {

            return $this->render('create', [
                'model' => $model,
                'idMascota' => $id_mascota,
                'listTemperamento' => Temperamento::find()->all(),
            ]);

        }
    }

    /**
     * Updates an existing HistorialComportamiento model.
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
     * Deletes an existing HistorialComportamiento model.
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
     * Finds the HistorialComportamiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HistorialComportamiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HistorialComportamiento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
