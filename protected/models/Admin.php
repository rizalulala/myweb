<?php

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $rule
 * @property string $last_login_time
 * @property integer $level
 */
class Admin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 
	 protected function afterValidate(){
	parent::afterValidate();
	
	//lakukan enkripsi pada password yg di input
	$this->password=$this->encrypt($this->password);
	}
	
	//membuat function untuk mengenkripsi data 
	public function encrypt($value){
			return md5($value);
	}
	 
	public function tableName()
	{
		return 'admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, rule, level', 'required'),
			array('level', 'numerical', 'integerOnly'=>true),
			array('email, username, password', 'length', 'max'=>256),
			//array('rule', 'length', 'max'=>25),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_admin, email, username, password, rule, level', 'safe', 'on'=>'search'),
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
			'id_admin' => 'ID',
			'email' => 'Email',
			'username' => 'Username',
			'password' => 'Password',
			//'rule' => 'Rule',
			//'last_login_time' => 'Last Login Time',
			'level' => 'Level',
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

		$criteria->compare('id_admin',$this->id_admin);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		//$criteria->compare('rule',$this->rule,true);
		//$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('level',$this->level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Admin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
