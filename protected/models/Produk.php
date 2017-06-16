<?php

/**
 * This is the model class for table "produk".
 *
 * The followings are the available columns in table 'produk':
 * @property string $id_produk
 * @property string $nama_produk
 * @property string $kategori
 * @property string $harga
 * @property string $deskripsi
 * @property string $gambar
 */
class Produk extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'produk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_produk, nama_produk, kategori, stok, harga, harga_jual, deskripsi, gambar', 'required'),
			array('id_produk, nama_produk, kategori, harga, gambar', 'length', 'max'=>100),
			array('deskripsi', 'length', 'max'=>255),
			array('harga','numerical',
			'integerOnly'=>true),
			array('harga_jual','numerical',
			'integerOnly'=>true),
			array('minta','numerical',
			'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_produk, nama_produk, kategori, stok_gudang, minta, harga_jual, updated_at, created_at, harga, stok, deskripsi, gambar', 'safe', 'on'=>'search'),
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
			'id_produk' => 'Id Produk',
			'nama_produk' => 'Nama Produk',
			'kategori' => 'Kategori',
			'harga' => 'Harga',
			'deskripsi' => 'Deskripsi',
			'gambar' => 'Gambar',
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

		$criteria->compare('id_produk',$this->id_produk,true);
		$criteria->compare('nama_produk',$this->nama_produk,true);
		$criteria->compare('kategori',$this->kategori,true);
		$criteria->compare('harga',$this->harga,true);
		$criteria->compare('harga_jual',$this->harga_jual,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('gambar',$this->gambar,true);
		$criteria->compare('stok',$this->stok,true);
		$criteria->compare('minta',$this->minta,true);
		$criteria->compare('stok_gudang',$this->stok_gudang,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Produk the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
