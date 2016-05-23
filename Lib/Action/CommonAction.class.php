<?php
class CommonAction extends Action {
	/**
	 * 获取没有分页的数据内容
	 * @param string $strTable 表格名称,
	 * @param array $strArray  'where'=>条件 ,'join'=>联表查询 ,'order'=>排序内容,'field'=>字段内容,limit=>sql限制内容
	 */
	protected function getlist($strTable,$strArray=''){
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
	protected function getpagelist($strTable,$strArray='',$pagesize=12){
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
	protected function getTableCont($strTable,$strArray){
		$Modelprod=M($strTable);
		$returnData=$Modelprod->find($strArray);
		return $returnData;
	}

	/**
	 * 插入数据内容
	 * @param string $strTable 表名称
	 * @param array  $strArray
	 */
	protected function getInsert($strTable,$strArray){
		$M_data=M($strTable);
		$returnData=$M_data->add($strArray);
		return $returnData;
	}
	
	/**
	 * 批量插入数据内容
	 * @param string $strTable 表名称
	 * @param array  $strArray
	 */
	protected function getInsertAll($strTable,$strArray){
		$M_data=M($strTable);
		$returnData=$M_data->addAll($strArray);
		return $returnData;
	}
	
	
	
	/**
	 * 公共调用替换函数
	 * @param string $strTable 表名称
	 * @param array  $strArray
	 */
	protected function getPublic(){
		$WebRoot="http://".$_SERVER['HTTP_HOST'];
		$this->assign('WEBROOT',$WebRoot);
		$this->assign('WEBNAME',$WebRoot);
		$this->assign("IPAddress",GetIP());
		if($this->getLoginStatus()){
			$this->assign("GuestName",$_SESSION['UNAME']);
			$this->assign("GuestId",$_SESSION['UID']);
			$this->assign("GuestEmail",$_SESSION['UEMAIL']);
		}
		$this->getNavList();
	}
	
	

	/**
	 * 数据更新
	 * @param string $strTable 表名称
	 * @param array $strArray 'where'=>条件 ,'join'=>联表查询 ,'order'=>排序内容,'field'=>字段内容,limit=>sql限制内容
	 * @param array  $strData 更新的数据
	 */
	protected function getUpdate($strTable,$strArray,$strData){
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
	protected function getNumberUpdate($strTable,$strArray,$strType=true){
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
	protected function getDelOne($strTable,$strArray){
		$M_delone=M($strTable);
		$returnData=$M_delone->where($strArray['where'])->delete();
		return $returnData;
	}
	
	//获取catalog列表
	protected  function getMenulist($mid=0,$sid=0){
		$CatalogSql=array('field'=>'autoid,ty_name','where'=>' ty_subid = 0 ');
		$CatalogArray=R("Table/Category/reTable",array($CatalogSql));
		foreach($CatalogArray as $n=>$catalog){
			$CatalogArray[$n]['subCatalog']=R("Table/Category/reTable",array(array('field'=>'autoid,ty_name,ty_subid','where'=>'ty_subid='.$CatalogArray[$n]['autoid'])));
		}
		$this->assign('CatalogList',$CatalogArray);
		$this->assign('MainId',$mid);
		$this->assign('SubId',$sid);
		
	}
	
	protected function getNavList(){
		$navList=R('Table/Soletype/reTable',array(array('order'=>'sole_sort desc')));
		$this->assign('NavList',$navList);	
	}

	protected function getPageName(){
		$pageName= $this->getActionName();
		$pageSql= array('where'=>"c_name = '".$pageName."'");
		$pageArray=R("Table/Page/reContent",array($pageSql));
		$this->assign('Page',$pageArray);
	}
	/**
	 * 统计某个条件下的数据个数
	 * @param string $strTable 被统计表名称
	 * @param array $strArray 统计条件
	 */
	protected function getCountNumber($strTable='',$strArray){
		if(empty($strTable)){
			$strTable=$this->getActionName();
		}
		$ModelA=M($strTable);
		if(isset($strArray['where']) && !empty($strArray['where'])){
			$returnData=$ModelA->where($strArray['where'])->count();
		}else{
			$returnData=$ModelA->count();
		}
		return $returnData;
	}


	protected function getLoginStatus(){
		$loginStatus=isset($_SESSION['UID']) && isset($_SESSION['UEMAIL'])?true: false;
		return $loginStatus;
	}

	/**
	 *发送邮件公共调用函数
	 *@param string $title 邮件发送标题
	 *@param string $content 邮件发送内容
	 *@param string $EmailTo 发送至邮箱服务器
	 */

	protected function sendEmail($title,$content,$EmailTo,$charset='utf8',$attachment =''){
		import("ORG.Util.PHPMailer");
		header('Content-Type: text/html; charset='.$charset);
		$Email=R('Table/Systems/reContent');
		$mail = new PHPMailer();
		$mail->CharSet = $charset;                      			//设置采用gb2312中文编码
		$mail->IsSMTP();                                			//设置采用SMTP方式发送邮件
		$mail->Host = $Email['sy_websmtp'];                   			//设置邮件服务器的地址
		$mail->Port = 25;                                			//设置邮件服务器的端口，默认为25
		$mail->From     = $Email['sy_semail'];        		 	//设置发件人的邮箱地址
		$mail->FromName = $Email['sy_company'];                      			//[设置发件人的姓名]
		$mail->SMTPAuth = true;                          			//设置SMTP是否需要密码验证，true表示需要
		$mail->Username = $Email['sy_semail'];       			//设置发送邮件的邮箱
		$mail->Password = $Email['sy_webpassword'];                    			//设置邮箱的密码
		$mail->Subject = $title;                        			//设置邮件的标题
		$mail->AltBody = "text/html";                    			// optional, comment out and test
		$mail->Body = $content;                          			//设置邮件内容
		$mail->IsHTML(true);                             			//设置内容是否为html类型
		$mail->WordWrap = 50;                            			//设置每行的字符数
		$mail->AddReplyTo($Email['sy_semail'],$Email['sy_company']);     		//设置回复的收件人的地址
		$mail->AddAddress($EmailTo,$Email['sy_company']);  						//设置收件的地址
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
	protected function errorshow($strcont){
		echo $strcont;
	}



	


}