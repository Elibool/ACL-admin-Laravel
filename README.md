# Larval 5.3 ACL 后台Demo

## 说明

基于laravel 5.3 与 gentelella 权限管理
开箱即用的后台模板,菜单栏都是基于权限来生成

权限控制系统这块 ,主要运用了 Laravel 自带的 Gate 来实现
这是一个需自主约定开发的过程,在编写 Controller 时需约定好各个方法的命名实现
有两种权限定义模式:

1.宽松模式

2.严格模式
严格模式 > 宽松模式

例:
(宽松模式定义) 拥有订单列表权限后,同时拥有单个订单的 view 和 modify 权限

单独定义订单权限, 如 view 和 modify 权限,可定义只拥有 view  权限而没有 modify 权限 (严格模式订单)

更多关于本项目的想法 可前往 [wiki](https://github.com/Elibool/ACL-management-with-Laravel-Bootstrap/wiki)

###### 本项目建议只用来做参考


## 截图

## ![laravel 用户权限分配](https://github.com/Elibool/ACL-management-with-Laravel-Bootstrap/blob/master/public/images/yi_admin2.png)

![权限树](https://github.com/Elibool/ACL-management-with-Laravel-Bootstrap/blob/master/public/images/yi_admin3.png)



## 安装

- git clone 到本地
- 配置 **.env** 中数据库连接信息,没有 .env 请复制 .env.example 命名为 .env
- 执行 `php artisan migrate` 生成数据库结构;
- 注意: 上步如果出错,请先将 `app\Providers\AuthServiceProvider.php` 内的 `public function boot()` 方法代码全部注释掉
- 执行 `php artisan db:seed` 填充数据
- 执行 `php artisan serve`
- 浏览器输入 'localhost:8000/login'
- 默认后台账号: admin@admin.com 密码: 123456


## 使用
- 默认 Admin 为超级管理员可用于添加顶级权限
- 具体部分可以参照路由与源码,也可以 Email 我 elibool@outlook.com
