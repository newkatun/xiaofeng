<?php

namespace Manager\Controller;

use Think\Controller;
use Think\Exception;

class CommonController extends Controller {
	protected function getSession() {
		if (isset ( $_SESSION ['MID'] ) && isset ( $_SESSION ['MNAME'] )) {
			return true;
		} else {
			return false;
		}
	}
	protected function checkLogin() {
		if (! $this->getSession ()) {
			redirect ( 'login' );
			exit ();
		}
	}
	protected function addTableUse() {
		$this->display ();
	}
	protected function editTableUse($model, $lableName, $id = 0) {
			$dataArray =$model->ShowData ( 'getTableCont', $id );
			if ($dataArray) {
				$this->assign ( $lableName, $dataArray );
				$this->addTableUse ();
				exit ();
			}else{
				return false;
			}
	}
	/**
	 * 数据保存于修改
	 * 
	 * @param string $id        	
	 * @return unknown
	 */
	protected function saveUse($model, $strArray, $id = 0) {
		$actionName = intval ( $id ) > 0 ? 'getUpdate' : 'getInsert';
		try {
			$updateData = $model->ShowData ( $actionName, $strArray );
		}catch (Exception $e){
			echo $e->getmessage();
		}
		return $updateData;
	}
	
	/**
	 * 数据状态改变
	 * 
	 * @param        	
	 *
	 */
	protected function dataStatusChange($model, $dataArray, $idArray = array()) {
		$updateData = false;
		if (! empty ( $idArray )) {
			$id = implode ( ",", $idArray );
			$strArray = array (
					'where' => ' autoid in (' . $id . ')',
					'data' => $dataArray 
			);
			$updateData = $model->ShowData ( 'getUpdate', $strArray );
		}
		return $updateData;
	}
	
	/**
	 * 数据删除
	 * @param Object $_Model        	
	 * @param array $pid        	
	 * @return boolean
	 */
	protected function delDataList($_Model, $pid) {
		$delData = false;
		if (! empty ( $pid )) {
			$id = implode ( ",", $pid );
			$delData = $_Model->ShowData ( 'getDelData', array (
					'where' => ' autoid in (' . $id . ')' 
			) );
		}
		return $delData;
	}
	
	/**
	 *
	 * @param string $code 错误代码
	 * @param string $page错误页面        	
	 */
	protected function errorPage($errorCode, $errorArray=array(),$errMsg='') {
		$errorPage=isset ( $errorArray['page'] )?$errorArray['page'] : 'Error:index';
		$reuturnUrl=isset ( $errorArray['rUrl'] )?$errorArray['rUrl'] : '';
		$this->assign ( 'ErrorCode', $errorCode );
		$this->assign ( 'ErrorMsg', $errMsg );
		$this->assign ( 'ReturnUrl', $reuturnUrl );
		$this->display ( $errorPage );
		exit ();
	}
	
	/**
	 * 检查是否登录
	 * 检查时候拥有页面权限
	 * 
	 * @param int $powerId        	
	 */
	protected function pageCheck($powerId) {
		$this->checkLogin ();
		if (UserPower ( $_SESSION ['userpower'], $powerId ) < 0) {
			$this->errorPage ( 'power' );
		}
	}
	protected function urlRedirect($strURL = 'index') {
		if (empty ( $strURL ) || ! isset ( $strURL ))
			$strURL = 'index';
		$strToURL = isset ( $_COOKIE ['PageName'] ) ? $_COOKIE ['PageName'] : $strURL;
		redirect ( $strToURL );
		exit ();
	}
	protected function EmailSend($title, $content, $EmailTo, $attachment = '', $charset = 'utf8') {
		header ( 'Content-Type: text/html; charset=' . $charset );
		$mail = new \Think\PHPMailer ();
		$emailModel = D ( 'Systems' );
		$Email = $emailModel->ShowData ( 'getTableCont' );
		$mail->CharSet = $charset; // 设置采用gb2312中文编码
		$mail->IsSMTP (); // 设置采用SMTP方式发送邮件
		$mail->Host = $Email ['sy_websmtp']; // 设置邮件服务器的地址$Email['sy_websmtp']
		$mail->Port = 25; // 设置邮件服务器的端口，默认为25
		$mail->From = $Email ['sy_semail']; // 设置发件人的邮箱地址$Email['sy_semail']
		$mail->FromName = $Email ['sy_company']; // [设置发件人的姓名]$Email['sy_company']
		$mail->SMTPAuth = true; // 设置SMTP是否需要密码验证，true表示需要
		$mail->Username = $Email ['sy_semail']; // 设置发送邮件的邮箱
		$mail->Password = $Email ['sy_webpassword']; // 设置邮箱的密码$Email['sy_webpassword']
		$mail->Subject = $title; // 设置邮件的标题
		$mail->AltBody = "text/html"; // optional, comment out and test
		$mail->Body = $content; // 设置邮件内容
		$mail->IsHTML ( true ); // 设置内容是否为html类型
		$mail->WordWrap = 50; // 设置每行的字符数
		$mail->AddReplyTo ( $Email ['sy_semail'], $Email ['sy_company'] ); // 设置回复的收件人的地址
		$mail->AddAddress ( $EmailTo, $Email ['sy_company'] ); // 设置收件的地址
		if ($attachment != '') { // 设置附件
			$mail->AddAttachment ( $attachment, $attachment );
		}
		if (! $mail->Send ()) {
			return false;
		} else {
			return true;
		}
	}
}