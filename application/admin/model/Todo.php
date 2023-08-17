<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Todo extends Model
{

    use SoftDelete;

    

    // 表名
    protected $name = 'todo';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'integer';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [
        'status_text',
        'prio_text',
        'todotime_text',
        'donetime_text',
        'giveuptime_text'
    ];
    

    
    public function getStatusList()
    {
        return ['1' => __('Status 1'), '2' => __('Status 2'), ' 3' => __('Status  3')];
    }

    public function getPrioList()
    {
        return ['1' => __('Prio 1'), '2' => __('Prio 2'), '3' => __('Prio 3'), '4' => __('Prio 4')];
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getPrioTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['prio']) ? $data['prio'] : '');
        $list = $this->getPrioList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getTodotimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['todotime']) ? $data['todotime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getDonetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['donetime']) ? $data['donetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getGiveuptimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['giveuptime']) ? $data['giveuptime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setTodotimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setDonetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setGiveuptimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


    public function user()
    {
        return $this->belongsTo('User', 'userid', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
