<?php
namespace app\controller;

use app\BaseController;
use app\model\Menu;


class Index extends BaseController
{

    public function index(){
        $model=new Menu();
        $res =$model->select()->toArray();
        $res1 = $this->tree($res);
        dump($res1);
    }
    public function tree($data){
//构建一个新数组，新数组的key是自己的主键ID
       $items = array();
       foreach ($data as $v){
           $items[$v['id']]=$v;
       }
       $tree =array();
       foreach($items as $k=>$item){
           if (isset($items[$item['pid']])){
               $items[$item['pid']]['son'][] = &$items[$k];
           }else{
               $tree[]=&$items[$k];
           }

       }
        return $tree;
    }

    /**
     * 递归方式
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function ttt()
    {
        $model=new Menu();
        $res =$model->select()->toArray();
        $res1 = $this->category($res);
        foreach($res1 as $value){
            echo str_repeat('--', $value['level']), $value['menu_name'].'<br />';
        }
    }

   public function category($arr,$pid=0,$level=0){
        //先定义一个静态变量，存储一个空数组，使用静态变量，是因为静态变量不会被销毁，会保存之前存的值
       //保存一个空数组
       static $list = array();
//       通过遍历查找是否属于顶级父类，pid=0为顶级父类
       foreach ($arr as $value){

           if ($value['pid'] == $pid){
               //分层
               $value['level']=$level;
               $list[]=$value;
               //递归点，调用自身把顶级id作为父类进行在调用循环
               $this->category($arr,$value['id'],$level+1);
           }
       }
       return $list;
   }











    /**
     * 回文数
     * 例如：414,525等等
     * @return string
     */
    public function huiwen()
    {
        $y=-121;
        $new=0;
        $x=$y;
        while($x !=0){

            $yu = $x%10;
            $x = intval($x/10);
            $new = $new*10 + $yu;
        }

        if($new == $y and $new>0){
            return "true";
        }else{
            return "false";
        }

    }




    /**
     * 翻转数值
     * @return float|int
     */
    public function text()
    {
        $x= -12345679;
        $newNum=0;
        while($x != 0){
            $yu = $x%10;
            $x = intval($x/10);
            $newNum = $newNum*10 + $yu;
        }
        if ($newNum > (pow(2,31)-1) || $newNum < pow(-2,31)) {
            return 0;
        }
        return $newNum;
    }









    /**
     * 冒泡排序法案例
     */
    public function maopao()
    {
        $num=array(2,4,6,1,3,7,8,5,9,0);
        dump($num);
        for ($i=0;$i<count($num);$i++){
            for ($j=0;$j<count($num);$j++){
                if ($num[$i]<$num[$j]){
                    $tmp = $num[$i];
                    $num[$i]=$num[$j];
                    $num[$j]=$tmp;
                }
            }
        }
        dump($num);
    }






//算法题
//给定一个整数数组 nums 和一个目标值 target，请你在该数组中找出和为目标值的那 两个 整数，并返回他们的数组下标。
//你可以假设每种输入只会对应一个答案。但是，数组中同一个元素不能使用两遍。
public function test(){
    $num=array(2,4,6,1,3,7,8,5,9,0);
    $target=9;
    for ($i=0; $i < count($num); $i++){
        for ($j=0;$j<count($num);$j++){
            if ($num[$i]+$num[$j]==$target){
                dump($num[$i].$num[$j]);
            }
        }
    }
}







}
