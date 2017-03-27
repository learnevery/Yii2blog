<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\base\Model;
/**
 * Description of MyArtForm
 *
 * @author Administrator
 */
class MyArtForm extends Model{
    //put your code here
    public $art_name;
    public $art_content;
    public function rules() {
        return [
            
        ];
    }
    public function createArt() {
        
    }
    public function attributeLabels() {
       
    }
    
}
