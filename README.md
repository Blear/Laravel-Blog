## Laravel-Blog

项目地址：[https://www.blear.cn](https://www.blear.cn)
###项目介绍
基于Laravel5.3开发的博客系统,前端主题使用BootStarp框架,具体功能包括多用户权限控制管理、文章管理、草稿箱、文章软删除、分类管理、多标签管理、页面管理、导航管理、友情连接管理。编辑器采用MarkDown编辑器,支持粘贴、拖拽上传图片、缓存系统、使用第三方社交评论畅言等等
###环境要求：
博客是基于Laravel5.3框架开发，php版本需>= 5.6.4
安装前请先安装composer。
###安装步骤：
1.下载程序源码并解压到你的web目录

2.安装程序依赖
  在博客目录下执行
  ```
  composer install --no-dev
  ```
  composer 会自动安装博客所需要的依赖
  
 3.修改博客配置文件
 将博客目录中的.env.example文件复制一份命名为.env
 修改数据库连接配置
 ```
 DB_HOST=127.0.0.1 //数据库地址
 DB_PORT=3306 //数据库端口
 DB_PREFIX=blog_ //表前缀
 DB_DATABASE=homestead //数据库名称
 DB_USERNAME=homestead //用户名
 DB_PASSWORD=secret  //密码
 ```
 博客默认采用文件缓存，如需要用REDIS缓存，请修改CACHE_DRIVER=redis,平切配置REDIS的主机端口等信息。
 
 4.生成加密用的key
 在当前目录执行
 ```
 php artisan key:generate
 ```
 5.填充博客初始数据
 在当前目录执行
 ```
 php artisan db:seed
 ```
 程序会自动生成管理员账号和默认的用户组数据。
 后台地址：/admin
 初始化的管理员账号：admin@qq.com 密码：123456
