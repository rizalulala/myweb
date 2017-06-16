<?php
/*class untuk keranjang belanja
 *Author Kuuga Sharive*/
 
class Cart extends CActiveRecord{
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	//tentukan tabel yang digunakan
	public function tableName(){
		return 'cart';
	}

	
	public function rules(){
		
		return array(
			array('id_produk, qty, cart_kode', 'required'),
			array('id_produk, qty', 'numerical', 'integerOnly'=>true),
			array('cart_kode', 'length', 'max'=>555),
			
			array('id, id_produk, qty, cart_kode', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		 
		return array(
			'produk' => array(self::BELONGS_TO, 'produk', 'id_produk'),
		);
	}
	
}