<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Country;
use \yii\data\Pagination;

/**
 * Description of CountryController
 *
 * @author Administrator
 */
class CountryController extends Controller {

    //put your code here
    public function actionIndex() {
        $query = Country::find();
//        $countrys = $query->all();
//        $countrys = $query->where([">", "population", "154225456"])->all();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('name')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();


        return $this->render("index", ["countrys" => $countries,'pagination' => $pagination]);
    }

}
