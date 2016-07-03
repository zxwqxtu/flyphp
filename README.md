## 界面输出字符编码 ##
config.php设置charset=UTF-8

# 控制器 #
## 模板 ##
$this->view='test/index',则表示views/test/index.php

## layout布局 ##
$this->layout='index',则表示layout/index.php

## theme主题 ##
$this->theme = 'new',则表示layout/new/index.php

## 例子 ##
    <?php
    namespace App\Controllers;
    
    use FlyPhp\Controllers\Base;
    
    class Test extends Base
    {
        protected function init()
        {
            parent::init();
    
            $this->layout = 'index';
        }
    
        public function index()
        {
            return 'Hello, World!';
        }
    
        public function show()
        {
            $this->view = 'Test/show';
    
            return array(
                'data' => 'show me', 
            );
        }
    }

## 命令行 ##
php web/index.php {controller} {action} {param1} {param2}...

## 规范 ##
- 每个action不能有exit，die等中途退出，必须用return 返回值。

    
    1. 网页访问， 返回值在view中展示
       
    1.  命令行访问， 返回值如果是对象数组，就json输出，否则直接echo,命令行不会执行view层 
    
- js，css另起一个域名，js.xxx.com, 这样加载js，css就不会带cookie等头部信息，节省宽带。
    
## url rewrite配置 ##
配置文件config/route.php

        return array(
            'test/main/kkkk' => 'test/index' //用test/main/kkkk 代替 test/index访问
        );

## 推荐安装方式 ##
composer create-project zxwqxtu/flyphp2 project dev-master
