<?php

namespace app\controllers;

use Yii;
use app\models\HistorialMedico;
use app\models\Mascota;
use app\models\HistorialMedicoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HistorialMedicoController implements the CRUD actions for HistorialMedico model.
 */
class HistorialmedicoController extends Controller
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
     * Lists all HistorialMedico models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HistorialMedicoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HistorialMedico model.
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
     * Displays a single HistorialMedico model.
     * @param integer $id
     * @param integer $id_historial_medico
     * @param integer $id_mascota
     * @return mixed
     */
    public function actionView2($id, $id_historial_medico, $id_mascota )
    {
        return $this->render('view', [
            'model' => $this->findModel($id_historial_medico),
            'id_mascota' => $id_mascota,
        ]);
    }

    /**
     * Creates a new HistorialMedico model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HistorialMedico();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             $mascota = Mascota::findOne(Yii::$app->request->idmascota);
            $mascota->id_historial_medico = $model->id;
            $mascota->save();
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
    public function actionCreatewithid($idMascota)
    {
        $model = new HistorialMedico();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             $mascota = Mascota::findOne($idMascota);
            $mascota->id_historial_medico = $model->id;
            $mascota->save();
            return $this->redirect(['mascota/view', 'id' => $idMascota]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'idMascota' => $idMascota,
            ]);

        }
    }



    /**
     * Updates an existing HistorialMedico model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
              //reenviar a la mascota
            $mascota = Mascota::findOne($model->id_mascota);
            return $this->redirect(['propietario/view','id' => $mascota->id_propietario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HistorialMedico model.
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
     * Finds the HistorialMedico model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HistorialMedico the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HistorialMedico::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
