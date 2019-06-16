<?php

namespace webulla\upload\controllers;

use webulla\upload\actions\DownloadAction;
use webulla\upload\actions\UploadAction;
use Yii;
use webulla\upload\models\File;
use webulla\upload\components\search\FileSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class FileController extends \yii\web\Controller {

  /**
   * @inheritdoc
   */
  public function actions() {
    return [
      'upload' => [
        'class' => UploadAction::className(),
      ],

      'download' => [
        'class' => DownloadAction::className(),
      ],
    ];
  }

  public function actionIndex() {
    $searchModel = new FileSearch;
    $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

    return $this->render('index', [
      'dataProvider' => $dataProvider,
      'searchModel' => $searchModel,
    ]);
  }

  public function actionView($id) {
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  public function actionCreate() {
    $model = new File;
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  public function actionUpdate($id) {
    $model = $this->findModel($id);
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('update', [
      'model' => $model,
    ]);
  }

  public function actionDelete($id) {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  /**
   * @param $id
   * @return File
   * @throws NotFoundHttpException
   */
  protected function findModel($id) {
    if (($model = File::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
