<?php

/*Author : Kuuga Sharive
 *Class cart untuk kepentingan keranjangan belanja
 *edit item, remove item, finishop 
 */
Class CartController extends YiishopController {

	/*tentukan layout controller*/
	public $layout = '//layouts/store';
	/*static var INDEX*/
	const INDEX = "cart/";
	/*private var untuk menampung bank transfer*/
	private $bank_transfer;
	/*private var untuk menampung id address*/
	private $id_alamat;

	/*untuk remove item 
	 *dari keranjang*/
	public function actionRemove($id) {
		/*delete by pk
		 *jika berhasil maka*/	
		if (Cart::model() -> cache(1000) -> deleteByPk($id)) {
			/*direct ke halaman cart*/				
			$this -> redirect(array("cart/"));
		} else {
			/*jika tidak tampilkan error 400*/
			throw new CHttpException(400, 'Invalid request ID. Please do not repeat this request again.');
		}
	}

	/**
	 * list produk di keranjang belanja
	 */
	public function actionIndex() {
		/*query untuk list data produk
		 *dengan men-join tabel produk,cart.
		 */
		$sql = "SELECT produk.gambar,produk.harga,produk.nama_produk,cart.* 
			  FROM cart,produk
			  WHERE produk.id_produk=cart.id_produk
			  AND cart.cart_kode='" . Yii::app() -> session['cart_kode'] . "'";
		/*koneksi database*/	  
		$connection = Yii::app() ->db;
		/*create command*/
		$command = $connection -> cache(1000) -> createCommand($sql);
		/*execute command*/
		$results = $command -> queryAll();
		/*render ke file view cart/index*/
		$this -> render("index", 
			array(
				"data" => $results,//bawa result data 
				"sum" => NULL, //var sum =null supaya tidak error di viewnya
			)
		);
	}

	/*untuk ubah keranjang belanja*/
	function actionChange() {
		/*count semua produk yang ada 
		 *di keranjang belanja*/
		$count = count(Cart::model() -> findAll("cart_kode=:cart_kode", array(":cart_kode" => Yii::app() -> session['cart_kode'])));
		/*looping sebanyak jumlah data produk 
		 *yang ada di keranjang belanja*/
		for ($i = 1; $i <= $count; $i++) {
			/*findbyPk*/
			$model = Cart::model() -> cache(1000) -> findByPk($_POST['id' . $i]);
			/*set field qty pada keranjang belanja 
			 *untuk diupdate*/
			$model -> qty = $_POST['qty' . $i];
			/*simpan perubahan*/
			$model -> cache(1000) -> save();
		}
		/*direk ke halaman index cart*/
		$this -> redirect(array(self::INDEX));
	}


	/*untuk selesai belanja*/
	function actionFinishshop() {
		/*jika customer tidak login maka direct
		 *ke halaman account untuk login*/	
		if (!isset(Yii::app() -> user -> customerLogin)) {
			$this -> redirect(array('site/login'));
		}
		/*jika add new address*/
		if (isset($_GET['addNewAlamat'])) {
			/*panggil model address*/
			$modelAddress = new Alamat;
			/*jika data address dikirim maka*/
			if (isset($_POST['Alamat'])) {
				/*set attributes*/
				$modelAddress -> attributes = $_POST['Alamat'];
				/*set field customer_id untuk data address*/
				$modelAddress -> id_pelanggan = Yii::app() -> user -> idpelanggan;
				/*jika disimpan maka*/
				if ($modelAddress -> save()) {
					/*set session id_address*/	
					$_SESSION['id_alamat'] = Yii::app() -> db -> getLastInsertID();
					/*render ke view payment/transfer bank
					 *untuk memilih jenis pembayaran*/
					$this -> render("payment");
					return;
				}
			}
			/*jika data transfer bank/payment dikirim maka*/
			if (isset($_POST['Transfer'])) {
				/*set var bank_transfer*/
				$this -> bank_transfer = $_POST['Transfer']['bank'];
				/*set var id_address*/
				$this -> id_address = $_SESSION['id_alamat'];
				/*add order dan hapus data yang ada dikeanjang belanja*/
				$this -> addOrderCleanCart();
				return;
			}
			/*render view untuk form add new address*/
			$this -> render('addNewAlamat', array('model' => $modelAddress));
			return;
		}
		/*jika memilih address 
		 *yang sudah ada*/
		if (isset($_POST['ChooseAddress'])) {
			/*set session id_address*/
			$_SESSION['id_alamat'] = $_POST['ChooseAddress']['id_alamat'];
			/*render ke view payment/transfer bank*/
			$this -> render("payment");
			return;
		}
		/*jika transfer maka*/
		if (isset($_POST['Transfer'])) {
			/*set var bank_transfer*/
			$this -> bank_transfer = $_POST['Transfer']['bank'];
			/*set var id_address*/
			$this -> id_address = $_SESSION['id_alamat'];
			/*add order dan hapus data yang ada dikeanjang belanja*/
			
			$this -> addOrderCleanCart();
			return;
		}
		/*dapatkan semua data address berdasarkan 
		 *user yang login untuk ditampilkan*/
		$getAddressBooks = Alamat::model() -> findAll('id_pelanggan=:id_pelanggan', 
			array(':id_pelanggan' => Yii::app() -> user -> idpelanggan));
		/*render ke halaman finishop*/
		$this -> render('finishshop', array('addressBooks' => $getAddressBooks, ));

	}

	/*untuk add to order_detail dan
	 *delete data di keranjang belanja*/
	private function addOrderCleanCart() {
		/*panggil model Order*/
		$modelOrder = new Pesanan;
		/*set field order_code*/
		$modelOrder -> order_kode = $order_kode = Yii::app() -> user -> idpelanggan . '' . $this -> orderCode();
		/*set field order_date*/
		$modelOrder -> tanggal_order = date('Y-m-d');
		/*set field id_address*/
		$modelOrder -> id_alamat = $this -> id_alamat;
		/*set field customer_id*/
		$modelOrder -> id_pelanggan = Yii::app() -> user -> idpelanggan;
		/*set field bank_transfer*/
		$modelOrder -> bank_transfer = $this -> bank_transfer;
		/*simpan ke data order*/
		if ($modelOrder -> save()) {
			/*dapatkan las insert id*/
			$last_insert_id = Yii::app() -> db -> getLastInsertID();
			
			  
			 /*select semua data yang ada
			  *pada keranjang belanja
			  */
			$sql = "SELECT produk.id_produk as proid, produk.gambar,produk.harga,produk.nama_produk,cart.* 
					  FROM cart,produk
					  WHERE produk.id_produk=cart.id_produk
					  AND cart.cart_kode='" . Yii::app() -> session['cart_kode'] . "'";
			/*koneksi ke database*/
			$connection = Yii::app() -> db;
			/*createCommand*/
			$command = $connection -> cache(1000) -> createCommand($sql);
			/*execute query*/
			$results = $command -> queryAll();
			
			 
			/*simpan ke orderdetail secara looping
			 */
			foreach ($results as $detail) :
				/*panggil model order_detail*/
				$deor = new Detailpesanan;
				/*set field order_code*/
				$deor -> kode_pesanan = $kode_pesanan;
				/*set field order_id*/
				$deor -> id_pesanan = $last_insert_id;
				/*set field product_id*/
				$deor -> id_produk = $detail['proid'];
				/*set field qty*/
				$deor -> qty = $detail['qty'];
				/*set field subtotal*/
				$deor -> subtotal = $detail['harga'] * $detail['qty'];
				/*simpan orderdetail*/
				$deor -> save();
			endforeach;
			/*delete semua data yang ada di keranjang belanja
			 *berdasarkan user yang belanja
			 */
			$del = "DELETE FROM cart WHERE cart_kode='" . Yii::app() -> session['cart_kode'] . "'";
			/*create Command*/
			$del = $connection -> createCommand($del);
			/*execute command*/
			$del -> execute();
			/*direct ke halaman utama website*/
			
			$this -> redirect(array('./'));
		}

	}

}
