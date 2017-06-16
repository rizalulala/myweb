<?php

/**
 * This is the model class for table "bukualamat".
 *
 * The followings are the available columns in table 'bukualamat':
 * @property integer $id_alamat
 * @property integer $id_pelanggan
 * @property string $nama
 * @property integer $nomor_telpon
 * @property string $alamat
 * @property string $provinsi
 * @property string $kota
 */
class Bukualamat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bukualamat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pelanggan, nama, nomor_telpon, alamat, provinsi, kota', 'required'),
			array('id_pelanggan, nomor_telpon', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>56),
			array('provinsi, kota', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_alamat, id_pelanggan, nama, nomor_telpon, alamat, provinsi, kota', 'safe', 'on'=>'search'),
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
			'id_alamat' => 'Id Alamat',
			'id_pelanggan' => 'Id Pelanggan',
			'nama' => 'Nama',
			'nomor_telpon' => 'Nomor Telpon',
			'alamat' => 'Alamat',
			'provinsi' => 'Provinsi',
			'kota' => 'Kota',
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

		$criteria->compare('id_alamat',$this->id_alamat);
		$criteria->compare('id_pelanggan',$this->id_pelanggan);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('nomor_telpon',$this->nomor_telpon);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('provinsi',$this->provinsi,true);
		$criteria->compare('kota',$this->kota,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bukualamat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
