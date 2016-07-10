<?php
/**
 * Test
 */
namespace App\Controller;

use FlyPhp\Controller\Base;
use FlyPhp\Core\Config;

class Test extends Base
{
    protected $defaultAction = 'index';
    protected $layout = 'index';

    public function index()
    {
        $this->headers = [
            'content-type' => 'xml', 
        ];
        $this->view = 'test/index';
        return ['title' => 'hello world!'];
    }
    /**
     * @desc 登陆
     *
     */
    public function login()
    {
        if (!empty($this->request->session('name', 'string'))) {
            header("Location: /");
        }

        $this->layout = null;
        $this->view = 'test/login';

        return true;
    }

    public function submit()
    {
        $name = $this->request->post('name', 'string');
        $pass = $this->request->post('password', 'string');
        $code = $this->request->post('code', 'string');

        if (Config::auth($name) === null) {
            return ['status' => 1, 'msg' => '用户不存在'];
        }
        if ($pass != Config::auth($name)) {
            return ['status' => 1, 'msg' => '密码错误'];
        }

        if ($this->request->session('phrase', 'string') != $code) {
            return ['status' => 1, 'msg' => '验证码错误'];
        }

        $_SESSION['name'] = $name;

        return ['status' => 0];
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /user/login");
        return true;
    }

    public function mysql()
    {
        $id = time();
        $ret = \App\Model\Test::getInstance()->insert(['id'=>$id, 'money' => 1.0]);
        $ret = \App\Model\Test::getInstance()->update(['money'=>3], [['id', $id]]);
        $ret = \App\Model\Test::getInstance()->findAll();
        $ret = \App\Model\Test::getInstance()->find($id);
        $ret = \App\Model\Test::getInstance()->findBy([['money', '2.0']]);
        $ret = \App\Model\Test::getInstance()->findOneBy([['money', '2.0']]);
        return var_dump($ret);
    }

    public function mongodb()
    {
        $id = time();
        $ret = \App\Model\User::getInstance()->insert(['id'=>$id, 'money' => 1.0]);
        $ret = \App\Model\User::getInstance()->find($id);
        $ret = \App\Model\User::getInstance()->findAll()->count();
        $ret = \App\Model\User::getInstance()->findOneBy(['money' => 1.0]);
        $ret = \App\Model\User::getInstance()->findBy(['money' => 1.0])->count();
        return var_dump($ret);
    }

}

