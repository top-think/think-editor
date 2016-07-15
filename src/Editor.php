<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 刘志淳 <chun@engineer.com>
// +----------------------------------------------------------------------
namespace think\template\taglib;

use think\Request;
use think\template\TagLib;

class Editor extends TagLib
{
    // 标签定义
    protected $tags = [
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'assets' => ['attr' => 'type,src', 'close' => 0],
        'ueditor' => ['attr' => 'name,id,style', 'close' => 1],
    ];

    /**
     * 引入静态资源标签
     * 格式：
     * {php}echo $name{/php}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagAssets($tag)
    {
        $parseStr = '';
        $src = isset($tag['src']) ? $tag['src'] : Request::instance()->baseUrl() . 'static/ueditor/';

        switch ($tag['type']) {
            case 'ueditor':
                $parseStr .= "<!-- 配置文件 --><script type=\"text/javascript\" src=\"{$src}ueditor.config.js\"></script>";
                $parseStr .= "<!-- 编辑器源码文件 --><script type=\"text/javascript\" src=\"{$src}ueditor.all.min.js\"></script>";
                break;
        }

        return $parseStr;
    }

    /**
     * ueditor 编辑器
     * 格式：
     * {Editor:ueditor name="contentt" id="container" style="color:red;"}{/Editor:ueditor}
     * @access public
     * @param array $tag 标签属性
     * @param array $content 标签内容
     * @return string
     */
    public function tagUeditor($tag, $content)
    {
        $name = $tag['name'];
        $id = isset($tag['id']) ? $tag['id'] : 'container';
        $style = isset($tag['style']) ? $tag['style'] : '';

        $parseStr = "<!-- 加载编辑器的容器 --><script id=\"{$id}\" name=\"{$name}\" type=\"text/plain\" style=\"{$style}\">{$content}</script>";
        $parseStr .= "<!-- 实例化编辑器 --><script type=\"text/javascript\">var ue_{$id} = UE.getEditor('{$id}');</script>";

        return $parseStr;
    }
}