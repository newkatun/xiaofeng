<?php

namespace Home\Controller;

use Think\Controller;

class PublicuseController extends Controller {
	Public function verify() {
		$Verify = new \Think\Verify ();
		$Verify->fontSize = 10;
		$Verify->length = 4;
		$Verify->codeSet = '0123456789';
		$Verify->bg = array (
				216,
				216,
				216 
		);
		$Verify->fontttf = '5.ttf';
		$Verify->useNoise = false;
		$Verify->entry ();
	}
	public function yanzheng() {
		$verifycode = CheckString ( $_POST ['yzcode'] );
		if (check_verify ( $verifycode )) {
			echo "success";
		} else {
			echo "fail";
		}
	}
}