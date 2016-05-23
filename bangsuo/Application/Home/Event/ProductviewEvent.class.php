<?php
namespace  Home\Event;
class ProductviewEvent extends CommonEvent{
	public function _initialize() {
		$this->_model = D ( 'Productview' );
	}
	public function dataCookie() {
		if (! isset ( $_COOKIE ['visitprod'] )) {
			return false;
		}
		$his_pid = $_COOKIE ['visitprod'];
		if (empty ( $his_pid )) {
			return false;
		}
		$dataProd = $this->dataList ( array (
				'where' => 'autoid in (' . $his_pid . ')'
		) );
		return $dataProd;
	}
	
	/**
	 * 点击排行
	 *
	 * @param int $mid
	 *        	一级类别ID
	 * @param int $mid
	 *        	二级类别ID
	 */
	public function dataClickTop($mid = 0, $sid = 0) {
		$strSql = '';
		if ($mid)
			$strSql .= '  and p_typeid =' . $mid;
		if ($sid)
			$strSql .= '  and p_ttypeid =' . $sid;
		$sqlArray = array (
				'where' => 'p_status = 1 ' . $strSql,
				'limit' => '0,5',
				'order' => 'p_clicks desc,autoid desc'
		);
		return $this->dataList ( $sqlArray );
	}
	
	/**
	 * 相关联产品
	 *
	 * @param int $prodId
	 *        	产品编号
	 * @param int $mid
	 *        	一级类别ID
	 * @param int $mid
	 *        	二级类别ID
	 *
	 */
	public function dataLink($prodId, $mid = 0, $sid = 0) {
		$strSql = '';
		if ($mid)
			$strSql .= '  and p_typeid =' . $mid;
		if ($sid)
			$strSql .= '  and p_ttypeid =' . $sid;
		$sqlArray = array (
				'where' => 'p_status = 1 and autoid <>' . $prodId . $strSql,
				'limit' => '0,5',
				'order' => 'autoid desc'
		);
		return $this->dataList ( $sqlArray );
	}
	
}