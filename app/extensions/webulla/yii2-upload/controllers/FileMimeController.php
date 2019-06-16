<?php

namespace webulla\upload\controllers;

use Yii;
use webulla\upload\models\FileMime;
use webulla\upload\components\search\FileMimeSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class FileMimeController extends \yii\web\Controller {

  public function actionIndex() {
    $searchModel = new FileMimeSearch;
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
    $model = new FileMime;
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
   * @return FileMime
   * @throws NotFoundHttpException
   */
  protected function findModel($id) {
    if (($model = FileMime::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
