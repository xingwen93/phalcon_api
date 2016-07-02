<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/2 0002
 * Time: 12:37
 */
use Phalcon\Mvc\Controller;
class BaseController extends  Controller{

    /**
     * 插入数据
     */
    public function insertAction() {
        $this->view->disable();
//        $User = new  User();
        $Developer =new Developer();
        //设置需要写入的数据
        //如果在model里面没有设置公共变量,对这边的使用也没有影响但是对IDE有良好的提示功能
        $Developer->setName("4654564654654654654");
        $Developer->setPasswd("dfdSDFDsf");
        $Developer->setPhone("18819493903");
        //执行操作
        $ret = $Developer->save();

        //对结果进行验证
        if ($ret) {
            echo "写入数据成功";
        } else {
            //如果插入失败处理打印报错信息
            echo "写入数据库失败了";
            foreach ($User->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

        echo '<h1>BasemodelController/select!</h1>';
    }

    /**
     * 根据id查询数据
     */
    public function indexAction() {
        $this->view->disable();
        $rs = User::find(2);
        var_dump($rs->toArray());
        echo '<h1>BasemodelController/select!</h1>';
    }

    public function findallAction(){
        $this->view->disable();
        //查询出所有的记录
        $rs = User::find();
        var_dump($rs->toArray());

        echo '</br>';
        echo '</br>';
        //通过where条件进行查询匹配的
        $rs = User::find("name = 'phalcon'");
        echo "名称为'phalcon的用户有'", count($rs), "个\n</br>";

        echo '</br>';
        // 获取名称为phalcon的用户并且通过phone排序
        $rs = User::find(array(
            "name = 'phalcon'",
            "order" => "phone"
        ));
        foreach ($rs as $user) {
            echo $user->name, "111\n";
            echo $user->phone, "555\n";
            echo '</br>';
        }
        echo '</br>';

        // 获取通过name排序的前100条数据
        $rs = User::find(array(
            "order" => "name",
            "limit" => 100
        ));
        foreach ($rs as $user) {
            echo $user->name, "\n";
            echo '</br>';
        }
        //通过findFirst可以获取第一条符合查询条件的结果 可以和find一样加入条件
        $rs = User::findFirst();
        echo "第一个用户的名称为 ", $rs->name, "\n";
    }
    //根据id更改数据
    public function updateAction() {
        $this->view->disable();
        $User       = new  User();
        $User->id   = 1;
        $User->name = "test";
        //执行操作
        $ret = $User->save();

        //对结果进行验证
        if ($ret) {
            echo "修改数据成功";
        } else {
            //如果插入失败处理打印报错信息
            echo "修改数据库失败了";
            foreach ($User->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }
    }
    public function findandupdateAction(){
        $this->view->disable();
        $User = User::findFirst(2);
        $User->phone = "44441111";
        //执行操作
        $ret = $User->save();
    }

    /**
     * 删除
     */
    public function deleteAction() {
        $this->view->disable();
        $User       = new  User();
        $User->id   = 1;
        //执行操作
        $ret = $User->delete();

        //对结果进行验证
        if ($ret) {
            echo "删除数据成功";
        } else {
            //如果插入失败处理打印报错信息
            echo "删除数据库失败了";
            foreach ($User->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }
    }
    public function queryAction() {
        $this->view->disable();
        //连贯操作
        $rs = User::query()->where("name = :name:")->andWhere("phone  = 13011111111")->bind(array("name" => "phalcon"))->order("phone")->execute();
        foreach ($rs as $user) {
            echo $user->getName(), "\n";
            echo '</br>';
        }

        //条件替换 ?
//        $conditions = "name = ?1 AND phone = ?2";
//        $parameters = array(1 => "phalcon", 2 => "13011111111");
//        $rs         = user::find(array(
//            $conditions,
//            "bind" => $parameters
//        ));
//
//        //条件替换 混合
//        $conditions = "name = :name: AND phone = ?1";
//        $parameters = array(
//            "name" => "phalcon",
//            1      => "13011111111"
//        );
//
//        $rs = User::find(array(
//            $conditions,
//            "bind" => $parameters
//        ));
//
//        //条件替换 根据数组下标
//        $rs = User::find(array(
//            "name = ?0",
//            "bind" => ["phalcon"],
//        ));
//
//        //IN操作
//        $array = array('phalcon', 'phalcon2');
//        $rs    = User::find(array(
//            'name IN ({letter:array})',
//            'bind' => array(
//                'letter' => $array
//            )
//        ));
//
//        //一共有多少用户
//        $count = User::count();
//        echo '</br>' . $count;
//
//        //一共有多少个名字叫phalcon的
//        $count = User::count(array(
//            "name = ?0",
//            "bind" => array('phalcon')
//
//        ));
//        echo '</br>' . $count;
//
//        //名字不同的人有几种
//        $count = User::count(array(
//            "distinct" => "name"
//        ));
//        echo '</br>' . $count;
//
//        //电话号码的和是多少
//        $sum = User::sum(array(
//            "column" => "phone"
//        ));
//        echo '</br>' . $sum;
//
//        //名字是phalcon的
//        $sum = User::sum(
//            array(
//                "column"     => "phone",
//                "conditions" => "name = 'phalcon'"
//            )
//        );
//        echo '</br>' . $sum;
//
//        //电话号码平均值
//        $average = User::average(
//            array(
//                "column" => "phone"
//            )
//        );
//        echo '</br>' . $average;
//
//        //最大的电话号码
//        $max = User::maximum(
//            array(
//                "column" => "phone"
//            )
//        );
//        echo '</br>' . $max;
//
//        //最小的电话号码
//        $min = User::minimum(
//            array(
//                "column" => "phone"
//            )
//        );
//        echo '</br>' . $min;
    }

}
