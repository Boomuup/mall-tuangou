<?php
namespace app\common\model;

use think\Model;

/**
 * 生活服务分类模型
 */
class Category extends Model
{
	// 自动完成
    protected $auto = [];
    protected $insert = ['status' => 1, 'sort' => 100];
    protected $update = [];

    // 自动维护时间戳
    protected $autoWriteTimestamp = true;
    
    
	/**
	 * 获取正常的顶级分类
	 * @return [type] [description]
	 */
	public function getNormalTopCategory()
	{
		$where = [
			'parent_id' => 0,
			'status' => 1
		];
		$order = [
			'sort' => 'ASC',
			'id' => 'DESC'
		];
		$field = ['id', 'name', 'sort', 'parent_id', 'create_time'];

		return $this->where($where)->field($field)->order($order)->select();
	}

	/**
	 * 获取未删除的分类
	 * @param  integer $parent_id 父ID，默认为0
	 * @return [type]             [description]
	 */
	public function getCategory($parent_id = 0)
	{
		$where = [
			'parent_id' => $parent_id,
			'status' => ['egt', 0]
		];
		$order = [
			'sort' => 'ASC',
			'id' => 'DESC'
		];
		$field = ['id', 'name', 'sort',  'status', 'parent_id', 'create_time'];

		return $this->where($where)->field($field)->order($order)->paginate();
	}

	/**
	 * 获取正常分类，根据父ID 
	 * @return [type] [description]
	 */
	public function getNormalCategoryByParentId($parent_id = 0)
	{
		$where = [
			'parent_id' => $parent_id,
			'status' => 1
		];
		$order = [
			'sort' => 'ASC',
			'id' => 'DESC'
		];
		$field = ['id', 'name', 'sort', 'parent_id', 'create_time'];

		return $this->where($where)->field($field)->order($order)->select();
	}
}