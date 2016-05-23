<?php

namespace Home\Model;

use Think\Model;
use Think\Exception;

class CommonModel extends Model {
	
	/**
	 * 获取没有分页的数据内容
	 *
	 * @param array $strArray
	 *        	'where'=>条件 ,'join'=>联表查询 ,'order'=>排序内容,'field'=>字段内容,limit=>sql限制内容
	 */
	protected function getList($strArray = '') {
		$returnData = $this->select ( $strArray );
		return $returnData;
	}
	
	/**
	 * 显示带有分页功能的数据
	 */
	protected function getPageList($strArray = '', $pagesize = 12) {
		if (empty ( $strArray ['where'] ) == false) {
			$count = $this->where ( $strArray ['where'] )->count ();
		} else {
			$count = $this->count ();
		}
		$pagesize = isset ( $strArray ['pagesize'] ) && intval ( $strArray ['pagesize'] ) > 0 ? intval ( $strArray ['pagesize'] ) : $pagesize;
		$p = new \Think\Page ( $count, $pagesize );
		
		$lists = $this->limit ( $p->firstRow . ',' . $p->listRows )->select ( $strArray );
		return array (
				'lists' => $lists,
				'page' => $p->show () 
		);
	}
	/**
	 * 显示详细内容
	 *
	 * @param string $strtable
	 *        	表名称
	 * @param array $strArray
	 *        	$strArray 为数组的时候表示操作表达式，通常由连贯操作完成；为数字或者字符串的时候表示主键值
	 */
	protected function getTableCont($strArray = '') {
		if (is_array ( $strArray ) && ! empty ( $strArray ['where'] )) {
			$strArray ['field'] = isset ( $strArray ['field'] ) && ! empty ( $strArray ['field'] ) ? $strArray ['field'] : '*';
			return $this->field ( $strArray ['field'] )->where ( $strArray ['where'] )->find ();
		}
		if (is_int ( $strArray ) && intval ( $strArray ) > 0) {
			return $this->find ( $strArray );
		}
		return $this->limit ( 1 );
	}
	
	/**
	 * 插入数据内容
	 *
	 * @param array $strArray        	
	 */
	protected function getInsert($strArray) {
		$returnData = $this->add ( $strArray );
		return $returnData;
	}
	
	/**
	 * 批量插入数据内容
	 *
	 * @param array $strArray        	
	 */
	protected function getInsertAll($strArray) {
		$returnData = $this->addAll ( $strArray );
		return $returnData;
	}
	
	/**
	 * 数据更新
	 *
	 * @param array $strArray
	 *        	'where'=>条件 ,'join'=>联表查询 ,'order'=>排序内容,'field'=>字段内容,limit=>sql限制内容
	 * @param array $strData
	 *        	更新的数据
	 */
	protected function getUpdate($strArray) {
		try {
			$returnData = $this->where ( $strArray ['where'] )->save ( $strArray ['data'] );
		} catch ( Exception $e ) {
			E ( '新增失败' );
			echo $e->getMessage ();
		}
		return $returnData;
	}
	
	/**
	 * 数据更新部分内容，如点击率或积分增减等数字类型变化
	 *
	 * @param array $strArray
	 *        	'where'=>条件 ,'join'=>联表查询 ,'order'=>排序内容,'field'=>字段内容,limit=>sql限制内容
	 * @param bool $strType
	 *        	true表示增加，false表示减少
	 */
	protected function getNumUpdate($strArray) {
		if (isset ( $strArray ['status'] ) && $strArray ['status'] == true) {
			$returnData = $this->where ( $strArray ['where'] )->setInc ( $strArray ['field'], $strArray ['number'] );
		} else {
			$returnData = $this->where ( $strArray ['where'] )->setDec ( $strArray ['field'], $strArray ['number'] );
		}
		return $returnData;
	}
	
	/**
	 * 数据删除
	 *
	 * @param string $strTable
	 *        	表名称
	 * @param array $strArray
	 *        	'where'=>条件 ,'join'=>联表查询 ,'order'=>排序内容,'field'=>字段内容,limit=>sql限制内容
	 */
	protected function getDelData($strArray) {
		$returnData = $this->where ( $strArray ['where'] )->delete ();
		return $returnData;
	}
	
	/**
	 * 统计某个条件下的数据个数
	 *
	 * @param string $strTable
	 *        	被统计表名称
	 * @param array $strArray
	 *        	统计条件
	 */
	protected function getCountNumber($strArray) {
		if (isset ( $strArray ['where'] ) && ! empty ( $strArray ['where'] )) {
			$returnData = $this->where ( $strArray ['where'] )->count ();
		} else {
			$returnData = $this->count ();
		}
		return $returnData;
	}
	
}