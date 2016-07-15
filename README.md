# thinkphp5 TagLib 编辑器

> 更新完善中

必须在页面中先引入 TagLib
~~~
<!-- 声明使用 TagLib -->
{taglib name="Editor" /}
<!-- 引入 ueditor 使用的静态资源文件 type:编辑器名称，path:编辑器静态资源存放路径 -->
{Editor:assets type="ueditor" path="https://assets.thinkphp.cn/ueditor/" /}
~~~

在需要使用 ueditor 编辑器的地方插入
~~~
{Editor:ueditor name="content" id="container"}{$item.content}{/Editor:ueditor}
~~~