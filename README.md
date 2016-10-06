#FORU CMS
#开发环境
* PHP
* MYSQL
#系统搭建
1. 创建数据库并指定utf-8编码（CREATE DATABASE 数据库名称 DEFAULT CHARSET utf8 COLLATE utf8_general_ci;）
2. 打开install/index.php进行数据导入；当然您也可以直接导入install/data.sql文件来替代前面的步骤
3. 修改config/data.php内的数据库连接信息
4. 修改config/config.php内的网站路径信息
5. 如果需要使用smtp功能，请修改config/smtp.php内的对应信息
#目录结构
 /admin 管理后台
 /config 配置项
 /editor 编辑器
 /install 数据安装
 /js 前后台共用js
 /language 语言文件
 /library 公用库
 /sql 数据存储
 /templates 模板目录
 /ui 共用自适应系统，目前为妹子UI
 /uploadfile 上传文件
 /view 模板切换查看
#功能介绍
* [内容]菜单：频道管理，详情管理，幻灯管理，碎片管理
* [交互]菜单：会员管理，留言管理，在线客服，投票调查，友情链接
* [系统]菜单：系统设置，权限管理，管理员，模板管理，数据库管理，伪静态，sitemap