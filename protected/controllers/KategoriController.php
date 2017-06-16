<?php

class KategoriController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','hapus'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->layout="kategori";
		$model=new Kategori;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kategori']))
		{
			$model->attributes=$_POST['Kategori'];
			//$kategori=$_POST['abc'];
			//$model->kategori=$kategori;
			if($model->save())
				$this->redirect('index.php?r=kategori/admin');
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout="kategori";
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kategori']))
		{
			$model->attributes=$_POST['Kategori'];
			if($model->save())
				$this->redirect('index.php?r=kategori/admin');
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Kategori');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionhapus(){
		
		$this->layout="null";
		$this->render('hapus');
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout="kategori";
		$criteria = new CDbCriteria(array(
	'select'=>'*'))
		;
	$count = Kategori::model()->count($criteria);
	$pages = new CPagination ($count);
	$pages->pageSize=3;
	//$this->layout="temabaru";
	$pages->applyLimit($criteria);
	

	$data=Kategori::model()->findAll($criteria);

		
		$model=new Kategori('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kategori']))
			$model->attributes=$_GET['Kategori'];

		//$dataProvider=new CActiveDataProvider('DaftarBudaya');
		$this->render('admin',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Kategori the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Kategori::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Kategori $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kategori-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
