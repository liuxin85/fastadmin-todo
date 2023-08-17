<?php

namespace app\admin\model;

use think\Model;


class Ceshi extends Model
{

    

    

    // 表名
    protected $name = 'ceshi';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'ceshinum_text'
    ];
    

    
    public function getCeshinumList()
    {
        return ['0' => __('Ceshinum 0'), '1' => __('Ceshinum 1'), '2' => __('Ceshinum 2')];
    }


    public function getCeshinumTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['ceshinum']) ? $data['ceshinum'] : '');
        $list = $this->getCeshinumList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
