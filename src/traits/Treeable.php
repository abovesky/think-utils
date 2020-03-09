<?php

namespace abovesky\utils\traits;

trait Treeable
{
    /**
     * @var string
     */
    protected $parentColumn = 'parent_id';

    /**
     * @var string
     */
    protected $titleColumn = 'title';

    /**
     * @var string
     */
    protected $orderColumn = 'order';

    /**
     * @var \Closure
     */
    protected $queryCallback;

    public function children()
    {
        return $this->hasMany(self::class, $this->parentColumn);
    }

    public function childrenTree()
    {
        return $this->children()->with('children');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeTopLevel($query)
    {
        return $query->where($this->parentColumn, 0);
    }

    /**
     * @return string
     */
    public function getParentColumn()
    {
        return $this->parentColumn;
    }

    /**
     * Set parent column.
     *
     * @param string $column
     */
    public function setParentColumn($column)
    {
        $this->parentColumn = $column;
    }

    /**
     * Get title column.
     *
     * @return string
     */
    public function getTitleColumn()
    {
        return $this->titleColumn;
    }

    /**
     * Set title column.
     *
     * @param string $column
     */
    public function setTitleColumn($column)
    {
        $this->titleColumn = $column;
    }

    /**
     * Get order column name.
     *
     * @return string
     */
    public function getOrderColumn()
    {
        return $this->orderColumn;
    }

    /**
     * Set order column.
     *
     * @param string $column
     */
    public function setOrderColumn($column)
    {
        $this->orderColumn = $column;
    }

    /**
     * Set query callback to model.
     *
     * @param \Closure|null $query
     *
     * @return $this
     */
    public function withQuery(\Closure $query = null)
    {
        $this->queryCallback = $query;

        return $this;
    }

    /**
     * Format data to tree like array.
     *
     * @return array
     */
    public function toTree()
    {
        return $this->buildNestedArray();
    }

    /**
     * 使用方法：
     * Model::topLevel()->with(['users','childrenTree'])->all(); // 获取层级嵌套关系（无限极）
     * Model::topLevel()->with(['users'])->all(); // 获取顶层数据
     * return $this->children()->with('childrenTree'); //应该是这样
     */
}
