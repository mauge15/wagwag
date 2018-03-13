<?php

namespace app\controllers;

use Yii;
use app\models\BonoComprado;
use app\models\BonoCompradoSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BonoCompradoController implements the CRUD actions for BonoComprado model.
 */
class BonocompradoController extends Controller
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
     * Lists all BonoComprado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BonoCompradoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
     * Displays a single BonoComprado model.
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
     * Creates a new BonoComprado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BonoComprado();
        $model->fecha_compra = date('d-m-Y'); //this format ensures that it is compatible with database storage.


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['mascota/view', 'id' => $model->id_mascota]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BonoComprado model.
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
     * Deletes an existing BonoComprado model.
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
     * Finds the BonoComprado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BonoComprado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BonoComprado::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
