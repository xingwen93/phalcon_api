<?php

/**
 * 控制器的控制器 对请求进行处理
 * @author: 马兴文  <1042492275@qq.com>
 */

use Phalcon\Mvc\Controller;

// 控制器类 必须继承Controller
class MyViewController extends Controller {

    public function initialize()
    {
        $this->view->setTemplateAfter('common');
    }

    // 测试Action
    public function indexAction() {
//        $this->view->disable();
//        $this->view->pick("Index/index2");//不同的action制定不同的模板文件
        $this->view->Id = "1";
    }
}
