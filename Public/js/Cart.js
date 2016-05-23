if(!window.CartBox){
	 window.CartBox = new Object();
}
CartBox.cart={
	CookieValue:$.cookie('CartCookie'),		
	GuestName:"",
	BuyNumber:0,
	/**
	 *是否存在于购物车中
	 *@param string strtext 商品信息
	 */
	CartIntoCheck:function(strtext){
	//将传递过来的数据转成JSON数据格式
	//购物车为空时直接加入
		if(this.CartTextCheck()){
			this.CartAddData(strtext);
		}else{
		//购物车不为空时，判断是否存在于购物车,存在更新，不存在添加
			this.CartUpdateData(strtext);
		}
	},
		
	/**将JSON数据格式重新转为字符串,并保存到COOKIE中
	 *@param JSON jsonobj
	 */
	CartJsonToCookie:function(jsonobj){
		var strTextcont=JSON.stringify(jsonobj);
		strTextcont=strTextcont.substr(1,strTextcont.length-2);
		$.cookie('CartCookie',strTextcont,{expires:5,path:WEBCOOKIE});
		this.CookieValue=strTextcont;
	},
	
	CartLoginStatus:function(){
		//验证登录状态
		var userStatus=$.cookie('UserStatus');
		if(userStatus=='true'){
			this.GuestName=$.cookie('UserName');
		}else{
			this.GuestName=$.cookie('User-keys');//增加检测
			if(this.GuestName==null || this.GuestName=='' || checkName(this.GuestName)==false || this.GuestName==undefined){
				this.GuestName=this.CreateGuestName();
				$.cookie('User-keys',this.GuestName,{expires:30,path:WEBCOOKIE});
			}
		}
		return this.GuestName;
	},
		
	/**
	 *增加商品到购物车中
	 *@param string strtext 购买信息
	 */
	CartAddData:function(prodid,buynum){
		var t=Math.random();
		$.post("http://"+WEBROOT+'order/addProduct/t/'+t,{Pid:prodid,Qty:buynum,Gname:this.CartLoginStatus()},function(data){
			data=$.parseJSON(data);
			if(typeof(data)=='object'){
				$.cookie('num',data.TotalNum,{expires:30,path:WEBCOOKIE});
				$("span.cart_basket").text(data.TotalNum);
				//$("span.carttotal_price").text(data.TotalPrice);
				$("#buystatus").slideDown();
			}
		});
	},
	
	/**
	 *更新购物车中商品数量
	 * @param int prodId 产品编号
	 * @param int buyNum 购买数量
	 * @param int tempId 临时编号
	 */
	CartUpdateData:function(prodId,buyNum,tempId){
		var t=Math.random();
		$.post("http://"+WEBROOT+'order/addProduct/t/'+t,{Pid:prodId,Qty:buyNum,Gname:this.CartLoginStatus(),TempId:tempId},function(data){
			data=$.parseJSON(data);
			if(typeof(data)=='object'){
				$.cookie('num',data.TotalNum,{expires:30,path:WEBCOOKIE});
			}
		});
	},		
	/**
	 *更新购物车中商品数量
	 *注意此处已经默认好对象属性，attrid,order_num,oldnumber
	 * @param int tempId 临时编号
	 * @strType enum 枚举类型 add ,reduce
	 * @dataupdate boolean 可选变量 
	 */
	CartNumber:function(tempId,strType,dataupdate){
		var $numObj=$("#order_num_"+tempId);
		var buyNum=$numObj.val();
		var defaultNum=$numObj.attr("oldnumber");
		buyNum=Numcheck(buyNum,defaultNum,strType);
		$numObj.attr('value',buyNum);
		$numObj.attr('oldnumber',buyNum);
		if(dataupdate!=undefined && dataupdate===true) {
			var prodId=$numObj.attr("attrid");
			this.CartUpdateData(prodId,buyNum,tempId);
			//this.CartTotalOrderPrice();
		}
	},		
	/**
	 *删除购物车中商品信息
	 * @param Object $strObj 
	 */
	CartDeleteData:function($strObj){
		var tempId=$strObj.attr('dataskuid');
		var className=$strObj.attr('class');
		var attrName=className.replace('prod',tempId);
		$('tr#'+attrName).slideUp();
		if(checkNumber(tempId)){
			var t=Math.random();
			$.ajax({
				type:'post',
				url:'http://'+WEBROOT+'order/remove/t/'+t,
				data:{tempId:tempId},
				success:function(data){
					data=$.parseJSON(data);
					if(data.delStatus){
						$('tr#'+attrName).remove();
						if($('tr.'+className).length<1){
							$('div.cart_ordermessage').css('display','none');
							$('tr.table_cart_bottom').css('display','none');
							$('tr.table_cart_nothing').removeClass('hidden');
						}
						$('span.carttotal_price').text(data.TotalPrice);
						$('span#CartNumber').text(data.TotalNum);
					}else{
						$('tr#'+className).slideDown();
						alert('Delecting failure!');
					}
				},
				error:function(){
					alert('Network errors!');
				}
			});
		}
	},
		
	/**
	 *统计购物车中商品种类个数（不计算商品总数量）
	 */
	CartTotalData:function(){
		this.BuyNumber=$('tr.cartlist_prod').length;
		$('span#CartNumber').text(this.BuyNumber);
		return this.BuyNumber;
	},
	/**
	 *统计购物车中商品总价格
	 *注明：通过对网页直接进行统计 ，
	 *优点是不需要进行数据库操作
	 *缺点删除数据，无法更新总价格
	 *存在缺陷 未仔细核对网页中的商品价格，
	 */
	CartTotalOrderPrice:function(){
		var totalPrice=0,subTotal=0,subPrice,subNum,tempid,$strObj;
		$("tr.cartlist_prod").each(function(){
			$strObj =$(this);
			tempid=$strObj.attr('dataskuid');
			subTotal=parseFloat($('span#newprice_'+tempid).text())*parseInt($('input#order_num_'+tempid).val())
			totalPrice+=subTotal;
			$('span#orderlistsubprice_'+tempid).text(subTotal);
		});
		$('span.carttotal_price').text(totalPrice);
	},
	/**
	 * 统计购物车中商品总价格
	 * 注明：对数据库中购物车商品统计
	 * 优点删除数据，更新总价格
	 * 缺点需要进行数据库操作
	 */
	 
	CartTotalDataPrice:function(strflag){
		if(strflag===true){
			var t=Math.random();
			$.ajax({
				type:'get',
				url:'http://'+WEBROOT+'order/tempTotalPrice/t/'+t,
				success:function(data){
					data=$.parseJSON(data);
					$("span.cart_basket").text(data.TotalNum);
				},
				error:function(){
					$("span.cart_basket").text("0");
				}
			});
		}else{
			var prodnum=$.cookie('num');
			if(prodnum==null) prodnum =0;
			prodnum=checkNumber(prodnum)?prodnum:0;
			$("span.cart_basket").text(prodnum);
		}
	
	
	
	},
	/**
	 *检查购物车里面内容
	 * @return true 表示购物车内容为空，
	 * @return false 表示购物车内容不为空，
	 */
	CartTextCheck:function(){
		var DataCartList=this.CookieValue;
		if(DataCartList==="" || DataCartList===null){
			return true;
		}else{
			return false;
		}
	},
	/**
	 *选择送货地址
	 * @param  strObj object 
	 */ 		
	AddressSelect:function(strObj){
		$(strObj.strElement).each(function(){
			$(strObj.strElement).removeClass(strObj.strSelect);
		});
		strObj.strOnclick.addClass(strObj.strSelect);
		strObj.strOnclick.append($(strObj.strMoveDiv));
		$(strObj.strAddressID).attr('value',strObj.strOnclick.attr('strAddressId'));
		$(strObj.strAddressText).text(strObj.strOnclick.attr('strAddressData'));
		$(strObj.strShipping).text(strObj.strOnclick.attr('strship'));
	},
	/**
	 * 创建游客身份名称
	 */
	CreateGuestName:function(){
		var strtime=new Date();
		var strreturn="";
		var strret=strtime.getFullYear()+"-"+(strtime.getMonth()+1)+"-"+strtime.getDate()+"-"+strtime.getHours()+"-"+strtime.getMinutes()+"-"+strtime.getSeconds();
		strret=strret.replace("-","");
		var strrand=randChars(4);
		strret+=strrand;
		strreturn=encryptionChars(strret);
		strreturn=spaceChars(strreturn);
		return strreturn;
	}
}
/**
 * 产品数量更新时，增加数量与减少数量按钮处理	
 * @paream int strNum1 数字1
 * @paream int strNum2 数字2
 * @paream string strType 处理方式
 * @return int strNum1
 */
function Numcheck(strNum1,strNum2,strType){
	if(isNaN(strNum2)) strNum2=1;
	if(isNaN(strNum1)) strNum1=strNum2;
	if(strType=='add'){
		strNum1=parseInt(strNum1)+1;
	}else{
		strNum1=parseInt(strNum1)-1;
	}
	if(strNum1<1) strNum1=1;
	return strNum1;
}
//创建随机内容
function randChars(strlen){
	var strchars="abcdefghijklmnopqrstuvwxyz0123456789";
	var len=strchars.length;
	var strret="";
	var i,strpos;
	for(i=0;i<strlen;i++){
		strpos=parseInt(Math.random()*36);
		strret+=strchars.substr(strpos,1);
	}
	return strret;
}
//加密文字内容
function encryptionChars(strchars){
	var strret=$.md5(strchars);
	return strret;
}

//将加密字符串按照8-4-4-4-12隔开
function spaceChars(strchars){
	var strret ="";
	strret+=strchars.substr(0,8) + "-";
	strret+=strchars.substr(8,4)+ "-";
	strret+=strchars.substr(12,4)+ "-";
	strret+=strchars.substr(16,4)+ "-";
	strret+=strchars.substr(20);
	return strret;
}
/**
 * 检查名称
 * @param string strtext 名称
 * @return boolean
 */
function checkName(strtext){
	if(trimTxt(strtext)){
		var regexp=/^[a-z0-9][a-z0-9-]+$/;
		return regexp.test(strtext);
	}else{
		return false;
	}
}
