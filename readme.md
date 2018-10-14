## 项目概述

* 项目名称：个人博客
* 项目运行地址：http://jochen-z.com/

这是我的个人博客，使用 [Laravel 5.5](https://laravel.com/) 和 [Vue 2.0](https://cn.vuejs.org/) 框架进行开发。

系统后台使用 Vuejs + Element-UI + JWT 实现了前后端分离。





### 博客功能

前端：
- 分类导航
- 标签云
- 文章日志
- 全文搜索
- RSS 订阅（未实现）
- SEO 友好 URL

管理后台：
- 分类管理
- 文章管理
- 标签管理
- Log 日志查阅（未实现）
- 访问统计（未实现）
- About 页面管理
- Simplemde Markdown 编辑器 + 图片拖拽上传

## 运行环境要求

- Nginx 1.8+
- PHP 7.1+
- Mysql 5.7+
- Elasticsearch 5.6

## 部署/安装

本项目代码使用 Docker PHP 开发环境 [Laradock](http://laradock.io/) 进行开发和部署。

### 基础安装

#### 1. 克隆源代码

```shell
git clone git@github.com:Jochen-z/blog.git
```

#### 2. 安装扩展包依赖

```shell
composer install
```

#### 3. 生成配置文件

```shell
cp .env.example .env
```

然后在 `.env` 的配置文件里面完成如下配置项：

> 为了生成 SEO 友好的文章 URL，使用了百度翻译 API。（必须）

```
 # 数据库
 DB_CONNECTION=
 DB_HOST=
 DB_PORT=
 DB_DATABASE=
 DB_USERNAME=
 DB_PASSWORD=

 # 百度翻译平台
 BAIDU_TRANSLATE_APP_ID=
 BAIDU_TRANSLATE_KEY=
 ```

#### 4. 生成秘钥

```shell
php artisan key:generate
```

#### 5. 生成 JWT 的 secret

```shell
php artisan jwt:secret
```

#### 6. 创建符号链接

```shell
php artisan storage:link
```

#### 7. 生成数据表及测试数据

```shell
php artisan migrate --seed
```

#### 8. 创建 Elasticsearch 索引

```shell
php artisan es:init
```

### 前端框架安装

#### 1. 安装前端所需要的依赖

```shell
yarn install
```

#### 2. 编译前端内容

开发环境使用：

```shell
npm run dev
```

生产环境请使用：

```shell
npm run production
```

### 链接入口

* 首页地址：http://blog.me/
* 管理后台：http://blog.me/admin#/login

管理员账号密码如下:

```
username: admin@gmail.com
password: 123456
```

至此, 安装完成 ^_^。

如果你发现 bugs，或者有一些好的建议，欢迎 issue。