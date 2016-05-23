<?php

namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller {
	public $pageNavObj, $systemObj;
	public function _initialize() {
		if (isMobile ()) {
			$this->publicTemplate ();
		} else {
			$this->show ( '请通过手机访问我们的网站，谢谢！', 'utf-8' );
			exit ();
		}
	}
	private function publicTemplate() {
		try{
			if (! is_object ( $this->pageNavObj )) {
				$this->pageNavObj = A ( 'Pageview', 'Event' );
			}
			$this->assign ( 'System', $this->publicSystem () );
			$prodType = A ( 'Prodtype', 'Event' );
			$this->assign ( 'BotNavList', $prodType->prodTypeList ( false ) );
		}catch(\Exception $e){
			echo $e->getMessage();
		}
		
	}
	
	private function pageNavList() {
		if (! is_object ( $this->pageNavObj )) {
			$this->pageNavObj = A ( 'Pageview', 'Event' );
		}
		// return $this->pageNavObj->pageNavList ();
	}
	private function publicSystem() {
		if (! is_object ( $this->systemObj )) {
			$this->systemObj = A ( 'Systems', 'Event' );
		}
		return $this->systemObj->publicSystem ();
	}
	private function pageNavBot() {
		if (S ( 'PageBotList' )) {
			return S ( 'PageBotList' );
		} else {
			return $this->pageNavObj->pageBotList ();
		}
	}
	/**
	 */
	protected function getTypeContent($rurl, $adjoin = true) {
		if (empty ( $rurl ))
			redirect ( 'index' );
		$newsType = A ( 'Newstype', 'Event' );
		
		$Page = $newsType->newsTypeData ( $rurl );
		if (empty ( $Page ))
			redirect ( 'index' );
		
		$pageId = intval ( $Page ['type_subpage'] );
		$dataPage = $this->pageNavObj->pageInfoArray ( $pageId );
		
		$Page ['MainData'] = $dataPage;
		if ($adjoin)
			$Page ['TypeList'] = $this->getTypeSubList ( $newsType, $pageId );
		
		return $Page;
	}
	
	/**
	 * 1锛氳幏鍙栧悓绾у埆绫诲瀷鍒楄〃
	 * :2锛氬悓绾у埆绫诲瀷鐨勫瓙绫诲瀷鍒楄〃
	 *
	 * @param object $obj        	
	 * @param int $data        	
	 * @return array $newsTypeArray
	 */
	protected function getTypeSubList($obj, $pageId) {
		$newsTypeArray = $obj->newsTypeList ( array (
				'field' => 'autoid,type_pagename,type_name,type_url,type_view,description',
				'where' => 'type_subpage = ' . $pageId,
				'order' => 'type_sort asc,autoid asc' 
		) );
		
		if (! empty ( $newsTypeArray )) {
			foreach ( $newsTypeArray as $key => $value ) {
				$subTypeList = $obj->newsTypeList ( array (
						'field' => 'autoid,type_pagename,type_name,type_url,type_view,description',
						'where' => 'type_main = ' . $newsTypeArray [$key] ['autoid'],
						'order' => 'type_sort asc,autoid asc' 
				) );
				if (! empty ( $subTypeList ))
					$newsTypeArray [$key] ['SubList'] = $subTypeList;
			}
		}
		// 鍚岀骇鍒殑瀛愮被鍒楄〃
		
		return $newsTypeArray;
	}
	
	/**
	 * 返回页面信息内容
	 *
	 * @return array
	 */
	protected function pageConfig($pageName) {
		$page = $this->pageNavObj->dataContent ( array (
				'field' => 'title,c_name,c_image,keywords,description',
				'where' => "c_code = '" . $pageName . "'" 
		) );
		return $page;
	}
}