<?php
class NewsviewAction extends CommonAction {
	public function index() {
		$pageName = "Error:index";
		if (isset ( $_GET ['id'] ) && intval ( $_GET ['id'] )) {
			$id = intval ( $_GET ['id'] );
			$newSql = array (
					'where' => 'autoid=' . $id 
			);
			$newsArray = R ( "Table/News/reContent", array (
					$newSql 
			) );
			// 数据存在时
			if (is_array ( $newsArray )) {
				$this->assign ( "News", $newsArray );
				$pageName = "";
				// 上一条新闻
				$prevSql = array (
						'field' => 'autoid,n_title',
						'where' => ' autoid <' . $id,
						'limit' => '0,1' 
				);
				$prevArray = R ( "Table/News/reTable", array (
						$prevSql 
				) );
				$this->assign ( "PrevNews", $prevArray [0] );
				
				// 下一条新闻
				$nextSql = array (
						'field' => 'autoid,n_title',
						'where' => ' autoid >' . $id,
						'limit' => '0,1' 
				);
				$nextArray = R ( "Table/News/reTable", array (
						$nextSql 
				) );
				$this->assign ( "NextNews", $nextArray [0] );
				$this->getMenulist ();
				$this->getPublic ();
				$this->display ();
			} else {
				LocationUrl ( 'newslist' );
			}
		} else {
			LocationUrl ( 'newslist' );
		}
	}
}