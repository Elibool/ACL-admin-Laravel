<?php


namespace  App\Http\Helpers;

class Tree
{
    /**
     * 生成树型结构所需要的2维数组
     * @var array
     */
    public $arr = [];
    /**
     * 生成树型结构所需修饰符号，可以换成图片
     * @var array
     */
    public $icon = ['┃', '┣', '┗'];
    public $nbsp = "&nbsp;";

    /**
     * @access private
     */
    public $ret = '';

    /**
     * 构造函数，初始化类
     * @param array 2维数组，例如：
     * array(
     *      1 => array('id'=>'1','parent_id'=>0,'name'=>'一级栏目一'),
     *      2 => array('id'=>'2','parent_id'=>0,'name'=>'一级栏目二'),
     *      3 => array('id'=>'3','parent_id'=>1,'name'=>'二级栏目一'),
     *      4 => array('id'=>'4','parent_id'=>1,'name'=>'二级栏目二'),
     *      5 => array('id'=>'5','parent_id'=>2,'name'=>'二级栏目三'),
     *      6 => array('id'=>'6','parent_id'=>3,'name'=>'三级栏目一'),
     *      7 => array('id'=>'7','parent_id'=>3,'name'=>'三级栏目二')
     *      )
     * @return bool
     */
    public function init($permissions)
    {
        $this->arr = $permissions;
        $this->ret = '';
        return is_array($permissions);
    }
    /**
     * 得到子级数组
     * @param int
     * @return array
     */
    public function get_child($my_id)
    {
        $new_arr = [];
        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {
                if ($a['parent_id'] == $my_id) $new_arr[$id] = $a;
            }
        }
        return $new_arr ? $new_arr : false;
    }
    /**
     * 固定最高获得二级子数组
     * @param init
     * @param array
     * @return array
     */
    public function get_all_child($pid,$user_permission=[])
    {
        $child_arr = $this->get_child($pid);
        foreach($child_arr as $key=>$info)
        {
            if($user_permission && !in_array($info['id'],$user_permission))
            {
                unset($child_arr[$key]);
            }
            $second = $this->get_child($info['id']);
            if($second)
            {
                foreach($second as $second_val){
                    if($user_permission && !in_array($second_val['id'],$user_permission))
                    {
                        continue;
                    }
                    $child_arr[$key]['child'][] = $second_val;
                }
            }
        }
        return $child_arr;
    }
    /**
     * 得到树型结构
     * @param int $my_id，表示获得这个ID下的所有子级
     * @param string $str 生成树型结构的基本代码，例如："<option value=\$id \$selected>\$spacer\$name</option>"
     * @param int $sid 被选中的ID，比如在做树型下拉框的时候需要用到
     * @param string $add_space
     * @return string
     */
    public function get_tree($my_id, $str, $sid = 0, $add_space = '')
    {
        $number = 1;
        $child = $this->get_child($my_id);
        //判断子集合是否是数组,结束递归
        if (is_array($child)) {
            $total = count($child);
            foreach ($child as $id => $value) {
                $j = $k = '';
                if ($number == $total) {
                    $j .= $this->icon[2];
                } else {
                    $j .= $this->icon[1];
                    $k = $add_space ? $this->icon[0] : '';
                }
                //该变量直接分配到 $ev_str
                $spacer = $add_space ? $add_space . $j : '';
                //将数组中每个 key=>value 元素转为 对应变量
                @extract($value);

                $selected = $id == $sid ? 'selected' : '';

                //是否显示
                $is_display = $value['is_display'] ? '':'<i class="fa fa-eye-slash red"></i>';

                //直接将字符串 运行为 php $ev_str = '<option value="2" >| 用户</option>';
                $ev_str = '';
                @eval("\$ev_str = \"$str\";");
                $this->ret .= $ev_str;

                $this->get_tree($id, $str, $sid, $add_space.$k.$this->nbsp);
                $number++;
            }
        }
        return $this->ret;
    }
}