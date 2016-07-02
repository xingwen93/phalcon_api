<?php

/**
 * 默认控制器 对请求进行处理
 * @author: 马兴文  <1042492275@qq.com>
 */

use Phalcon\Mvc\Controller;

// Index控制器类 必须继承Controller
class IndexController extends Controller {

    // 默认Action
    public function indexAction() {

        $this->view->disable();
//        $this->session->set('username', 'miao');
//        $this->session->remove("u、sername");
//        $this->session->destroy();
//      具体的不同应用隔离,会话袋,组件的持久数据等处理看官网


//          $request = $this->request;
//        var_dump($request->get());                          //默认获取所有的请求参数返回的是array效果和获取$_REQUEST相同
//        var_dump($request->get('wen'));                     //获取摸个特定请求参数key的valuer和$_REQUEST['key']相同
//        var_dump($request->getQuery('url', null, 'url'));   //获取get请求参数,第二个参数为过滤类型,第三个参数为默认值
//        var_dump($request->getMethod());                    //获取请求的类型如果是post请求会返回"POST"
//        var_dump($request->isAjax());                       //判断请求是否为Ajax请求
//        var_dump($request->isPost());                       //判断是否是Post请求类似的有(isGet,isPut,isPatch,isHead,isDelete,isOptions等)
//        var_dump($request->getHeaders());                   //获取所有的Header,返回结果为数组
//        var_dump($request->getHeader('Content-Type'));      //获取Header中的的莫一个指定key的指
//        var_dump($request->getURI());                       //获取请求的URL比如phalcon.w-blog.cn/phalcon/Request获取的/phalcon/Request
//        var_dump($request->getHttpHost());                  //获取请求服务器的host比如phalcon.w-blog.cn/phalcon/Request获取的phalcon.w-blog.cn
//        var_dump($request->getServerAddress());             //获取当前服务器的IP地址
//        var_dump($request->getRawBody());                   //获取Raw请求json字符
//        var_dump($request->getJsonRawBody());               //获取Raw请求json字符并且转换成数组对象
//        var_dump($request->getScheme());                    //获取请求是http请求还是https请求
//        var_dump($request->getServer('REMOTE_ADDR'));       //等同于$_SERVER['REMOTE_ADDR']
//        echo "<h1>Request!</h1>";
        $response = $this->response;
//        $headers = $response->getHeaders();                         //获取Headers实例
//        $headers->set('header1', 'header1');                        //写入header实例一个header头
//        $response->setHeaders($headers);                            //设置一组返回的headers头
//        $response->getHeaders();                                    //查看当前的headers头
//        $response->setHeader('header2', 'header2');                 //单独设置一个返回的header头

        //跳转类
//          $response->redirect("Request/test");                     //跳转到这个内部的Request模块Index方法(注意需要设置URL不然会跳转到public显示404)
//        $response->redirect("http://www.baidu.com", true);        //跳转到这个外部地址
//        $response->redirect("http://www.baidu.com", true, 302);   //跳转到这个外部地址并且给当前页面一个状态码
        //return类
//$response->appendContent('test');                          //添加一段返回类容
//$response->setJsonContent(array('Response' => 'ok'));      //返回一个json,参数必须是数组
//$response->setContent("<h1>Hello!</h1>");                  //返回需要显示在页面上的内容
//$response->setStatusCode(404, "Not Found");                //返回http请求状态,以及msg
//return $response->send();                                  //打印响应
        echo "<h1>Hello Word!</h1>";

    }
    public function testAction(){
        /**
         * url路由分发 原型
         * http://localhost/phalcon/public/?_url=/Index/test
         *
         */
        $this->view->disable();
        echo $this->session->get('username');
        echo "<h1>nm;im</h1>";
    }

}
