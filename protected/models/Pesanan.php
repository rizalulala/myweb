<?php

/**
 * This is the model class for table "pesanan".
 *
 * The followings are the available columns in table 'pesanan':
 * @property integer $id
 * @property string $kode_pesanan
 * @property string $tanggal_pesan
 * @property integer $id_alamat
 * @property integer $id_pelanggan
 * @property string $bank_transfer
 * @property integer $status_pembayaran
 */
class Pesanan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pesanan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_pesanan, tanggal_pesan, id_alamat, id_pelanggan, bank_transfer, status_pembayaran', 'required'),
			array('id_alamat, id_pelanggan, status_pembayaran', 'numerical', 'integerOnly'=>true),
			array('kode_pesanan', 'length', 'max'=>17),
			array('bank_transfer', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_pesanan, tanggal_pesan, id_alamat, id_pelanggan, bank_transfer, status_pembayaran', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'kode_pesanan' => 'Kode Pesanan',
			'tanggal_pesan' => 'Tanggal Pesan',
			'id_alamat' => 'Id Alamat',
			'id_pelanggan' => 'Id Pelanggan',
			'bank_transfer' => 'Bank Transfer',
			'status_pembayaran' => 'Status Pembayaran',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('kode_pesanan',$this->kode_pesanan,true);
		$criteria->compare('tanggal_pesan',$this->tanggal_pesan,true);
		$criteria->compare('id_alamat',$this->id_alamat);
		$criteria->compare('id_pelanggan',$this->id_pelanggan);
		$criteria->compare('bank_transfer',$this->bank_transfer,true);
		$criteria->compare('status_pembayaran',$this->status_pembayaran);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pesanan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
