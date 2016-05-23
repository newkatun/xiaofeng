<?php

namespace Manager\Controller;

class LoginController extends CommonController {
	public function index() {
		$this->display ();
	}
	public function loginCheck() {
		$username = I ( 'post.Username', '', 'string' );
		$password = I ( 'post.Password', '', 'string' );
		$verifycode = I ( 'post.VerifyCode', '0', 'intval' );
		$errorCode = 'unknow';
		$errorPage = array (
				'page' => 'Login:loginCheck' 
		);
		if (! check_verify ( $verifycode )) {
			$errorCode = 'code';
			$this->errorPage ( $errorCode, $errorPage );
		}
		
		try {
			if (! empty ( $username ) && ! empty ( $password )) {
				$model = A ( 'Home/Manager', 'Event' );
				
				$modelData = $model->dataContent ( array (
						'where' => "user_name = '" . $username . "'" 
				) );
				print_r($modelData);
				if (is_array ( $modelData ) && $modelData ['user_password'] == md5 ( $password )) {
					$_SESSION ['MID'] = $modelData ['autoid'];
					$_SESSION ['MNAME'] = $modelData ['user_name'];
					$_SESSION ['LTime'] = intval ( $modelData ['user_lognum'] ) + 1; // 次数
					$_SESSION ['LDate'] = date ( "Y-m-d H:i:s", time () );
					$_SESSION ["userpower"] = $modelData ['user_power'];
					
					$dataArray = array (
							'where' => 'autoid=' . $_SESSION ['MID'],
							'data' => array (
									'user_datetime' => $_SESSION ['LDate'],
									'user_lognum' => $_SESSION ['LTime'] 
							) 
					);
					try{
						$model->dataUpdate ( $dataArray );
					}catch (\Exception $e){
						echo $e->getMessage();
					}
					
					//header ( 'Location: ' . __ROOT__ . '/manager/index' );
					exit ();
				}
			}
		} catch ( \Exception $E ) {
			echo $E->getMessage ();
		}
		
		//$errorCode = 'name';
		//$this->errorPage ( $errorCode, $errorPage );
	}
	public function logout() {
		session_destroy ();
		$this->display ();
	}
	
	// private function method(){
	// $modelName = D ( 'Manager' );
	// $manageData = $modelName->ShowData ( 'checkManager', $username );
	// if (is_array ( $manageData ) && $manageData ['user_password'] == md5 ( $password )) {
	// $_SESSION ['MID'] = $manageData ['autoid'];
	// $_SESSION ['MNAME'] = $manageData ['user_name'];
	// $_SESSION ['LTime'] = intval ( $manageData ['user_lognum'] ) + 1; // 次数
	// $_SESSION ['LDate'] = date ( "Y-m-d H:i:s", time () );
	// $_SESSION ["userpower"] = $manageData ['user_power'];
	
	// $dataArray = array (
	// 'where' => 'autoid=' . $_SESSION ['MID'],
	// 'data' => array (
	// 'user_datetime' => $_SESSION ['LDate'],
	// 'user_lognum' => $_SESSION ['LTime']
	// )
	// );
	// $modelName->ShowData ( 'getUpdate', $dataArray );
	// header ( 'Location: ' . __ROOT__ . '/manager/index' );
	// }
	// }
}