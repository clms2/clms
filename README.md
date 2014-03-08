Clms
=======

Clms for company

### The Clms Functions
  1.后台栏目或者文章做成双击修改的，一些标题啦 发布日期啦 啥的 双击修改
  
  2.复制功能，比如一篇文章想把相同的内容复制到另一栏目下，可选择：是否公用同一张图片；衍生出来的修改功能，如果该文章是复制过的，修改的时候同时修改其他相同的文章
  
  3.删除功能，选中是否同时删除文章图片，可以减少网站大小以便于备份
  
  4.ajax分页，当点击下一页的时候判断是否已经存在该div，存在则直接显示，否则提交ajax请求并记录该页/到html中（1个普通分页 一个ajax分页
  ）
  
  5.一些不可预见的错误能发送回来让咱们知道。就类似发送崩溃报告一样，选择是否帮助我们改进
  
  6.删除栏目的时候默认选中同时删除该栏目及其子栏目的所有文章和图片
  
  7.程序批量替换模板文件(用于建站初期)
  
  8.在后台加几个参数，比如：
	  qq:1233..
	  tel:180xxx
	  然后添加文章的时候，自动把内容里的1233..替换成标签比如{cfg.qq},电话替换成{cfg.tel
	  这样的好处是以后就不用改数据库了
	  直接后台更改 然后重新生成

  9.修改文章图片的时候把原来的图删了;上传图片的时候判断图片md5是否存在，存在则不上传用已上传的图
  10.加个防黑功能，流程如下：
用户上传网站程序之后，将所有的php文件md5_file下生成个hashmap，相当于网站快照。当管理员感觉被黑的时候可以重新生成下，程序比对MD5值是否和原先hash表里的一致，不一致或者多了文件那就是后门了。。不过貌似没有从根本上清理掉漏洞，可以用于快速查找后门程序，很实用
这样的话最好再弄个追踪功能，我想的是，当添加一句话后门的时候能追踪是哪个程序添加的，也就能找到程序漏洞了
有种办法可以追踪到更改 ，就是定义个参数，比如$debug=1
如果自己修改已经运行的程序的话 再生成遍md5就行了
嗯 还得配合web访问日志
调出该时刻的http请求就知道是哪个request修改这个文件了
  
  生成html：
  
  1.生成html的时候可以用文件缓存数据库查询结果
  
  2.栏目缓存，array('pids'=>array(id1,id2..)),当修改或者删除栏目的时候更新缓存

### DataBase
    文章表 article
    id	title	content	author	pubdate		source	description		pics	addtime		cid	rank	click
    标题	正文	作者	发布日期	来源	简短描述	单/多张图片id	添加时间	栏目   排序	点击数
	
    栏目表 column=>目录命名做个教程?关于怎样的名字有利于seo:关于我们=>about 联系我们=>contact..
    id  pid 	path	list       view      description     keyword 
    上级栏目 	栏目路径 列表模板   详细模板  栏目描述	栏目关键词	
    
    管理员 admin
    id  gid  uname  pwd   loginip  lastlogin  logintime
  
    用户组 group
    id    gname  limit
                 权限      
  
    留言表 message=>加个留言字段管理?可设定该表的附加字段qq tel email reply replyname rtime..?
    id   guest  content  addtime
    
    友链表 flink
    id   url  title  pic  ispic  rank

    图片表 pic
    id    path    md5
    