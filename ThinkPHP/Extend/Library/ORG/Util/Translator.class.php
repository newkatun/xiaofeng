<?php
/* Google翻译PHP接口
 * 官成文 2009-03-28
 * http://blog.csdn.net/aprin/
 * 注意：如果翻译文本为UTF-8编码，则要删去mb_convert_encoding函数
 */

class Translator{
	public $url = "http://translate.google.com/translate_t";
	public $text = "";//翻译文本
	public $out = ""; //翻译输出
	public function setText($text){
		$this->text = $text;
	}

	public function translate() {
		$this->out = "";

		$gphtml = $this->postPage($this->url, $this->text);
		//提取翻译结果
		$expstr="/<span id=result_box class=\"long_text\">.*?<\/span>/";
		$result=preg_match($expstr,$gphtml,$data);
		if($result){
			$strdata=strip_tags($data[0]);
		}else{
			$strdata= "匹配失败";
		}
		$this->out=$strdata;
		return $this->out;
	}

	public function postPage($url, $text) {
		$html ="";
		if($url != "" && $text != "") {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 15);
			/*
			 *hl – 界面语言，此处无用。
			 *langpair – src lang to dest lang
			 *ie – urlencode的编码方式?
			 *text – 要翻译的文本
			 */
			// $fields = array('hl=en', 'langpair=en|es','ie=UTF-8','text='.urlencode(mb_convert_encoding($text, 'UTF-8','GB2312')));
			// $fields = array('hl=en', 'langpair=en|es','ie=UTF-8','text='.urlencode($text));
			$fields = array('hl=zh-CN', 'langpair=zh-CN|en','ie=UTF-8','text='.urlencode($text));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, implode('&', $fields));
			$html = curl_exec($ch);
			if(curl_errno($ch)) $html = "";
			curl_close ($ch);
		}
		return $html;
	}
}