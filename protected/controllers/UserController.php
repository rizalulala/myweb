<?php

class UserController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	 
	 public $layout='//layout/responsive';
	 
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function actionbasket(){
		
		$this->render('basket');
		
	}
	
	public function actiondaftar(){
		
		$this->layout="register";
		$this->render('daftar');
		
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->layout="akunuser";
		
		/*
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
		*/
		$this->render('index');
	}
	
	
	public function actionpemesanan()
	{
		$this->layout="akunuser";
		
		$rijal=''.Yii::app()->User->name.'';
		
$con=mysqli_connect("localhost","root","","widya_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT * FROM pelanggan where username='$rijal' ORDER BY id_pelanggan desc";

if ($result=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $row=mysqli_fetch_array($result);
  
  $bogi=$row['id_pelanggan'];
  
  
  // Free result set
  mysqli_free_result($result);
  }

mysqli_close($con);


		
		$criteria = new CDbCriteria;
		$criteriawhere = new CDbCriteria;
		$criteriawhere->condition = "id_pelanggan = '$bogi' AND status='Pesanan Baru'";
		
	$count = Pemesanan::model()->count($criteriawhere);
	$pages = new CPagination ($count);
	$pages->pageSize=3;
	//$this->layout="temabaru";
	$pages->applyLimit($criteriawhere);
	

	$data=Pemesanan::model()->findAll($criteriawhere);

		
		$model=new Pemesanan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pemesanan']))
			$model->attributes=$_GET['Pemesanan'];

		//$dataProvider=new CActiveDataProvider('DaftarBudaya');
		
		$this->render('pemesananuser',array(
			'model' => $model,
			'data' => $data,
			'pages' => $pages
		));
	}
		
		public function actionIndexsongkok()
	{
		$this->layout="newlayout";
		
		
		$criteria = new CDbCriteria;
		$criteriawhere = new CDbCriteria;
		$criteriawhere->condition = "kategori like '%Song%'";
		
	$count = Produk::model()->count($criteriawhere);
	$pages = new CPagination ($count);
	$pages->pageSize=3;
	//$this->layout="temabaru";
	$pages->applyLimit($criteriawhere);
	

	$data=Produk::model()->findAll($criteriawhere);

		
		$model=new Produk('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Produk']))
			$model->attributes=$_GET['Produk'];

		//$dataProvider=new CActiveDataProvider('DaftarBudaya');
		$this->render('indexsongkok',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
	public function actionIndexbros()
	{
		$this->layout="newlayout";
		
		
		$criteria = new CDbCriteria;
		$criteriawhere = new CDbCriteria;
		$criteriawhere->condition = "kategori like '%Bros%'";
		
	$count = Produk::model()->count($criteriawhere);
	$pages = new CPagination ($count);
	$pages->pageSize=3;
	//$this->layout="temabaru";
	$pages->applyLimit($criteriawhere);
	

	$data=Produk::model()->findAll($criteriawhere);

		
		$model=new Produk('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Produk']))
			$model->attributes=$_GET['Produk'];

		//$dataProvider=new CActiveDataProvider('DaftarBudaya');
		$this->render('indexbros',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
	public function actionIndexdompet()
	{
		$this->layout="newlayout";
		
		
		$criteria = new CDbCriteria;
		$criteriawhere = new CDbCriteria;
		$criteriawhere->condition = "kategori like '%Dompet%'";
		
	$count = Produk::model()->count($criteriawhere);
	$pages = new CPagination ($count);
	$pages->pageSize=3;
	//$this->layout="temabaru";
	$pages->applyLimit($criteriawhere);
	

	$data=Produk::model()->findAll($criteriawhere);

		
		$model=new Produk('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Produk']))
			$model->attributes=$_GET['Produk'];

		//$dataProvider=new CActiveDataProvider('DaftarBudaya');
		$this->render('indexdompet',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
	public function actionIndextas()
	{
		$this->layout="newlayout";
		
		
		$criteria = new CDbCriteria;
		$criteriawhere = new CDbCriteria;
		$criteriawhere->condition = "kategori like '%Tas%'";
		
	$count = Produk::model()->count($criteriawhere);
	$pages = new CPagination ($count);
	$pages->pageSize=3;
	//$this->layout="temabaru";
	$pages->applyLimit($criteriawhere);
	

	$data=Produk::model()->findAll($criteriawhere);

		
		$model=new Produk('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Produk']))
			$model->attributes=$_GET['Produk'];

		//$dataProvider=new CActiveDataProvider('DaftarBudaya');
		$this->render('indextas',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
	function actionChange() {
		/*count semua produk yang ada 
		 *di keranjang belanja*/
		$count = count(Keranjang::model() -> findAll("session=:session", array(":session" => Yii::app() -> session['session'])));
		/*looping sebanyak jumlah data produk 
		 *yang ada di keranjang belanja*/
		for ($i = 1; $i <= $count; $i++) {
			/*findbyPk*/
			$model = Keranjang::model() -> cache(1000) -> findByPk($_POST['id_keranjang' . $i]);
			/*set field qty pada keranjang belanja 
			 *untuk diupdate*/
			$model -> qty = $_POST['qty' . $i];
			/*simpan perubahan*/
			$model -> cache(1000) -> save();
		}
		/*direk ke halaman index cart*/
		$this -> redirect('index.php?r=site/basket');
	}
	
	public function init(){
		/*jika session cart_code tidak didefinisikan maka
		 *jalankan cart_code nya*/
		if(!isset(Yii::app()->session['session'])){
			/*membuat session dengan nama 'cart_code' dan 
			 *diberi nilai berupa unik kode*/
			Yii::app()->session['session'] = $this -> getUniqueCode();
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
	
	
	public function actionviewkeranjang(){
		
		$this->layout='basket';
		/*query untuk list data produk
		 *dengan men-join tabel produk,cart.
		 */
		$sql = "SELECT produk.gambar,produk.harga,produk.nama_produk,keranjang.* 
			  FROM keranjang,produk
			  WHERE produk.id_produk=keranjang.id_produk
			  AND keranjang.session='" . Yii::app() -> session['session'] . "'";
		/*koneksi database*/	  
		$connection = Yii::app() ->db;
		/*create command*/
		$command = $connection -> cache(1000) -> createCommand($sql);
		/*execute command*/
		$results = $command -> queryAll();
		/*render ke file view cart/index*/
		$this -> render("viewkeranjang", 
			array(
				"data" => $results,//bawa result data 
				"sum" => NULL, //var sum =null supaya tidak error di viewnya
			)
		);
	
		
	}
	
	public function actionRemove($id) {
		/*delete by pk
		 *jika berhasil maka*/	
		if (Keranjang::model() -> cache(1000) -> deleteByPk($id)) {
			/*direct ke halaman cart*/				
			$this -> redirect(array("site/basket"));
		} else {
			/*jika tidak tampilkan error 400*/
			throw new CHttpException(400, 'Invalid request ID. Please do not repeat this request again.');
		}
	}
	

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionregister(){
		
		$this->render('register');
		
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	public function actiondetail(){
		
		//$model = new roduk;
		$this->layout="detail";
		$this->render('detail');
		
	}
	
	public function actiontmporder(){
		
		$this->render('tmporder');
		
	}
	
	public function actionAddtocart($id) {
		/*gunakan layout store*/
		$this -> layout = 'store';
		/*panggil model Cart*/
		$model = new Cart;
		/*set data ke masing masing field*/
		/*product_id*/
		$_POST['Cart']['product_id'] = $id;
		/*qty*/
		$_POST['Cart']['qty'] = 1;
		/*cart_code*/
		$_POST['Cart']['cart_code'] = Yii::app()->session['cart_code'];
		/*set ke attribut2*/
		$model -> attributes = $_POST['Cart'];
		
		/*update qty-nya jika produk sudah ada di dalam keranjang belanja
		 *menjadi +1*/
		if ($this -> addQuantity($id, Yii::app()->session['cart_code'], 1)) {
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
	private function addQuantity($product_id, $cart_code = '', $qty = '') {
		/*model Cart findBy attributes product_id dan cart_code*/
		$modelCart = Cart::model() -> findByAttributes(array('product_id' => $product_id, 'cart_code' => $cart_code));
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
	
	public function loadModel($id)
	{
		$model=Produk::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout="login";
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect('index.php?r=site/loading');
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	 
	public function actionloading()
	{
	
		$this->render('loading');
		
	} 
	 
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
