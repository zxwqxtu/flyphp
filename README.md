## 安装 ##
### 推荐方式 ###
composer create-project zxwqxtu/flyphp2 {project} dev-master

## 配置 ##
### config.php ###
### database.php ###
    支持mysql,pgsql等关系型数据库（pdo), mongodb
### route.php ###
    支持自定义url rewrite
    return [
        '/blog' => 'test/index/blog' //用/blog 代替test/index/blog访问
    ];

## 控制器 ##
### 模板 ###
$this->view='test/index',则表示views/test/index.php

### layout布局 ###
$this->layout='index',则表示layout/index.php

### theme主题 ###
$this->theme = 'new',则表示layout/new/index.php

### 命令行 ###
php web/index.php {controller} {action} {param1} {param2}...

### 规范 ###
- 每个action不能有exit，die等中途退出，必须用return 返回值。

    
    1. 网页访问， 返回值在view中展示
       
    1.  命令行访问， 返回值如果是对象数组，就json输出，否则直接echo,命令行不会执行view层 
    
## Model层 ##
### 属性值 ###
   protected $dbType = 'mysql';
   
   protected $dbSelect= 'default';
   
   protected $table = '';
   
   protected $collection = '';
   
### 方法 ###
find($id)

findAll()

findBy($where)

findOneBy($where)

#### $where格式 ####
**pdo** [['id', 13], ['status', [0,1]], ['date', '20150503', '>']]
**mongodb** 原始格式


----------


## nginx配置 ##
	server {
		listen       9090;
		root          /www/web/flyPhp2/web;
		index index.php;

		location / {
			# try to serve file directly, fallback to app.php
			try_files $uri /index.php$uri;
		}

		location ~ \.php {
			fastcgi_pass   unix:/tmp/php-cgi.sock;
			fastcgi_param  SCRIPT_FILENAME  $realpath_root$fastcgi_script_name;
			include        fastcgi_params;
		}
		error_log logs/flyphp2.error.log;
		access_log logs/flyphp2.access.log;
	}
