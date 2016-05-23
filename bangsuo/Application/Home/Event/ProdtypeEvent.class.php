<?php

namespace Home\Event;

class ProdtypeEvent extends CommonEvent {
	public function _initialize() {
		$this->_model = D ( 'Prodtype' );
	}
	public function prodTypeContent($id = 0) {
		return $this->dataContent ( array (
				'field' => 'autoid,ty_name,title,keywords,description',
				'where' => 'autoid = ' . $id 
		) );
	}
	public function prodTypeList($flag = true) {
		$data = $this->dataList ( array (
				'field' => 'autoid,ty_name',
				'where' => 'ty_subid = 0' 
		) );
		if ($flag) {
			foreach ( $data as $key => $value ) {
				$data [$key] ['SubList'] = $this->dataList ( array (
						'field' => 'autoid,ty_name,ty_subid',
						'where' => 'ty_subid = ' . $data [$key] ['autoid'] 
				) );
			}
		}
		
		return $data;
	}
}