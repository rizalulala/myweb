<?php

/**
 * This is the model class for table "pemesanan".
 *
 * The followings are the available columns in table 'pemesanan':
 * @property string $id_keranjang
 * @property string $session
 * @property string $id_produk
 * @property string $nama_produk
 * @property integer $qty
 * @property integer $harga
 * @property integer $subtotal
 * @property string $id_pelanggan
 * @property string $status
 */
class Pemesanan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pemesanan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pemesanan, session, id_produk, nama_produk, qty, harga, subtotal, id_pelanggan, status', 'required'),
			array('qty, harga, subtotal', 'numerical', 'integerOnly'=>true),
			array('id_pemesanan, session, id_produk, nama_produk, id_pelanggan', 'length', 'max'=>100),
			array('status', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pemesanan, session, id_produk, nama_produk, qty, harga, subtotal, id_pelanggan, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pemesanan' => 'Id Pemesanan',
			'session' => 'Session',
			'id_produk' => 'Id Produk',
			'nama_produk' => 'Nama Produk',
			'qty' => 'Qty',
			'harga' => 'Harga',
			'subtotal' => 'Subtotal',
			'id_pelanggan' => 'Id Pelanggan',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_pemesanan',$this->id_pemesanan,true);
		$criteria->compare('session',$this->session,true);
		$criteria->compare('id_produk',$this->id_produk,true);
		$criteria->compare('nama_produk',$this->nama_produk,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('harga',$this->harga);
		$criteria->compare('subtotal',$this->subtotal);
		$criteria->compare('id_pelanggan',$this->id_pelanggan,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pemesanan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
