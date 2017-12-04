<?php

namespace app\controllers;

use Yii;
use app\models\Propietario;
use app\models\Mascota;
use app\models\HistorialMedico;
use app\models\HistorialComportamiento;
use app\models\PropietarioSearch;
use app\models\Referencia;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * PropietarioController implements the CRUD actions for Propietario model.
 */
class PropietarioController extends Controller
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
     * Lists all Propietario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PropietarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Propietario model.
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
     * Creates a new Propietario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelPropietario = new Propietario();
        $modelMascota = new Mascota();
        $modelHistMedico = new HistorialMedico();
        $modelHistComp = new HistorialComportamiento();

        if ($modelPropietario->load(Yii::$app->request->post()) && $modelMascota->load(Yii::$app->request->post()) && $modelHistMedico->load(Yii::$app->request->post()) && $modelHistComp->load(Yii::$app->request->post()) && Model::validateMultiple([$modelPropietario, $modelMascota, $modelHistMedico,$modelHistComp])) {

            $modelPropietario->save(false); // skip validation as model is already validated
            $modelMascota->id_propietario = $modelPropietario->id; 
            $modelMascota->save(false); 
            $modelHistMedico->id_mascota = $modelMascota->id;
            $modelHistMedico->save(false);
            $modelHistComp->id_mascota = $modelMascota->id;
            $modelHistComp->save(false);
            $modelMascota->id_historial_medico = $modelHistMedico->id;
            $modelMascota->id_historial_comportamiento = $modelHistComp->id;
            $modelMascota->save(false);
            return $this->redirect(['view', 'id' => $modelPropietario->id]);
        } else {
            return $this->render('create', [
                'modelPropietario' => $modelPropietario,
                'modelMascota' => $modelMascota,
                'modelHistMedico' => $modelHistMedico,
                'modelHistComp' => $modelHistComp,
                 'listReferencia' => Referencia::find()->all(),
            ]);
        }
    }


    /**
     * Updates an existing Propietario model.
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
     * Deletes an existing Propietario model.
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
     * Finds the Propietario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Propietario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Propietario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
