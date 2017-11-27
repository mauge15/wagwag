<?php

namespace app\controllers;

use Yii;
use app\models\Mascota;
use app\models\MascotaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use app\models\BonoComprado;

/**
 * MascotaController implements the CRUD actions for Mascota model.
 */
class MascotaController extends Controller
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
     * Lists all Mascota models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MascotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionHistorial($id_mascota)
    {
        return $this->redirect(['historialmedico/createwithid','idMascota' => $id_mascota]);

    }


    public function actionHistorialcomportamiento($id_mascota)
    {
        return $this->redirect(['historialcomportamiento/createwithid','id_mascota' => $id_mascota]);

    }

    /**
     * Displays a single Mascota model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new BonoComprado();
        $query = BonoComprado::find();
        // add conditions that should always apply here
       // grid filtering conditions
        $query->andFilterWhere([
            'id_mascota' => $id,
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Mascota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mascota();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Mascota model with id_propietario
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatewithid($id_propietario)
    {
        $model = new Mascota();
        $model->id_propietario = $id_propietario;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Updates an existing Mascota model.
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
     * Deletes an existing Mascota model.
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
     * Lists all BonoComprado models.
     * @return mixed
     */
    public function actionBonomascota($id_mascota)
    {

        $searchModel = new BonoComprado();
        $query = BonoComprado::find();
        // add conditions that should always apply here
       // grid filtering conditions
        $query->andFilterWhere([
            'id_mascota' => $id_mascota,
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        

        return $this->render('bonomascota', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


     /**
     * Finds the Mascota model based on its primary key value.
     * @param integer $id
     * @return Mascota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionFind($id)
    {
        if (($model = Mascota::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Mascota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mascota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mascota::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
