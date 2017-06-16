<?php

class SiteController extends Controller
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
$qty=Yii::app()->request->getPost('qty');
$tanggal=Yii::app()->request->getPost('tanggal');
$id_produk=Yii::app()->request->getPost('id_produk');
$produk=Produk::model()->findByAttributes(array(
  'id_produk' => $id_produk));
$id_keranjang[qty]=$qty;
$id_keranjang[tanggal]=$tanggal;
$id_keranjang[produk]=$produk;

$data=array('id_keranjang'=>$id_keranjang,'session'=>Yii::app()->session['session']);
$this->render('cektarif',$data);
		
	}
public function actioninsertalamat(){

$command = Yii::app()->db->createCommand();
$user=Yii::app()->User->id;
$nama_alamat = Yii::app()->request->getPost('nama_alamat');
$province = Yii::app()->request->getPost('province');
$destination = Yii::app()->request->getPost('destination');
$alamat = Yii::app()->request->getPost('alamat');
$command->insert('alamat', array(
       'user_id'=>$user,
 'nama_alamat'=>$nama_alamat,
'province'=>$province,
    'city'=>$destination,
'alamat'=>$alamat
));

}

public function actiongetAddress(){
$this->render('getAddress');
}
public function actiongetAlamat(){
$id_alamat = Yii::app()->request->getPost('id_alamat');

$data= Yii::app()->db->createCommand("select * from alamat where id_alamat='".$id_alamat."'")->queryRow();
echo json_encode($data);
}
public function actioninsertbasket(){
$command = Yii::app()->db->createCommand();
$user=Yii::app()->User->id;
$id_produk = Yii::app()->request->getPost('id_produk');
$qty=Yii::app()->request->getPost('qty');
$origin = Yii::app()->request->getPost('origin');
$destination = Yii::app()->request->getPost('destination');
$berat = Yii::app()->request->getPost('berat');
$services = Yii::app()->request->getPost('services');
$courier = Yii::app()->request->getPost('courier');
$session = Yii::app()->request->getPost('session');
$biayakirim = Yii::app()->request->getPost('biayakirim');
$produk=Produk::model()->findByAttributes(array(
  'id_produk' => $id_produk));
$id_alamat = Yii::app()->request->getPost('id_alamat');

$stokSekarang=$produk[stok]-$qty;

$command = Yii::app()->db->createCommand("update produk set stok='".$stokSekarang."' where id_produk='".$id_produk."'");
$command->execute();

$command->insert('keranjang', array(
        'qty'=>$qty,
'harga'=>$produk[harga],
'id_produk'=>$id_produk,
    'nama_produk'=>$produk[nama_produk],
'id_pelanggan'=>$user,
'kurir'=>$courier,
'layanan'=>$services,
'biayakirim'=>$biayakirim,
'id_alamat'=>$id_alamat,
'session'=>Yii::app()->session['session'] 
));
$this->redirect('index.php?r=site/viewkeranjang');

}
public function actioncheckout(){
$invoice=$this -> getUniqueCode();
$command = Yii::app()->db->createCommand("update keranjang set status='checkout',invoice='".$invoice."' where id_pelanggan='".Yii::app()->User->id."' and status=''");

$command->execute();
$this->redirect('index.php?r=site/viewinvoice/invoice/'.$invoice);

}
	
	public function actionsukses(){
		$this->layout="login";
$session=Yii::app()->request->getPost('session');

echo $session;
echo  " ". Yii::app()->request->getPost('kurir');	
$b=''.Yii::app()->User->name.'';
$con=mysqli_connect("localhost","root","","widya_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT * FROM pelanggan where username='$b' order by id_pelanggan desc";
$result=mysqli_query($con,$sql);

// Associative array
$row=mysqli_fetch_assoc($result);
//printf ("%s (%s)\n",$row["Lastname"],$row["Age"]);
$q=$row['id_pelanggan'];
//$w=$row['status'];
//$sql2="UPDATE keranjang SET status = 'checkout' WHERE session='$session'";


//$sql2="UPDATE keranjang SET status = 'checkout' WHERE id_pelanggan='$q'";
$result2=mysqli_query($con,$sql2);

echo"<meta http-equiv='refresh' content='1; url=index.php?r=site/viewinvoice'>";
// Free result set
//mysqli_free_result($result);

mysqli_close($con);
 
		
		
//		$this->render('sukses');
		
	}
	
	public function actionprintinvoice(){
		
		$this->render('printinvoice');
		
	}
	
	public function actionviewinvoice(){
$id_invoice= Yii::app()->request->getParam('invoice');
$data=array('invoice'=>$id_invoice);		

		$this->layout="login";
		$this->render('sukses',$data);
		
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
		$this->layout="newlayout";
		
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
		$this->render('index',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
	}
	
	
		
		public function actionIndexperrt()
	{
		$this->layout="newlayout";
		
		
		$criteria = new CDbCriteria;
		$criteriawhere = new CDbCriteria;
		$criteriawhere->condition = "kategori like '%Rumah Tangga%'";
		
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
		$this->render('indexperrt',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
	public function actionIndexaksesoris()
	{
		$this->layout="newlayout";
		
		
		$criteria = new CDbCriteria;
		$criteriawhere = new CDbCriteria;
		$criteriawhere->condition = "kategori like '%abc%'";
		
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
		$this->render('indexaksesoris',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
	public function actionIndexper()
	{
		$this->layout="newlayout";
		
		$abcde=$_GET['id'];
		
		$criteria = new CDbCriteria;
		$criteriawhere = new CDbCriteria;
		$criteriawhere->condition = "kategori like '%$abcde%'";
		
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
		$this->render('indexper',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
	public function actionIndexsouvenir()
	{
		$this->layout="newlayout";
		
		
		$criteria = new CDbCriteria;
		$criteriawhere = new CDbCriteria;
		$criteriawhere->condition = "kategori like '%Souvenir%'";
		
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
		$this->render('indexsouvenir',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
	public function actionIndexacc()
	{
		$this->layout="newlayout";
		
		
		$criteria = new CDbCriteria;
		$criteriawhere = new CDbCriteria;
		$criteriawhere->condition = "kategori like '%Aksesoris%'";
		
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
		$this->render('indexacc',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
	public function actionIndexfashion()
	{
		$this->layout="newlayout";
		
		
		$criteria = new CDbCriteria;
		$criteriawhere = new CDbCriteria;
		$criteriawhere->condition = "kategori like '%Fashion%'";
		
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
		$this->render('indexfashion',array(
			'model'=>$model,
			'data'=>$data,
			'pages'=>$pages,
		));
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
	public function actionubahitem() {
$qty= Yii::app()->request->getPost('qty');
$session= Yii::app()->request->getPost('session');

$data= Yii::app()->db->createCommand("select * from keranjang where session ='".$session."'")->queryRow();


$produk= Yii::app()->db-> createCommand("select * from produk where id_produk='".$data[id_produk]."'")->queryRow();

$stokSekarang=$produk[stok]+($data[qty]-$qty);

$command = Yii::app()->db->createCommand("update produk set stok='".$stokSekarang."' where id_produk='".$data[id_produk]."'");
$command->execute();

$command = Yii::app()->db->createCommand("update keranjang set qty='".$qty."' where session='".$session."'");
$command->execute();


}
	
	
	public function actionhasilsearch()
	{
		$this->layout="newlayout";
		
		$this->render('hasilsearch');
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
	public function actionhapus()
	{
		$this->layout="null";
$id_keranjang= Yii::app()->request->getParam('id');		
$data= Yii::app()->db->createCommand("select * from keranjang where id_keranjang ='".$id_keranjang."'")->queryRow();


$produk= Yii::app()->db-> createCommand("select * from produk where id_produk='".$data[id_produk]."'")->queryRow();

$stokSekarang=$produk[stok]+$data[qty];

$command = Yii::app()->db->createCommand("update produk set stok='".$stokSekarang."' where id_produk='".$data[id_produk]."'");
$command->execute();

$command = Yii::app()->db->createCommand("delete from keranjang where id_keranjang='".$id_keranjang."'");
$command->execute();
$this -> redirect('index.php?r=site/viewkeranjang');
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
		
		$abcde=''.Yii::app()->User->name.'';
		
		$con=mysqli_connect("localhost","root","","widya_db");
		$desy="SELECT * FROM pelanggan where username='$abcde' order by id_pelanggan desc";
		$result2=mysqli_query($con,$desy);

// Associative array
		$row2=mysqli_fetch_assoc($result2); 
  
		$cindvia=$row2['id_pelanggan'];
		
		/*query untuk list data produk
		 *dengan men-join tabel produk,cart.
		 */
		$sql = "SELECT produk.gambar,produk.harga,produk.nama_produk,keranjang.* 
			  FROM keranjang,produk
			  WHERE produk.id_produk=keranjang.id_produk
			  AND keranjang.id_pelanggan='" .$cindvia. "' AND keranjang.status not like '%checkout%'";
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
	
	
	public function actiongetCity($province){		

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$province",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: 14221a36a1376773a58eda3295b23fee"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  //echo $response;
			$data = json_decode($response, true);
		  //echo json_encode($k['rajaongkir']['results']);

		  
	echo '<option>Pilih Kota</option>';
	  for ($j=0; $j < count($data['rajaongkir']['results']); $j++){
		  

		    echo "<option value='".$data['rajaongkir']['results'][$j]['city_id']."'>".$data['rajaongkir']['results'][$j]['city_name']."</option>";
		  
		  }
		}
	}

	public function actiongetCost()
	{

		$origin= Yii::app()->request->getPost('origin');
		$id_produk= Yii::app()->request->getPost('id_produk');
$id_alamat= Yii::app()->request->getPost('id_alamat');


		$destination = Yii::app()->request->getPost('destination');

		$berat = Yii::app()->request->getPost('berat');

		$courier = Yii::app()->request->getPost('courier');
$session = Yii::app()->request->getPost('session');


$alamat = Yii::app()->request->getPost('alamat');

		$data = array('origin' => $origin,
						'destination' => $destination, 
						'berat' => $berat, 
						'courier' => $courier,'id_alamat'=>$id_alamat,
'alamat' =>$alamat ,'session'=>$session,'id_produk'=>$id_produk

		);
		
		$this->render('getCost', $data);
	}
	
	public function actioncektarif(){
$keranjang=Keranjang::model()->findByAttributes(array(
  'id_keranjang' => $_POST[id_keranjang]));
//$hasil= City::getCity($province);
$data=array('id_keranjang'=>$keranjang);
	
 
	
		//$this->render('getCity',$data);
$this->render('cektarif',$data);

		
	}
	
	
	
}
