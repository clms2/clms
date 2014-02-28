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
  
  
  
  生成html：
  
  1.生成html的时候可以用文件缓存数据库查询结果
  
  2.栏目缓存，array('pids'=>array(id1,id2..)),当修改或者删除栏目的时候更新缓存

### DataBase
  # 文章表 article 用于列表页
  id	title	pubdate		desc	   pics          addtime
    	标题	发布日期	简短描述   单/多张图片   添加时间
  
  # 详细页 arc_detail
  aid	content	  author   source   
  文章id  正文	  作者     来源 来源表?..  
    
  # 管理员 admin
  id  groupid  uname  pwd   loginip  lastlogin  logintime
  
  # 用户组 group
  id    gname  limit
               权限      
  
  # 留言表 message=>加个留言字段管理?可设定该表的附加字段qq tel email reply replyname rtime..?
  id   guest  content  addtime
   
  # 友链表 flink
  id   url  title  pic  ispic  rank
  
  # 栏目表 column=>目录命名做个教程?关于怎样的名字有利于seo:关于我们=>about 联系我们=>contact..
  id  pid  name     dir     list       view      cdesc      keyword  desc  rank 
           栏目名   目录名  列表模板   详细模板  栏目描述
