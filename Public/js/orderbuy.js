/**
 *购物功能
 *param  int [strid=>产品ID]
*/
	function BuyOrderProd(strid,strtype){
		if(strtype==1){
			var prodattrID=$("#prodattrid"+strid).val();
			if(prodattrID==""){
				alert("Please select which do want to buy!")
			}else{
				$.post("grouporder.php?action=grouptemp",{prodid:strid,attrid:prodattrID},function(data){
					//TotalOrderNUM(1);
					$("#cart_basket").text(data);
					
				})
			}
		}
	}
/**
 *属性选择
 *param  int [strid=>产品ID]
*/	
	function ProdAttrAdd(strattrid,strprodid){
		var $prod_optionsli=$("div.buyselect span");  
		var $prod_configtext=$("#prodattrid"+strprodid);  
		
		$prod_optionsli.click(function(){$prod_optionsli.each(function(){$prod_optionsli.css({border:"none",color:"#fff"});});	
			$(this).css({border:"solid 2px #f00",color:"red"});
		});
		$prod_configtext.attr("value",strattrid);
	}

/**
 *删除指定的产品
 *param  int [strid=>产品ID]
*/	
	function DelOrderGroupid(strgorderid){
		$.get("grouporder.php?action=delone&gorderid="+strgorderid,function(data){
				
				$("#table_td_group"+strgorderid).remove();
				$("#cart_basket").text(data);
				if($("table.table_groupbuy tr").length==2){
					$("table.table_groupbuy tr").removeClass("table_nodata");
				}
			
		})
	}

/**
 *更新产品数量
*/
	function changeOrderNum(id,obj){
		var oldOrdernum=$("#hidordernum_"+id).val();
		 if(!checknumber(obj.value)){
			alert("You typed the format is not right!");
			obj.value=oldOrdernum;
			return false;
		 }else{
			if(obj.value==0){
				DelOrderGroupid(id);
			}else{
				if(obj.value!=$("#hidordernum_"+id).val()){
					$.get("grouporder.php?action=editnum&prodid="+id+"&ordernum="+obj.value,function(data){
						$("#cart_basket").text(data);
					});
				}
			}
		 }
		 //$.cookie("cartorder_num","")
		// alert($.cookie("cartorder_num"));
	}	
	
/**
 *判断字符是否为数字
 *2012-3-31
*/	
	function checknumber(String) { 
		if(trimTxt(String)==""){
		   return false;
		}
		var Letters = "1234567890"; 
		var i; 
		var c; 
		for( i = 0; i < String.length; i ++ ) { 
			c = String.charAt( i ); 
			if (Letters.indexOf( c ) ==-1) { 
			   return false; 
			} 
		} 
		return true; 
	} 
/**
 *字符验证
 *2012-3-31
*/
	function trimTxt(txt){
	   return txt.replace(/(^\s*)|(\s*$)/g, "");
	}
		
	
/**
 *增加购买产品数量
 * 2012-10-12
*/
	function  TotalOrderNUM(strnum){
		var ordernumber=$.cookie("ordernum");
		if(ordernumber=="" || typeof(ordernumber)=="undefined" || $.isNumeric(ordernumber)==false){
			ordernumber=0;
		}
		ordernumber=parseInt(ordernumber)+strnum;
		$.cookie("ordernum",ordernumber);
		
	}
/**
 *验证是否登录情况
 * 2012-10-12
*/
	function CheckLoginStatus(strdata){
		if(strdata=="loginin"){
			$.cookie("pageurl",window.location.href);
			window.location.href='login.php';
			return false;
		}
	}
/**
 *格式化数字
*/	
	function FormartFloat(strnum){
		if(!isNaN(strnum)){
			//var len=strnum.length;
			var strpotnum=strnum.toString().indexOf(".");
			if(strpotnum<0){
				return strnum.toString()+".00";
			}else{
				return strnum;
			}
		}else{
			return strnum;
		}
	}