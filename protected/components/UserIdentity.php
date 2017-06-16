<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$pelanggan=Pelanggan::model()->findByAttributes(array('username'=>$this->username));
		$admin=Admin::model()->findByAttributes(array('username'=>$this->username));
		//$klien=Klien::model()->findByAttributes(array('username'=>$this->username));
		
		
		if($pelanggan===null){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
			if($admin===null){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
			
			}else{
			if($admin->password!==$admin->encrypt($this->password)){
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}else{
				$this->_id=$admin->id_admin;
				$this->errorCode=self::ERROR_NONE;
				}
			}
			
			}
		else if($pelanggan!==null){
			if($pelanggan->password!==$pelanggan->encrypt($this->password)){
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}else{
				$this->_id=$pelanggan->id_pelanggan;
				$this->errorCode=self::ERROR_NONE;
				}
			}
			
			return !$this->errorCode;
		}
		
		public function getId(){
			return $this->_id;
		}
	}
