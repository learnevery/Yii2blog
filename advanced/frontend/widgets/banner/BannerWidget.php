<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace frontend\widgets\banner;
use yii\base\Widget;
/**
 * Description of BannerWidget
 *
 * @author Administrator
 */
//广告轮播组件
class BannerWidget extends Widget{
    //put your code here
    public $items = [];
    public function init() {
//        初始化数据
        if(count($this->items === 0)){
            $this->items=[
                [
                    "active"=>"active",
                    'img_url'=>"/statics/images/banner/1.jpg",
                    'html'=>"http://www.baidu.com",
                    "img_name"=>"图2",
                    "img_title"=>"哈哈哈",
                ],
                [
                    "active"=>"",
                    'img_url'=>"/statics/images/banner/2.jpg",
                    'html'=>"http://www.baidu.com",
                    "img_name"=>"图1",
                    "img_title"=>"哈哈哈",
                ],
                [
                    "active"=>"",
                    'img_url'=>"/statics/images/banner/3.jpg",
                    'html'=>"http://www.baidu.com",
                    "img_name"=>"图3",
                    "img_title"=>"哈哈哈",
                ],
               
            ]; 
        }
    }
    public function run() {
//        展示模板页

        return $this->render("index",["items"=>  $this->items]);
    }
}
