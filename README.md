![4ucms](http://mcmswx.foru.net.cn/favicon.png)

####开发环境
* PHP
* MYSQL

####主程序部分
2.38 M

####系统预览
[http://mcmswx.foru.net.cn/](http://mcmswx.foru.net.cn/view/)

####Git
* [https://github.com/zhaodifangsi/4ucms](https://github.com/zhaodifangsi/4ucms)
* [http://git.oschina.net/sw1981/FORU-CMS](http://git.oschina.net/sw1981/FORU-CMS)

####开发者邮箱
shadowwing@163.com

####系统搭建
1. 创建数据库并指定utf-8编码（CREATE DATABASE 数据库名称 DEFAULT CHARSET utf8 COLLATE utf8_general_ci;）
2. 打开install/index.php进行数据导入；当然您也可以直接导入install/data.sql文件来替代前面的步骤
3. 修改config/data.php内的数据库连接信息
4. 修改config/config.php内的网站路径信息
5. 如果需要使用smtp功能，请修改config/smtp.php内的对应信息

####目录结构
>		/admin          管理后台,默认账户密码为admin
>		/config         配置项(data.php文件需要读写权限)
>		/editor         编辑器
>		/fonts          字体
>		/install        数据安装
>		/js             前后台共用js
>		/language       语言文件
>		/library        函数库
>		/sql            数据存储(需要读写权限)
>		/templates      前台模板
>		/uploadfile     上传文件(需要读写权限)
>		/view           模板切换查看
>		sitemap.xml     (需要读写权限)

####功能介绍
* [内容]菜单：频道管理，详情管理，幻灯管理，碎片管理
* [交互]菜单：会员管理，留言管理，投票调查，友情链接
* [系统]菜单：系统设置，权限管理，管理员，模板管理，数据库管理，伪静态，sitemap

####常用数据表
>[cms_channel]
>>		id
>>		c_name  频道名称
>>		c_ifpicture  频道图片判断 1/0
>>		c_picture  频道图片
>>		c_parent  父级频道ID
>>		c_main  顶级频道ID
>>		c_ifsub  子级判断 1/0
>>		c_sub  子级字串 1,2,3,...
>>		c_cmodel  频道模型
>>		c_dmodel  频道内详情模型
>>		c_rec  推荐 1/0
>>		c_content  频道内容
>>		c_scontent  简短内容
>>		c_page  分页数量
>>		c_seoname  SEO名称
>>		c_keywords  SEO关键词
>>		c_description  SEO描述
>>		c_navigation  导航显示判断 1/0
>>		c_nname  导航显示名称 1/0
>>		c_link  外链地址
>>		c_sname  频道简称
>>		c_aname  频道英文名称
>>		c_ifcover  频道封面判断 1/0
>>		c_cover  频道封面
>>		c_ifslideshow  幻灯判断 1/0
>>		c_slideshow  幻灯字串 使用"|"分隔
>>		c_target  跳转目标 _self/_blank
>>		c_safe  删除保护 1/0
>>		c_order  频道排序 默认值100,越小越靠前

>[cms_chip]
>>		id
>>		c_code  调用代码
>>		c_name  描述
>>		c_content  内容
>>		c_safe  删除保护 1/0

>[cms_cmodel]
>>		id
>>		c_name  频道模型名称
>>		c_value  频道模型对应文件名

>[cms_detail]
>>		id
>>		d_name  详情名称
>>		d_ifpicture  详情图片判断 1/0
>>		d_picture  详情图片
>>		d_parent  所属频道
>>		d_rec  推荐判断 1/0
>>		d_hot  热门判断 1/0
>>		d_price  详情价格(备用)
>>		d_ifslideshow  幻灯判断
>>		d_slideshow  幻灯字串 使用"|"分隔
>>		d_content  详情内容
>>		d_scontent  简短内容
>>		d_seoname  SEO名称
>>		d_keywords  SEO关键词
>>		d_description  SEO描述
>>		d_link  外链地址
>>		d_order  排序 默认值100,越小越靠前
>>		d_source  来源
>>		d_author  作者
>>		d_hits  浏览数
>>		d_ifvideo  视频判断 1/0
>>		d_video  视频
>>		d_ifattachment  附件判断 1/0
>>		d_attachment  附件
>>		d_point  (备用)
>>		d_tag  (备用)
>>		d_date  发布日期

>[cms_dmodel]
>>		id
>>		d_name  详情模型名称
>>		d_value  详情模型对应文件名

>[cms_feedback]
>>		id
>>		f_type  留言类别
>>		f_name  姓名
>>		f_tel  电话/手机
>>		f_qq  QQ
>>		f_email  Email
>>		f_cname  (备用)
>>		f_address  地址
>>		f_title  标题
>>		f_content  内容
>>		f_answer  答复内容
>>		f_date  留言日期
>>		f_adate  答复日期
>>		f_ok  状态判断 1/0

>[cms_link]
>>		id
>>		l_name  友情链接名称
>>		l_order  排序 默认值100,越小越靠前
>>		l_link  链接地址
>>		l_picture  友情链接图片

>[cms_role]
>>		id
>>		r_name  角色名称
>>		r_priv  角色权限字串 使用","分隔

>[cms_slideshow]
>>		id
>>		s_name  幻灯名称
>>		s_parent  所属层级 可以配置为全局,频道....
>>		s_order  排序 默认值100,越小越靠前
>>		s_url  链接地址
>>		s_picture  幻灯字串

>[cms_subscribe]
>>		id
>>		sub_mail  订阅邮箱
>>		sub_date  订阅日期

>[cms_system]
>>		id
>>		s_template  当前模板ID
>>		s_domain  域名
>>		s_name  站点名称
>>		s_seoname  SEO名称
>>		s_keywords  SEO关键词
>>		s_description  SEO描述
>>		s_copyright  版权信息
>>		s_code  第三方代码
>>		s_feedback  留言判断

>[cms_template]
>>		id
>>		t_name  模板名称
>>		t_path  模板文件夹名

>[cms_user]
>>		id
>>		u_rid  管理员角色ID
>>		u_enable  生效判断 1/0
>>		u_name  用户名称
>>		u_psw  用户密码
>>		u_picture  用户图片
>>		u_cash  用户金额
>>		u_point  用户点数
>>		u_level  用户等级ID
>>		u_tname  真实姓名
>>		u_email  电子邮箱
>>		u_mobile  手机
>>		u_location  所在位置
>>		u_province  省份
>>		u_city  市
>>		u_district  区
>>		u_addr  地址
>>		u_question  (备用)
>>		u_answer  (备用)
>>		u_post  邮编
>>		u_date  注册日期
>>		u_code  (备用)
>>		last_login  近期登陆日期
>>		u_isadmin  管理员判断

>[cms_user_level]
>>		id
>>		ul_name  用户等级名称
>>		ul_content  等级内容
>>		ul_point  等级所需点数