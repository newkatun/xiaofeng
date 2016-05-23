<?php

namespace Home\Event;

class PageviewEvent extends CommonEvent {
	private $_pageNavData, $_pageBotData;
	public function _initialize() {
		$this->_model = D ( 'Pageview' );
	}
	
	/**
	 * Enter description here .
	 */
	public function pageNavList() {
		if (S ( 'PageNavList' )) {
			$this->_pageNavData = S ( 'PageNavList' );
		} else {
			$this->_pageNavData = $this->dataList ( array (
					'field' => 'c_name,c_lurl',
					'where' => " c_index = 'Y' ",
					'order' => ' c_sort asc,autoid asc' 
			) );
			S ( 'PageNavList', $this->_pageNavData );
		}
		return $this->_pageNavData;
	}
	public function pageBotList() {
		if (S ( 'PageBotList' )) {
			$this->_pageBotData = S ( 'PageBotList' );
		} else {
			$this->_pageBotData = $this->dataList ( array (
					'field' => 'autoid,c_name,c_lurl',
					'order' => ' autoid asc',
					'where' => "c_bottom ='Y' ",
					'limit' => '0,3' 
			) );
			$newsType = A ( 'Newstype', 'Event' );
			foreach ( $this->_pageBotData as $key => $value ) {
				$this->_pageBotData [$key] ['NewsType'] = $newsType->newsTypeList ( array (
						'field' => 'autoid,type_pagename,type_view,type_name,type_url',
						'where' => 'type_subpage = ' . $value ['autoid'],
						'order' => 'type_sort asc,autoid asc',
						'limit' => '0,3' 
				) );
			}
			S ( 'PageBotList', $this->_pageBotData );
		}
		return $this->_pageBotData;
	}
	
	/**
	 * 请求页面详细内容
	 *
	 * @param int|string $pageName        	
	 */
	public function pageInfoArray($pageName = 'index', $strArray = array()) {
		if (is_string ( $pageName )) {
			$pageName = ucfirst ( strtolower ( $pageName ) );
			$sqlArray = array (
					'where' => "c_code ='" . $pageName . "'" 
			);
			$sqlArray ['field'] = isset ( $strArray ['field'] ) ? $strArray ['field'] : '*';
		} elseif (is_int ( $pageName )) {
			$sqlArray = $pageName;
		} else {
			return false;
		}
		return $this->dataContent ( $sqlArray );
	}
}

?>