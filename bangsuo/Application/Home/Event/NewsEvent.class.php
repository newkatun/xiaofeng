<?php

namespace Home\Event;

class NewsEvent extends CommonEvent {
	public function _initialize() {
		$this->_model = D ( 'News' );
	}
	public function newsList($arr, $page = true) {
		$sqlArray = array (
				'field' => 'autoid,news_name,datetimes' 
		);
		$arr = array_merge($sqlArray,$arr);
		return $this->dataList ( $arr, $page );
	}
	/**
	 * 同类文章上一条记录或下一条记录
	 * @param int $id
	 * @param int $tid
	 * @param $type string
	 */
	public function newsBesideData( $id, $tid,$type='<'){
		$data = $this->dataList ( array (
				'field' => 'autoid,news_name',
				'where' => 'autoid ' .$type .' ' . $id . ' And news_type = ' .  $tid ,
				'order' => ' autoid desc' ,
				'limit' => '0,1'
		) );
		return $data;
	}
	
	
	public function newsBesideList( $id, $tid){
		$data = $this->dataList ( array (
				'field' => 'autoid,news_name',
				'where' => ' ( autoid  > ' . $id . ' or  autoid  < ' . $id . ' ) And news_type = ' .  $tid ,
				'order' => ' autoid desc' ,
				'limit' => '0,10'
		) );
		return $data;
	}
}

?>