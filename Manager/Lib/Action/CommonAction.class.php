<?php
class CommonAction extends Action {
	/**
	 * 获取没有分页的数据内容
	 * @param string $strTable 表格名称,
	 * @param array $strArray  'where'=>条件 ,'join'=>联表查询 ,'order'=>排序内容,'field'=>字段内容,limit=>sql限制内容
	 */
	public function getlist($strTable,$strArray=''){
//		$strTable=$this->getActionName(); 获取当前对应的数据表格
		$Modelview=M($strTable);
		$returnData=$Modelview->select($strArray);
//		echo $Modelview->getLastSql();
		return $returnData;
	}

	/**
	 * 显示带有分页功能的数据
	 * @param string $strTable 表格名称,
	 * @param array $strArray  'where'=>条件 ,'join'=>联表查询 ,'order'=>排序内容,'field'=>字段内容,limit=>sql限制内容
	 */
	public function getpagelist($strTable,$strArray='',$pagesize=12){
		import("ORG.Util.Page");
		$Modelprod=M($strTable);
		if(empty($strArray['where']) == false ){
			$count=$Modelprod->where($strArray['where'])->count();
		}else{
			$count=$Modelprod->count();
		}
		$p = new Page($count, $pagesize);
		$lists = $Modelprod->limit($p->firstRow . ',' . $p->listRows)->select($strArray);
//		echo $Modelprod->getLastSql();
		
		return array('lists'=>$lists,'page'=>$p->show());
	}
	/**
	 * 显示详细内容
	 * @param string $strtable 表名称
	 * @param array $strArray
	 * $strArray 为数组的时候表示操作表达式，通常由连贯操作完成；为数字或者字符串的时候表示主键值
	 */
	public function getTableCont($strTable='',$strArray){
		if(empty($strTable)){
			$strtable=$this->getActionName();
		}
		$Modelprod=M($strTable);
		$returnData=$Modelprod->find($strArray);
//		echo $Modelprod->getLastSql();
		return $returnData;
	}

	/**
	 * 插入数据内容
	 * @param string $strTable 表名称
	 * @param array  $strArray
	 */
	public function getInsert($strTable,$strArray){
		$M_data=M($strTable);
		$returnData=$M_data->add($strArray);
		return $returnData;
	}
	
	/**
	 * 批量插入数据内容
	 * @param string $strTable 表名称
	 * @param array  $strArray
	 */
	public function getInsertAll($strTable,$strArray){
		$M_data=M($strTable);
		$returnData=$M_data->addAll($strArray);
		return $returnData;
	}
	
	
	
	/**
	 * 公共调用替换函数
	 * @param string $strTable 表名称
	 * @param array  $strArray
	 */
	public function getPublic(){
		$WebRoot="http://".$_SERVER['HTTP_HOST'];
		$this->assign('WEBROOT',$WebRoot);
		$this->assign('WEBNAME',$WebRoot."/".APP_NAME);
		$this->assign('USERID',$_SESSION['MID']);
		$this->assign('GUESTNAME',$_SESSION['MNAME']);
		$this->assign("IPAddress",GetIP());
		
		
	}

	/**
	 * 数据更新
	 * @param string $strTable 表名称
	 * @param array $strArray 'where'=>条件 ,'join'=>联表查询 ,'order'=>排序内容,'field'=>字段内容,limit=>sql限制内容
	 * @param array  $strData 更新的数据
	 */
	public function getUpdate($strTable,$strArray,$strData){
		$M_update=M($strTable);
		$returnData=$M_update->where($strArray['where'])->save($strData);
		return $returnData;
	}
	
	/**
	 * 数据更新部分内容，如点击率或积分增减等数字类型变化
	 * @param string $strTable 表名称
	 * @param array $strArray 'where'=>条件 ,'join'=>联表查询 ,'order'=>排序内容,'field'=>字段内容,limit=>sql限制内容
	 * @param bool  $strType  true表示增加，false表示减少
	 */
	public function getNumberUpdate($strTable,$strArray,$strType=true){
		$M_update=M($strTable);
		if($strType){
			$returnData = 	$M_update->where($strArray['where'])->setInc($strArray['field'],$strArray['number']);
		}else{
			$returnData = 	$M_update->where($strArray['where'])->setDec($strArray['field'],$strArray['number']);
		}	
		return $returnData;
	}
	
	
	
	/**
	 * 数据删除
	 * @param string $strTable 表名称
	 * @param array $strArray 'where'=>条件 ,'join'=>联表查询 ,'order'=>排序内容,'field'=>字段内容,limit=>sql限制内容
	 */
	public function getDelOne($strTable,$strArray){
		$M_delone=M($strTable);
		$returnData=$M_delone->where($strArray['where'])->delete();
		return $returnData;
	}



	/**
	 * 统计某个条件下的数据个数
	 * @param string $strTable 被统计表名称
	 * @param array $strArray 统计条件
	 */
	public function getCountNumber($strTable='',$strArray){
		if(empty($strTable)){
			$strTable=$this->getActionName();
		}
		$ModelA=M($strTable);
		$returnData=$ModelA->count($strArray['field']);
		return $returnData;
	}




	/**
	 *发送邮件公共调用函数
	 *@param string $title 邮件发送标题
	 *@param string $content 邮件发送内容
	 *@param string $EmailTo 发送至邮箱服务器
	 */

	public function sendEmail($title,$content,$EmailTo,$charset='utf8',$attachment =''){
		import("ORG.Util.PHPMailer");
		header('Content-Type: text/html; charset='.$charset);
		$mail = new PHPMailer();
		$mail->CharSet = $charset;                      			//设置采用gb2312中文编码
		$mail->IsSMTP();                                			//设置采用SMTP方式发送邮件
		$mail->Host = "smtp.163.com";                   			//设置邮件服务器的地址
		$mail->Port = 25;                                			//设置邮件服务器的端口，默认为25
		$mail->From     = "yuanyuezhihui@163.com";        		 	//设置发件人的邮箱地址
		$mail->FromName = "FPSHOP";                      			//[设置发件人的姓名]
		$mail->SMTPAuth = true;                          			//设置SMTP是否需要密码验证，true表示需要
		$mail->Username = "yuanyuezhihui@163.com";       			//设置发送邮件的邮箱
		$mail->Password = "apple4s";                    			//设置邮箱的密码
		$mail->Subject = $title;                        			//设置邮件的标题
		$mail->AltBody = "text/html";                    			// optional, comment out and test
		$mail->Body = $content;                          			//设置邮件内容
		$mail->IsHTML(true);                             			//设置内容是否为html类型
		$mail->WordWrap = 50;                            			//设置每行的字符数
		$mail->AddReplyTo('pwj-0910@163.com','FPSSHOP');     		//设置回复的收件人的地址
		$mail->AddAddress($EmailTo,"FPSHOP");  						//设置收件的地址
		if ($attachment != '')                           			//设置附件
		{
			$mail->AddAttachment($attachment, $attachment);
		}
		if(!$mail->Send())
		{
			return false;
		} else {
			return true;
		}
	}

	/**
	 *错误内容显示
	 * @param string $strcont 错误提示内容
	 */
	public function errorshow($strcont){
		echo $strcont;
	}
	
	/**
	 * 登录状态验证
	 * Enter description here ...
	 */
	public function loginStatusCheck(){
		if(isset($_SESSION['MID'])==false && empty($_SESSION['MNAME'])){
			LocationUrl("http://".$_SERVER['HTTP_HOST'].__APP__."/login");
			exit();
		}
	
	}

	

}