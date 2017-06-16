<?php

class ProdukController extends YiishopController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	//public function filters()
	//{
		//return array(
			//'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		//);
	//}
	
	public function actionpilihkategori(){
		
		$this->layout="pageproduk";
		$this->render('pilihkategori');
		
	}
	
	public function actionpilihjenissouvenir(){
		
		$this->layout="pageproduk";
		$this->render('pilihjenissouvenir');
		
	}
	
	public function actionpilihjenisfashion(){
		
		$this->layout="pageproduk";
		$this->render('pilihjenisfashion');
		
	}
	
	public function actionupdategudang(){
		
		$this->layout="gudang";
		$this->render('updategudang');
		
	}
	
	public function actionpilihjenisprt(){
		
		$this->layout="pageproduk";
		$this->render('pilihjenisprt');
		
	}
	
	public function actionpilihjenis(){
		
		$this->layout="pageproduk";
		$this->render('pilihjenis');
		
	}
	
	public function init(){
		/*jika session cart_code tidak didefinisikan maka
		 *jalankan cart_code nya*/
		if(!isset(Yii::app()->session['cart_code'])){
			/*membuat session dengan nama 'cart_code' dan 
			 *diberi nilai berupa unik kode*/
			Yii::app()->session['cart_code'] = $this -> getUniqueCode();
		}
		
	}
	
	/*function untuk generate random kode*/
	public function randomCode() {
		/*buat karakter yang akan di random*/
		$RANDCODE = "abcdefghijkmnopqrstuvwxyz023456789";
		
		/*untuk mengacak kode*/
		srand((double)microtime() * 1000000);
		$i = 0;
		$generateCode = '';
		/*lopping sebanyak 7kali*/
		while ($i <= 7) {
			/*kode random*/
			$num = rand() % 34;
			/*ambil karaktar dari $RANDCODE dengan posisi nya 
			 *diacak oleh $num*/
			$tmp = substr($RANDCODE, $num, 1);
			/*hasil generate kode ditampung ke $generateCode*/
			$generateCode = $generateCode . $tmp;
			$i++;
		}
		/*kembalikan nilai function ke $generateCode*/
		return strtoupper($generateCode);
	}
	
	/*function untuk generate random kode*/
	public function rerandomCode() {
		/*buat karakter yang akan di random*/
		$RANDCODE = "023456789abcdefghijkmnopqrstuvwxyz";
		/*untuk mengacak kode*/
		srand((double)microtime() * 1000000);
		$i = 0;
		$generateCode = '';
		/*lopping sebanyak 7kali*/
		while ($i <= 7) {
			/*kode random*/
			$num = rand() % 34;
			/*ambil karaktar dari $RANDCODE dengan posisi nya 
			 *diacak oleh $num*/
			$tmp = substr($RANDCODE, $num, 1);
			/*hasil generate kode ditampung ke $generateCode*/
			$generateCode = $generateCode . $tmp;
			$i++;
		}
		/*kembalikan nilai function ke $generateCode*/
		return strtoupper($generateCode);
	}

	/*untuk generate order code*/
	public function orderCode() {
		/*buat karakter yang akan di random*/
		$RANDCODE = "023456789";
		/*untuk mengacak kode*/
		srand((double)microtime() * 1000000);
		$i = 0;
		$generateCode = '';
		/*lopping sebanyak 5kali*/
		while ($i <= 5) {
			/*kode random*/
			$num = rand() % 5;
			/*ambil karaktar dari $RANDCODE dengan posisi nya 
			 *diacak oleh $num*/
			$tmp = substr($RANDCODE, $num, 1);
			/*hasil generate kode ditampung ke $generateCode*/
			$generateCode = $generateCode . $tmp;
			$i++;
		}
		/*kembalikan nilai function ke $generateCode*/
		return strtoupper($generateCode);
	}
	
	
	/*untuk menggabungkan kode unik yang telah kita buat*/
	public function getUniqueCode() {
		/*kemalikan nilai $this -> randomCode() dan $this -> rerandomCode()
		 *yang telah kita buat pada function diatas*/		
		return $this -> randomCode() . '-' . $this -> rerandomCode();
	}


	/*untuk mengatasi karakter aneh/sql inject*/
	public function setClean($str, $separator = '-', $lowercase = FALSE) {
		if ($separator == 'dash') {
			$separator = '-';
		} else if ($separator == 'underscore') {
			$separator = '_';
		}

		$q_separator = preg_quote($separator);

		$trans = array('&.+?;' => '', '[^a-z0-9 _-]' => '', '\s+' => $separator, '(' . $q_separator . ')+' => $separator);

		$str = strip_tags($str);

		foreach ($trans as $key => $val) {
			$str = preg_replace("#" . $key . "#i", $val, $str);
		}

		if ($lowercase === TRUE) {
			$str = strtolower($str);
		}

		return trim($str, $separator);
	}
	

	public function actiondetail($id){
		
		
		$this->layout="viewbarangbaru";
		$this->render('detail',array(
			'model'=>$this->loadModel($id),
		));
		
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
				'actions'=>array('index','view','addtocart','viewuser','detail'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admingudang','updategudang','update','admin','delete','hapus','pilihkategori','pilihjenis','pilihjenisfashion','pilihjenisprt','pilihjenissouvenir'),
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
		$this->layout="pageproduk";
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionViewuser($id)
	{
		$this->layout="responsive";
		$this->render('viewuser',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->layout="pageproduk";
		$model=new Produk;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Produk']))
		{
			$model->attributes=$_POST['Produk'];
			$model->gambar=CUploadedFile::getInstance($model, 'gambar');
			
			date_default_timezone_set('Asia/Jakarta');
			$waktu=date('Y-m-d h:i:s');
			
			$model->created_at=$waktu;
			$stokawal=$model->stok;
			$model->stok_gudang=$stokawal;
			if($model->save())
				
				{
			
			$model->gambar->saveAs(Yii::app()->basePath.'/../images/products/'.$model->gambar);
			$this->redirect('index.php?r=produk/admin');
		}
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
		
		$this->layout="gudang";
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Produk']))
		{
			$model->attributes=$_POST['Produk'];
			$model->gambar=CUploadedFile::getInstance($model, 'gambar');
			if($model->save())
			{
				$model->gambar->saveAs(Yii::app()->basePath.'/../images/products/'.$model->gambar);
				$this->redirect('index.php?r=produk/admingudang');
		}
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionUpdatestokproduk($id)
	{
		
		$this->layout="pageproduk";
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Produk']))
		{
			$model->attributes=$_POST['Produk'];
			$model->gambar=CUploadedFile::getInstance($model, 'gambar');
			if($model->save())
			{
				$model->gambar->saveAs(Yii::app()->basePath.'/../images/products/'.$model->gambar);
				$this->redirect(array('updategudang','id'=>$model->id_produk));
		}
		}
		$this->render('updatestokproduk',array(
			'model'=>$model,
		));
	}
	
	public function actionhapus(){
		
		$this->layout="null";
		$this->render('hapus');
	}

	public function actionAddtocart($id) {
		/*gunakan layout store*/
		$this -> layout = 'store';
		/*panggil model Cart*/
		$model = new Cart;
		/*set data ke masing masing field*/
		/*product_id*/
		$_POST['Cart']['id_produk'] = $id;
		/*qty*/
		$_POST['Cart']['qty'] = 1;
		/*cart_code*/
		$_POST['Cart']['cart_kode'] = Yii::app()->session['cart_kode'];
		/*set ke attribut2*/
		$model -> attributes = $_POST['Cart'];
		
		/*update qty-nya jika produk sudah ada di dalam keranjang belanja
		 *menjadi +1*/
		if ($this -> addQuantity($id, Yii::app()->session['cart_kode'], 1)) {
			/*direct ke halaman cart*/	
			$this -> redirect(array('cart/'));
		/*add ke keranjang belanja jika produk belum ada di keranjang*/	
		} elseif ($model -> save()) {
			/*direct ke halaman cart*/ 
			$this -> redirect(array('cart/'));
		} else {
			/*produk tidak ada di dalam data product kasih error 404*/
			throw new CHttpException(404, 'The requested id invalid.');
		}

	}
	
	/*function untuk update QTY produk di keranjang belanja*/
	private function addQuantity($id_produk, $cart_kode = '', $qty = '') {
		/*model Cart findBy attributes product_id dan cart_code*/
		$modelCart = Cart::model() -> findByAttributes(array('id_produk' => $id_produk, 'cart_kode' => $cart_kode));
		/*jika ada didalam keranjang belanja*/
		if (count($modelCart) > 0) {
			/*maka update qty nya*/
			$modelCart -> qty += $qty;
			/*simpan dan return true*/
			$modelCart -> save();
			return TRUE;
		} else {
			/*lain dari itu return false*/
			return FALSE;
		}
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
		$dataProvider=new CActiveDataProvider('Produk');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout="pageproduk";
		$criteria = new CDbCriteria(array(
	'select'=>'*'))
		;
	$count = Produk::model()->count($criteria);
	$pages = new CPagination ($count);
	$pages->pageSize=3;
	//$this->layout="temabaru";
	$pages->applyLimit($criteria);
	

	$data=Produk::model()->findAll($criteria);

		
		$model=new Produk('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Produk']))
			$model->attributes=$_GET['Produk'];

		//$dataProvider=new CActiveDataProvider('DaftarBudaya');
		$this->render('admin',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
	}
	
	public function actionadmingudang()
	{
		$this->layout="gudang";
		$criteria = new CDbCriteria(array(
	'select'=>'*'))
		;
	$count = Produk::model()->count($criteria);
	$pages = new CPagination ($count);
	$pages->pageSize=3;
	//$this->layout="temabaru";
	$pages->applyLimit($criteria);
	

	$data=Produk::model()->findAll($criteria);

		
		$model=new Produk('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Produk']))
			$model->attributes=$_GET['Produk'];

		//$dataProvider=new CActiveDataProvider('DaftarBudaya');
		$this->render('admingudang',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Product the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Produk::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Product $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
